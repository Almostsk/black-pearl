<?php

namespace App\Http\Controllers\Api;

use Auth;
use Session;
use Exception;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Modules\Sms\Service\SmsService;
use App\Modules\User\Service\UserService;
use App\Http\Requests\Api\SendSmsRequest;
use App\Http\Requests\Api\VerifyCodeRequest;
use App\Http\Requests\Api\SearchGalleryRequest;
use App\Http\Requests\Api\UpdateUserCabinetRequest;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Services\StartMobile\Service\SmsService as StartMobileService;
use App\Http\Resources\User\{WinnersResource, CabinetResource, GalleryResource, OurStarsResource};

class UserController extends Controller
{
    /**
     * @var StartMobileService
     */
    private $startMobileService;

    /**
     * @var SmsService
     */
    private $smsService;

    /**
     * @var UserService
     */
    private $userService;

    public function __construct(
        StartMobileService $startMobileService, SmsService $smsService, UserService $userService
    )
    {
        $this->startMobileService = $startMobileService;
        $this->smsService = $smsService;
        $this->userService = $userService;
    }

    public function sendCode(SendSmsRequest $request)
    {
        try{
            $code = mt_rand(1000, 9999);

            // saving to db
            $this->smsService->save([
                'mobile_phone' => $request->mobile_phone,
                'message_body' => $code
            ]);

            // Sending a message
            $response = $this->startMobileService->sendMessage($code, $request->mobile_phone);

            if ($response->getStatus() == 'Accepted') {
                return response()->json([
                    'success' => true
                ], Response::HTTP_OK);
            }

            return response()->json([
                'success' => false,
                'message' => config('response_message.wrong_number_code_error')
            ], Response::HTTP_NOT_FOUND);

        } catch(ModelNotFoundException $notFoundHttpException) {
            return response()->json([
                'success' => false,
                'message' => config('response_message.no_user_found_with_phone')
            ], Response::HTTP_NOT_FOUND);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => config('response_message.server_error')
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function verifyCode(VerifyCodeRequest $request)
    {
        $isValid = $this->smsService->isValidCode($request->mobile_phone, $request->code);

        if (!$isValid) {
            return response()->json([
                'success' => false,
                'message' => config('response_message.wrong_code_error')
            ], Response::HTTP_NOT_FOUND);
        }

        $this->smsService->removeCurrentCode($request->mobile_phone, $request->code);

        return response()->json([
            'success' => true,
        ]);

    }

    public function getOurStars()
    {
        return response()->json([
            'users' => OurStarsResource::collection($this->userService->getStarsForMainPage())
        ]);
    }

    public function getGallery()
    {
        return response()->json([
            'users' => GalleryResource::collection($this->userService->getGalleryUsers()),
            'ladies' => config('static_photos.ladies')
        ]);
    }

    /**
     * Gets personal info for current user for the cabinet
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCabinet()
    {
        try {
            return response()->json([
                'user' => new CabinetResource($this->userService->getDataForPersonalCabinet())
            ]);
        } catch (TokenExpiredException $expiredException) {
            return response()->json([
                'user' => [],
                'message' => config('response_message.token_expired_error')
            ], Response::HTTP_NOT_FOUND);
        } catch (Exception $exception) {
            return response()->json([
                'user' => [],
                'message' => config('response_message.server_error')
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Gets all the winners and puts them to different arrays
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function winners()
    {
        try {
            return response()->json([
                'first' => WinnersResource::collection($this->userService->getWinnersByPrizeId(1)),
                'second' => WinnersResource::collection($this->userService->getWinnersByPrizeId(2))
            ]);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return response()->json([
                'success' => false,
                'message' => config('response_message.resource_not_found_error')
            ], Response::HTTP_NOT_FOUND);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => config('response_message.server_error')
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update user data from Personal Cabinet
     *
     * @param UpdateUserCabinetRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserCabinetRequest $request)
    {
        try {
            $userId = Auth::user()->id;
            $this->userService->update($request, $userId);

            return response()->json([
                'success' => true
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'user' => [],
                'message' => config('response_message.server_error')
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function searchGallery(SearchGalleryRequest $request)
    {
        return response()->json([
            'users' => GalleryResource::collection($this->userService->searchGallery($request->all()))
        ]);
    }
}

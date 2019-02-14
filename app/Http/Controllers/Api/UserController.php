<?php

namespace App\Http\Controllers\Api;

use Auth;
use Exception;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SendSmsRequest;
use App\Modules\Sms\Service\SmsService;
use App\Modules\User\Service\UserService;
use App\Http\Resources\User\CabinetResource;
use App\Http\Resources\User\GalleryResource;
use App\Http\Resources\User\OurStarsResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Services\StartMobile\Service\SmsService as StartMobileService;

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

    public function sendSms(SendSmsRequest $request)
    {
        try{
            $code = mt_rand(1000, 9999);
            $userId = $this->userService->findUserIdByPhone($request->mobile_phone);

            // Saving to the database
            $this->smsService->save([
                'message_body' => $code,
                'user_id' => $userId
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
                'message' => 'Message service error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

        } catch(ModelNotFoundException $notFoundHttpException) {
            return response()->json([
                'success' => false,
                'message' => 'No user found with this phone'
            ], Response::HTTP_NOT_FOUND);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Server error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

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
            'users' => GalleryResource::collection($this->userService->getGalleryUsers())
        ]);
    }

    /**
     * Gets personal info for current user for the cabinet
     */
    public function getCabinet()
    {
        return response()->json([
            'user' => new CabinetResource($this->userService->getDataForPersonalCabinet())
        ]);
    }
}

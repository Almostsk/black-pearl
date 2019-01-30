<?php

namespace App\Http\Controllers\Api;

use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\SmsRepository;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Api\SMS\Service\SmsService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    /**
     * @var SmsService
     */
    private $smsSendingService;

    /**
     * @var SmsRepository
     */
    private $smsRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(SmsService $smsService, SmsRepository $smsRepository, UserRepository $userRepository)
    {
        $this->smsSendingService = $smsService;
        $this->smsRepository = $smsRepository;
        $this->userRepository = $userRepository;
    }

    public function sendSms(Request $request)
    {
        try{
            $code = mt_rand(1000, 9999);
            $userId = $this->userRepository->findUserIdByPhone($request->mobile_phone);

            // Saving to the database
            $this->smsRepository->save([
                'message_body' => $code,
                'user_id' => $userId
            ]);

            // Sending a message
            $response = $this->smsSendingService->sendMessage($code, $request->mobile_phone);

            return response()->json([
                'status' => $response,
                //'message' => $response->getStatusMessage()
            ], Response::HTTP_OK);


        } catch(ModelNotFoundException $notFoundHttpException) {
            return response()->json([
                'success' => false,
                'message' => 'No user found with this phone'
            ], Response::HTTP_NOT_FOUND);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function verifyCode(Request $request)
    {
        $userId = $this->userRepository->findUserIdByPhone('+' . $request->mobile_phone);

        if ($request->code === $this->userRepository->getCodeSentOnMobile($userId)) {
            Auth::loginUsingId($userId);
        } else {
            return response()->json([
                'success' => 'false',
                'message' => 'codes don`t match'
            ]);
        }

    }

}

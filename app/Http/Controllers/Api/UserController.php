<?php

namespace App\Http\Controllers\Api;

use Auth;
use Exception;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendSmsRequest;
use App\Modules\Sms\Service\SmsService;
use App\Modules\User\Service\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Api\StartMobile\Service\SmsService as StartMobileService;

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
                'message' => 'Server error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}

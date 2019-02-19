<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Modules\Sms\Service\SmsService;
use App\Http\Requests\Auth\LoginRequest;
use App\Modules\User\Service\UserService;
use App\Http\Resources\User\UserResource;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    /** @var UserService $userService */
    private $userService;

    /** @var SmsService */
    private $smsService;

    public function __construct(UserService $userService, SmsService $smsService)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->userService = $userService;
        $this->smsService  = $smsService;
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  LoginRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try {

            if ($this->smsService->isValidCode($request->mobile_phone, $request->code)) {

                if (!$token = JWTAuth::attempt([
                        'password' => config('app.user_password'),
                        'mobile_phone' => $request->mobile_phone,
                    ])
                ) {
                    return response()->json(['error' => true], Response::HTTP_UNAUTHORIZED);
                }

                return $this->sendUserDataWithToken($token);

            } else {
                return response()->json([
                    'success' => 'false',
                    'message' => config('response_message.wrong_code_error')
                ], Response::HTTP_NOT_FOUND);
            }

        } catch (ModelNotFoundException $notFoundException) {
            return response()->json([
                'success' => 'false',
                'message' => config('response_message.no_user_found_with_phone')
            ], Response::HTTP_NOT_FOUND);
        }

    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json([
            'success' => true,
            'message' => config('response_message.successfully_logged_out')
        ]);
    }

    /**
     * Generates JSON with response with token
     *
     * @param string $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendUserDataWithToken(string $token)
    {
        return response()->json([
            'token' => 'Bearer ' . $token,
            'user' => new UserResource(auth()->user())
        ]);
    }
}

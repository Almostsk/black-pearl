<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\Auth\LoginRequest;
use App\Modules\User\Service\UserService;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @var UserService $userService
     */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->userService = $userService;
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
        $userId = $this->userService->findUserIdByPhone($request->mobile_phone);

        if ($request->code === $this->userService->getCodeSentOnMobile($userId)) {

            if (!$token = auth('api')
                ->attempt([
                    'password' => config('app.user_password'),
                    'mobile_phone' => $request->mobile_phone,
                ])
            ) {
                return response()->json(['error' => true], Response::HTTP_UNAUTHORIZED);
            }
            return $this->userService->respondWithToken($token);

        } else {
            return response()->json([
                'success' => 'false',
                'message' => 'codes don`t match'
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
        return response()->json(['message' => 'Successfully logged out']);
    }
}

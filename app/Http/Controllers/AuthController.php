<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Response;
use App\Http\Requests\Auth\LoginRequest;
use App\Modules\User\Service\UserService;
use App\Http\Resources\User\UserResource;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        try{
            $userId = $this->userService->findUserIdByPhone($request->mobile_phone);

            if ($request->code === $this->userService->getCodeSentOnMobile($userId)) {

                if (!$token = JWTAuth::attempt([
                        'password' => config('app.user_password'),
                        'mobile_phone' => $request->mobile_phone,
                    ])
                ) {
                    return response()->json(['error' => true], Response::HTTP_UNAUTHORIZED);
                }

                dd($this->sendUserDataWithToken($token)->getData());
                return $this->sendUserDataWithToken($token);

            } else {
                return response()->json([
                    'success' => 'false',
                    'message' => 'codes don`t match'
                ], Response::HTTP_NOT_FOUND);
            }
        } catch (ModelNotFoundException $notFoundException) {
            return response()->json([
                'success' => 'false',
                'message' => 'User not found'
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

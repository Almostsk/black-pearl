<?php

namespace App\Http\Controllers;

use Log;
use Exception;
use App\Modules\User\Service\UserService;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * Create a new controller instance.
     *
     * @param UserService $userService
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->middleware('guest');
        $this->userService = $userService;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  RegisterRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            $this->userService->save($request);

            return response()->json([
                'success' => true,
            ]);

        } catch(Exception $exception) {
            Log::warning($exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Server error'
            ]);
        }
    }
}

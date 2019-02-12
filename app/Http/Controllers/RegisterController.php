<?php

namespace App\Http\Controllers;

use Log;
use Exception;
use App\Modules\Code\Service\CodeService;
use App\Modules\User\Service\UserService;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    /** @var UserService */
    private $userService;

    /** @var CodeService */
    private $codeService;

    /**
     * Create a new controller instance.
     *
     * @param UserService $userService
     * @param CodeService $codeService
     */
    public function __construct(UserService $userService, CodeService $codeService)
    {
        $this->middleware('guest');
        $this->userService = $userService;
        $this->codeService = $codeService;
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

            if ($this->codeService->isCodeValid($request->code)) {
                $user = $this->userService->save($request);
                $codeId = $this->codeService->getIdByCode($request->code);

                $this->codeService->update([
                    'user_id' => $user->id,
                ], $codeId);

                return response()->json([
                    'success' => true
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Invalid code'
            ]);

        } catch(Exception $exception) {
            Log::warning($exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }
}

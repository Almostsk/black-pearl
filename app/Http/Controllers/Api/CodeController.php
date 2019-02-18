<?php

namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Modules\Code\Service\CodeService;
use App\Http\Requests\Api\RegisterCodeRequest as Request;

class CodeController extends Controller
{
    /** @var CodeService */
    private $codeService;

    public function __construct(CodeService $codeService)
    {
        $this->codeService = $codeService;
    }

    public function register(Request $request)
    {
        $codeId = $this->codeService->getIdByCode($request->name);

        if (!$codeId) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $user = Auth::user();

        if ($user) {
            $updated = $this->codeService->update([
                'user_id' => $user->id
            ], $codeId);

            if ($updated) {
                return response()->json([
                    'success' => true
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => false,
                'message' => 'Server error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'success' => false,
            'message' => 'User not found'
        ], Response::HTTP_NOT_FOUND);

    }
}

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
        $id = $this->codeService->getIdByCode($request->name);

        if (!$id) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found'
            ], Response::HTTP_NOT_FOUND);
        }

        if (Auth::user()) {
            $updated = $this->codeService->update([
                'user_id' => Auth::user()->id
            ], $id);

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

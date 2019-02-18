<?php

namespace App\Http\Controllers\Api;

use Auth;
use Exception;
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        try {
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
                    ]);
                }

                return response()->json([
                    'success' => false,
                    'message' => 'Code not found'
                ], Response::HTTP_NOT_FOUND);
            }
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Server error'
            ]);
        }
    }
}

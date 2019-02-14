<?php

namespace App\Http\Controllers\Api;

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

        $updated = $this->codeService->update([
            'code_name' => $request->name
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
}

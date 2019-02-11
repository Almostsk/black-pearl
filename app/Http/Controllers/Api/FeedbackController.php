<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreFeedbackRequest;
use App\Modules\Feedback\Service\FeedbackService;

class FeedbackController extends Controller
{
    private $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    public function store(StoreFeedbackRequest $request)
    {
        if ($this->feedbackService->save($request->all())) {
            return response([
                'success' => 'true'
            ], Response::HTTP_CREATED);
        }

        return response([
            'success' => 'false'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Events\FeedbackFormCreated;
use App\Listeners\SendNotificationToSlack;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreFeedbackRequest;
use App\Http\Services\Slack\Service\SlackService;
use App\Modules\Feedback\Service\FeedbackService;

class FeedbackController extends Controller
{
    /** @var FeedbackService */
    private $feedbackService;

    /** @var SlackService */
    private $slackService;

    public function __construct(FeedbackService $feedbackService, SlackService $slackService)
    {
        $this->feedbackService = $feedbackService;
        $this->slackService = $slackService;
    }

    public function store(StoreFeedbackRequest $request)
    {
        if ($this->feedbackService->save($request->all())) {
            event(new FeedbackFormCreated($request->name));
            //$this->slackService->sendFormFilledMessage($request->name);
            return response([
                'success' => 'true'
            ], Response::HTTP_CREATED);

        }

        return response([
            'success' => 'false'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

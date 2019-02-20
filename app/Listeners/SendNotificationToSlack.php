<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Services\Slack\Service\SlackService;

class SendNotificationToSlack implements ShouldQueue
{
    /** @var SlackService */
    private $slackService;

    /**
     * Create the event listener.
     *
     * @param SlackService $slackService
     * @return void
     */
    public function __construct(SlackService $slackService)
    {
        $this->slackService = $slackService;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\FeedbackFormCreated  $event
     * @return void
     */
    public function handle($event)
    {
        $this->slackService->sendFormFilledMessage($event->getAuthorName());
    }
}

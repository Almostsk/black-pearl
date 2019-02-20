<?php

namespace App\Http\Services\Slack\Service;

use App\Http\Services\Slack\Repository\SlackRepository;

class SlackService
{
    private $slackRepository;

    public function __construct(SlackRepository $slackRepository)
    {
        $this->slackRepository = $slackRepository;
    }

    /**
     * Sends a message to a slack group after user fills in feedback form
     *
     * @param string $authorName
     * @return string
     */
    public function sendFormFilledMessage(string $authorName)
    {
        $this->slackRepository
            ->setText('Notification from BlackPerl')
            ->setAuthorInfo('. From: ' . $authorName);

        return $this->slackRepository->sendMessage();
    }
}

<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FeedbackFormCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var string */
    private $authorName;

    /**
     * Create a new event instance.
     *
     * @param string $authorName
     * @return void
     */
    public function __construct(string $authorName)
    {
        $this->authorName = $authorName;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    /**
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }
}

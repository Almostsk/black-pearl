<?php

namespace App\Http\Services\Slack\Repository;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use App\Http\Services\Core\BaseRepository;

class SlackRepository extends BaseRepository
{
    /**
     * Headers of the request
     *
     * @var array
     */
    private $headers = ['Content-type' => 'application/json'];

    /**
     * Text of the message. Required
     *
     * @var string
     */
    private $text;

    /**
     * Information about author. Optional
     *
     * @var string
     */
    private $authorInfo;

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param $text string
     * @return SlackRepository
     */
    public function setText($text): SlackRepository
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthorInfo()
    {
        return $this->authorInfo;
    }

    /**
     * @param string $authorInfo
     * @return SlackRepository
     */
    public function setAuthorInfo($authorInfo): SlackRepository
    {
        $this->authorInfo = $authorInfo;

        return $this;
    }

    public function sendMessage()
    {
        $data =  [
            'text' => $this->getText() . $this->getAuthorInfo() ?? ''
        ];

        $client = new Client([
            'headers' => $this->headers
        ]);

        $result = $client->post(
                config('app.slack_webhook_url'),
                [RequestOptions::JSON => $data]
            );

        return $result->getBody()->getContents();
    }

}

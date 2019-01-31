<?php
namespace App\Http\Api\Core;

use App\Http\Api\Core\Client;

class BaseRepository
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $hostUrl;

    public function __construct(Client $client)
    {
        $this->client = Client::make();
    }
}
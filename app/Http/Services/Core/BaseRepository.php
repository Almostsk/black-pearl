<?php
namespace App\Http\Services\Core;

use App\Http\Services\Core\Client;

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
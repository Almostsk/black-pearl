<?php

namespace App\Http\Api\Core;

use GuzzleHttp\Client as GuzzleClient;

class Client
{
    public static function make()
    {
        return new GuzzleClient();
    }
}
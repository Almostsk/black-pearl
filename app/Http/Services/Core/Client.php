<?php

namespace App\Http\Services\Core;

use GuzzleHttp\Client as GuzzleClient;

class Client
{
    public static function make()
    {
        return new GuzzleClient();
    }
}
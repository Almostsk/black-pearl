<?php

namespace App\Repositories;

use App\Models\Sms;

class SmsRepository extends BaseRepository
{
    public function __construct(Sms $sms)
    {
        parent::__construct($sms);
    }
}
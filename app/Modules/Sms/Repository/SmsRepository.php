<?php

namespace App\Modules\Sms\Repository;

use App\Models\Sms;
use App\Modules\Core\BaseRepository;

class SmsRepository extends BaseRepository
{
    public function __construct(Sms $sms)
    {
        parent::__construct($sms);
    }
}
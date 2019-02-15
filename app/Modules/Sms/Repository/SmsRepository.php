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

    public function getSmsWithPhoneNCode(string $mobilePhone, string $code)
    {
        return $this->model
            ->where([
                ['mobile_phone', $mobilePhone],
                ['message_body', $code],
            ])
            ->first();
    }
}
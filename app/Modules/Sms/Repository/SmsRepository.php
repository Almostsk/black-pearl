<?php

namespace App\Modules\Sms\Repository;

use Carbon\Carbon;
use App\Models\Sms;
use App\Modules\Core\BaseRepository;

class SmsRepository extends BaseRepository
{
    public function __construct(Sms $sms)
    {
        parent::__construct($sms);
    }

    /**
     * @param string $mobilePhone
     * @param string $code
     * @return mixed
     */
    public function getSmsWithPhoneNCode(string $mobilePhone, string $code)
    {
        return $this->model
            ->where([
                ['mobile_phone', $mobilePhone],
                ['message_body', $code],
            ])
            ->first();
    }

    /**
     * @return mixed
     */
    public function removeUnactualSms()
    {
        return $this->model
            ->where('created_at', '<', Carbon::now()->subMinutes(5)->toDateTimeString())
            ->delete();
    }
}
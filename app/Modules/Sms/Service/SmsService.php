<?php

namespace App\Modules\Sms\Service;

use App\Modules\Sms\Repository\SmsRepository;

class SmsService
{
    /**
     * @var SmsRepository
     */
    private $smsRepository;

    public function __construct(SmsRepository $smsRepository)
    {
        $this->smsRepository = $smsRepository;
    }

    /**
     * @param array $params
     */
    public function save(array $params)
    {
        $this->smsRepository->save($params);
    }

    public function isValidCode(string $mobilePhone, string $code)
    {
        $isValid = $this->smsRepository->getSmsWithPhoneNCode($mobilePhone, $code);

        if ($isValid) {
            return true;
        }

        return false;
    }

    public function removeUnactualSms()
    {
        $this->smsRepository->removeUnactualSms();
    }
}
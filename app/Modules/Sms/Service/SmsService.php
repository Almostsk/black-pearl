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

    /**
     * @param string $mobilePhone
     * @param string $code
     * @return bool
     */
    public function isValidCode(string $mobilePhone, string $code)
    {
        $isValid = $this->smsRepository->getSmsWithPhoneNCode($mobilePhone, $code);

        if ($isValid) {
            return true;
        }

        return false;
    }

    /**
     * Removes Sms that are not likely to be passed by
     */
    public function removeUnactualSms()
    {
        $this->smsRepository->removeUnactualSms();
    }

    /**
     * @param string $mobilePhone
     * @param string $code
     */
    public function removeCurrentCode(string $mobilePhone, string $code)
    {
        $this->smsRepository->removeEntityByCodeNPhone($mobilePhone, $code);
    }
}
<?php

namespace App\Http\Services\StartMobile\Service;

use App\Http\Services\StartMobile\Repository\SmsRepository;
use App\Http\Services\StartMobile\Response\SmsResponse as Response;

class SmsService
{
    private $smsRepository;

    public function __construct(SmsRepository $smsRepository)
    {
        $this->smsRepository = $smsRepository;
    }

    public function sendMessage(int $code, string $number)
    {
        $this->smsRepository
            ->setNumberTo('+' . $number)
            ->setMessageBody($code);

        $response = $this->smsRepository->sendSms();
        return $response;
        //return new Response($response->getBody()->getContents());
    }
}
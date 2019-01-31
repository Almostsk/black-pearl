<?php

namespace App\Http\Api\StartMobile\Service;

use App\Http\Api\StartMobile\Repository\SmsRepository;
use App\Http\Api\StartMobile\Response\SmsResponse as Response;

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
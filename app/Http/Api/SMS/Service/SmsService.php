<?php

namespace App\Http\Api\SMS\Service;

use App\Http\Api\SMS\Response\SmsResponse as Response;
use App\Http\Api\SMS\Repository\SmsRepository;

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
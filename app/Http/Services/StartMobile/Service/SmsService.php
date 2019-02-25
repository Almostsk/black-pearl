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

    /**
     * @param string $message
     * @param string $number
     * @return Response
     */
    public function sendMessage(string $message, string $number): Response
    {
        $this->smsRepository
            ->setNumberTo($number)
            ->setMessageBody($message);

        $response = $this->smsRepository->sendSms();

        return new Response($response);
    }
}
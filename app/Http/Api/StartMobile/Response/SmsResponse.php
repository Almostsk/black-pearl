<?php

namespace App\Http\Api\StartMobile\Response;


class SmsResponse
{
    const ACCEPTED = 'Accepted';
    const ENROUTE = 'Enroute';
    const DELIVERED = 'Delivered';
    const EXPIRED = 'Expired';
    const DELETED = 'Deleted';
    const UNDELIVERABLE = 'Undeliverable';
    const REJECTED = 'Rejected';
    const UNKNOWN = 'Unknown';

    /**
     * Status sent by response
     *
     * @var string
     */
    private $status;

    /**
     * Explanation of the status
     *
     * @var string
     */
    private $statusMessage;

    public function __construct(string $xml)
    {
        $xml = simplexml_load_string($xml);

        if ($status = $xml['status']['state']){
            $this->setStatus($status);
            $this->setStatusMessage(config('sms.statuses.' . $status));
        }

    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatusMessage(): string
    {
        return $this->statusMessage;
    }

    /**
     * @param string $status
     */
    public function setStatusMessage(string $statusMessage): void
    {
        $this->statusMessage = $statusMessage;
    }
}
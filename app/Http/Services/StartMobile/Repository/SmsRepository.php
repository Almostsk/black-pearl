<?php

namespace App\Http\Services\StartMobile\Repository;

use Spatie\ArrayToXml\ArrayToXml;
use App\Http\Services\Core\BaseRepository;

class SmsRepository extends BaseRepository
{
    /**
     * Type of the SMS dispatch. By default single messaging
     *
     * @var string
     */
    private $serviceId = 'single';

    /**
     * Time the messaging starts. If null the messaging starts as soon as possible
     *
     * @var string
     */
    private $startTime;

    /**
     * Date when the dispatch becomes invalid (not actual)
     *
     * @var string
     */
    private $validity = '+2 hour';

    /**
     * The mobile number message is sent from
     *
     * @var mixed
     */
    private $source = 'BLACK PEARL';

    /**
     * Phone number the message has to be sent to
     *
     * @var string
     */
    private $numberTo;

    /**
     * The body of the message
     *
     * @var string
     */
    private $messageBody;

    /**
     * Type of the content send by SMS
     *
     * @var string
     */
    private $contentType = 'plain/text';

    /**
     * SMS encoding
     *
     * @var string
     */
    private $encoding = 'plain';

    /**
     * Host of the URL
     *
     * @var string
     */
    protected $hostUrl = 'https://dmuraviova:H5Fur6WY@bulk.startmobile.ua/clients.php';

    /**
     * @var string
     */
    private $login = 'dmuraviova';

    /**
     * @var string
     */
    private $password = 'H5Fur6WY';

    /**
     * @return string
     */
    public function getServiceId(): string
    {
        return $this->serviceId;
    }

    /**
     * @param string $serviceId
     * @return SmsRepository
     */
    public function setServiceId(string $serviceId): SmsRepository
    {
        $this->serviceId = $serviceId;

        return $this;
    }

    /**
     * @return string
     */
    private function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    private function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getStartTime(): string
    {
        return $this->startTime;
    }

    /**
     * @param string $startTime
     * @return SmsRepository
     */
    public function setStartTime(string $startTime): SmsRepository
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * @return string
     */
    public function getValidity(): string
    {
        return $this->validity;
    }

    /**
     * @param string $validity
     * @return SmsRepository
     */
    public function setValidity(string $validity): SmsRepository
    {
        $this->validity = $validity;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param int $source
     * @return SmsRepository
     */
    public function setSource(int $source): SmsRepository
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumberTo(): string
    {
        return $this->numberTo;
    }

    /**
     * @param string $numberTo
     * @return SmsRepository
     */
    public function setNumberTo(string $numberTo): SmsRepository
    {
        $this->numberTo = $numberTo;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessageBody(): string
    {
        return $this->messageBody;
    }

    /**
     * @param string $messageBody
     * @return SmsRepository
     */
    public function setMessageBody(string $messageBody): SmsRepository
    {
        $this->messageBody = $messageBody;

        return $this;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     * @return SmsRepository
     */
    public function setContentType(string $contentType): SmsRepository
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * @return string
     */
    public function getEncoding(): string
    {
        return $this->encoding;
    }

    /**
     * @param string $encoding
     * @return SmsRepository
     */
    public function setEncoding(string $encoding): SmsRepository
    {
        $this->encoding = $encoding;

        return $this;
    }

    /**
     * Formats array in a proper way to build an XML after
     *
     * @return array
     */
    protected function formArrayFormat()
    {
        return [
            'service' => [
                '_attributes' => [
                    'id'        => $this->getServiceId(),
                    //'start'     => $this->getStartTime(),
                    //'validity'  => $this->getValidity(),
                    'source'    => $this->getSource(),
                ]
            ],
            'to' => $this->getNumberTo(),
            'body' => [
                '_attributes' => [
                    'content-type' => $this->getContentType(),
                    'encoding'     => $this->getEncoding()
                ],
                '_value' => $this->getMessageBody()
            ]
        ];
    }

    /**
     * Builds XML to send to the sms dispatch service.
     *
     * @return string
     */
    protected function buildXML()
    {
        return ArrayToXml::convert($this->formArrayFormat(), [
            'rootElementName' => 'message'
        ]);
    }

    public function sendSms()
    {
        return $this->execute($this->buildXML(), $this->hostUrl);
    }

    public function execute($data, $url)
    {

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: text/xml;charset=utf-8;'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: text/xml'));
        curl_setopt($ch, CURLOPT_USERPWD, $this->getLogin().":".$this->getPassword());
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $return = curl_exec($ch);
        curl_close($ch);

        return $return;
    }

}
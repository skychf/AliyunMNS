<?php

namespace Skychf\AliyunMNS;

use AliyunMNS\Client;
use AliyunMNS\Topic;
use AliyunMNS\Constants;
use AliyunMNS\Model\MailAttributes;
use AliyunMNS\Model\SmsAttributes;
use AliyunMNS\Model\BatchSmsAttributes;
use AliyunMNS\Model\MessageAttributes;
use AliyunMNS\Exception\MnsException;
use AliyunMNS\Requests\PublishMessageRequest;

class Sms
{
    private $endPoint;

    private $accessId;

    private $accessKey;

    private $topicName;

    private $smsSignName;

    private $smsTemplateCode;

    private $client;

    function __construct()
    {
        $this->endPoint = config('aliyunmns.end_point');
        $this->accessId = config('aliyunmns.access_id');
        $this->accessKey = config('aliyunmns.access_key');
        $this->topicName = config('aliyunmns.topic_name');
        $this->smsSignName = config('aliyunmns.sms_sign_name');
        $this->smsTemplateCode = config('aliyunmns.sms_template_code');
    }

    public function send($mobile, $sms_template_param = [])
    {
        $this->client = new Client($this->endPoint, $this->accessId, $this->accessKey);
        $topic = $this->client->getTopicRef($this->topicName);

        $batchSmsAttributes = new BatchSmsAttributes($this->smsSignName,$this->smsTemplateCode);

        $batchSmsAttributes->addReceiver($mobile, $sms_template_param);

        $messageAttributes = new MessageAttributes(array($batchSmsAttributes));

        $messageBody = "smsmessage";

        $request = new PublishMessageRequest($messageBody, $messageAttributes);

        try {
            $res = $topic->publishMessage($request);
            return $res->isSucceed();
        } catch (MnsException $e) {
            return false;
        }
    }
}
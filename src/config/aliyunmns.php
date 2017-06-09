<?php
return [
    'end_point'         => env('ALIYUN_END_POINT', null),
    'access_id'         => env('ALIYUN_ACCESS_ID', null),
    'access_key'        => env('ALIYUN_ACCESS_KEY', null),
    'topic_name'        => env('ALIYUN_TOPIC_NAME', 'sms.topic-cn-hangzhou'),
    'sms_sign_name'     => env('ALIYUN_SMS_SIGN_NAME',null),
    'sms_template_code' => env('ALIYUN_SMS_TEMPLATE_CODE',null)
];
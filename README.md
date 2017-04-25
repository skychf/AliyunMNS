# AliyunMNS - For Laravel5
---
###配置方法:
1. 从终端或命令行进入您的项目目录,运行
```
composer require skychf/aliyunmns
```
2. 将
```
Skychf\AliyunMNS\AliyunMnsServiceProvider::class
```
加入config\app.php的Providers下
类似
```
        ...
        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        ...
        Skychf\AliyunMNS\AliyunMnsServiceProvider::class

```
3. 运行
```
php artisan vendor:publish
```
将配置文件发布到您的配置目录中

4. 您的config目录应该增加了aliyunmns.php配置文件
```php
<?php
    return [
        'end_point' => env('ALIYUN_END_POINT', null),
        'access_id' => env('ALIYUN_ACCESS_ID', null),
        'access_key' => env('ALIYUN_ACCESS_KEY', null),
        'topic_name' => env('ALIYUN_TOPIC_NAME', 'sms.topic-cn-hangzhou'),
        'sms_sign_name' => env('ALIYUN_SMS_SIGN_NAME',null),
        'sms_template_code' => env('ALIYUN_SMS_TEMPLATE_CODE',null)
    ];
```

---
###开始使用
1. 在您需要调用短信服务的控制器中,引用SMS
```
    use Skychf\AliyunMNS\Sms;
```

```php

    public function index(Sms $sms)
    {
        $template_args = ["code" => "1234"];
        $result = $sms->send($mobile, $template_args);
    }

```
2. 返回执行发送的结果
---

###参数说明
在开始使用中 send 方法一共加入了2个参数
>$mobile,$template_args

1. $mobile 指接受短信方的短信号码,
2. $template_args 数组,数组键值为模板变量;
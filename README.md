# ycc-sdk
易催催SDK

## 安装方法
composer require huang007guo/ycc-sdk

## 使用方法
```php
$yccSdk = new YccSdk($app_key, $appSecret);
$accessToken = $yccSdk->getAccessToken();
$apiTestResult = $yccSdk->IApiTest();
```

## 通过自己accessToken(中控服务器)使用
```php
$yccSdk = new YccSdk();
$accessToken = $yccSdk->setAccessToken($accessToken);
$apiTestResult = $yccSdk->IApiTest();
```
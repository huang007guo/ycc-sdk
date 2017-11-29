<?php
/**
 * Created by PhpStorm.
 * User: Hank
 * Date: 2017/11/29 0029
 * Time: 下午 15:17
 */

namespace Huang007guo\YccSdk\Lib\Http;


interface HttpClientInterface
{
    public function get($url, $param);
    public function post($url, $param);
    public function postFile($url, $param);
}
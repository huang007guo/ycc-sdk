<?php
/**
 * Created by PhpStorm.
 * User: Hank
 * Date: 2017/11/29 0029
 * Time: 下午 15:02
 */

namespace Huang007guo\YccSdk\Constant;


abstract class UrlBase
{
    public static $host = '';
    public static function getUrl($uri){
        return static::$host . '/' . $uri;
    }
}
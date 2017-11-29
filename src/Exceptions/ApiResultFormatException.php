<?php
/**
 * Created by PhpStorm.
 * User: Hank
 * Date: 2017/11/29 0029
 * Time: 下午 14:33
 */

namespace Huang007guo\YccSdk\Exceptions;
use Exception;

/**
 * 这个异常代表 返回的格式错误 正确的格式应该类似于'{"code":1000, "msg":"success", "data":[]}'
 * Class ApiResultException
 * @package Huang007guo\YccSdk\Exceptions
 */
class ApiResultFormatException extends \Exception  implements YccSdkException
{
    protected $rawResponseBody = null;

    public function __construct($message, $code, $rawResponseBody)
    {
        parent::__construct($message, $code, null);
    }

    public static function throwErr($rawResponseBody, $message = 'Api Result Format Error', $code = 0){
        throw new static($message, $code, $rawResponseBody);
    }
}
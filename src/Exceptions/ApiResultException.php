<?php
/**
 * Created by PhpStorm.
 * User: Hank
 * Date: 2017/11/29 0029
 * Time: 下午 14:33
 */

namespace Huang007guo\YccSdk\Exceptions;

/**
 * 这个异常代表 返回格式正确 但是 code != 1000(Code::GOD_BLESS_YOU)或者没有相关接口定义的必要值 的情况
 * Class ApiResultException
 * @package Huang007guo\YccSdk\Exceptions
 */
class ApiResultException extends \Exception  implements YccSdkException
{
    protected $data = null;

    public function __construct($message, $code, $data = null)
    {
        parent::__construct($message, $code);
        $this->data = $data;
    }
    public function getData(){
        return $this->data;
    }

    public static function throwErr($code, $message = 'Api Result Error', $data = null){
        throw new static($message, $code, $data);
    }
}
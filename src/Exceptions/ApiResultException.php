<?php
/**
 * Created by PhpStorm.
 * User: Hank
 * Date: 2017/11/29 0029
 * Time: 下午 14:33
 */

namespace Huang007guo\YccSdk\Exceptions;

/**
 * 这个异常代表 返回格式正确但是 code != 1000(Code::GOD_BLESS_YOU) 的情况
 * Class ApiResultException
 * @package Huang007guo\YccSdk\Exceptions
 */
class ApiResultException extends \Exception  implements YccSdkException
{

}
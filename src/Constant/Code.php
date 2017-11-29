<?php
/**
 * Created by PhpStorm.
 * User: Hank
 * Date: 2017/11/29 0029
 * Time: 下午 14:37
 */

namespace Huang007guo\YccSdk\Constant;


class Code
{
    const GOD_BLESS_YOU = 1000;

    const NOT_LOGIN = 400;
    const ARG_INVALID = 401;
    const NOT_PERMISSION= 403;
    const NOT_DATA= 406;

    const FAIL = 501;
    //业务类-----------------
    const APP_NOT_EXIST = 600;
    const APP_STATUS_NOT_OPEN = 601;
    const APP_SECRET_ERROR = 602;
    const APP_ACCESS_TOKEN_ERROR = 603;
    const APP_APP_API_NOT_PERMISSION = 604;
    const APP_API_NOT_OPEN = 605;
    const PLATFORM_NOT_EXIST = 606;

}
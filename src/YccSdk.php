<?php
/**
 * Created by PhpStorm.
 * User: Hank
 * Date: 2017/11/29 0029
 * Time: 下午 14:27
 */

namespace Huang007guo\YccSdk;



use Huang007guo\YccSdk\Constant\IUrl;
use Huang007guo\YccSdk\Lib\Http\HttpClientYcc;

class YccSdk
{
    const GRANT_TYPE_CLIENT_CREDENTIAL = 'client_credential';

    protected $_accessToken;
    // accessToken 的过期时间戳 这个值为null 代表不考虑过期时间
    protected $_accessTokenExpiresTime;
    /**
     * @var HttpClientYcc
     */
    protected $_httpClient;
    protected $_appKey = '';
    protected $_appSecret = '';

    public function __construct($appKey = '', $appSecret = '')
    {
        $this->_appKey = $appKey;
        $this->_appSecret = $appSecret;
    }
    /**
     *
     */
    public function getAccessToken(){
        if(!$this->_accessToken ||
            ($this->_accessTokenExpiresTime !== null && $this->_accessTokenExpiresTime < time())){
            // 这里重新获取_accessToken
            $requestUrl = $this->getIUrl(IUrl::ACCESS_TOKEN);
            $this->_httpClient->get($requestUrl, [
                'app_key' => $this->_appKey,
                'app_secret' => $this->_appSecret,
                'grant_type' => self::GRANT_TYPE_CLIENT_CREDENTIAL
            ]);
        }
    }
    protected function getIUrl($uri){
        return IUrl::getUrl($uri);
    }
}
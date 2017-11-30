<?php
/**
 * Created by PhpStorm.
 * User: Hank
 * Date: 2017/11/29 0029
 * Time: 下午 14:27
 */

namespace Huang007guo\YccSdk;



use Huang007guo\YccSdk\Constant\Code;
use Huang007guo\YccSdk\Constant\IUrl;
use Huang007guo\YccSdk\Exceptions\ApiResultException;
use Huang007guo\YccSdk\Lib\Http\HttpClientYcc;

class YccSdk
{
    const GRANT_TYPE_CLIENT_CREDENTIAL = 'client_credential';

    protected $_accessToken;
    // accessToken 的过期时间戳 这个值为null时代表不考虑过期时间
    protected $_accessTokenExpiresTime;
    /**
     * @var HttpClientYcc
     */
    protected $_httpClientYcc;
    protected $_appKey = '';
    protected $_appSecret = '';

    public function __construct($appKey = '', $appSecret = ''){
        $this->_appKey = $appKey;
        $this->_appSecret = $appSecret;
        $this->_httpClientYcc = new HttpClientYcc($this);
    }

    /**
     * 获取 AccessToken
     * 会自动刷新 AccessToken
     * @return string
     */
    public function getAccessToken(){
        if(!$this->_accessToken ||
            ($this->_accessTokenExpiresTime !== null && $this->_accessTokenExpiresTime < time())){
            $this->refreshAccessToken();
        }
        return $this->_accessToken;
    }
    /**
     * 刷新 AccessToken
     */
    public function refreshAccessToken(){
        // 这里重新获取_accessToken
        $requestUrl = $this->getIUrl(IUrl::ACCESS_TOKEN);
        $result = $this->_httpClientYcc->get($requestUrl, [
            'app_key' => $this->_appKey,
            'app_secret' => $this->_appSecret,
            'grant_type' => self::GRANT_TYPE_CLIENT_CREDENTIAL
        ]);
        if (empty($result['access_token']) || empty($result['expires_in'])){
            ApiResultException::throwErr(Code::RET_ARG_ERROR, 'Api Result Error', $result);
        }
        // 设置accessToken,过期时间; 过期时间预留10秒
        $this->setAccessToken($result['access_token'], (time() + $result['expires_in'] - 10));
    }
    /**
     * @param $accessToken
     * @param $accessTokenExpiresTime int|null 凭证有效时间，单位：秒 这个值为null时代表不考虑过期时间
     */
    public function setAccessToken($accessToken, $accessTokenExpiresTime = null){
        $this->_accessToken = $accessToken;
        $this->_accessTokenExpiresTime = $accessTokenExpiresTime;
    }
    protected function getIUrl($uri){
        return IUrl::getUrl($uri);
    }
}
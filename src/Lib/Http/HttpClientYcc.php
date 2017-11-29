<?php
/**
 * Created by PhpStorm.
 * User: Hank
 * Date: 2017/11/29 0029
 * Time: 下午 15:17
 */

namespace Huang007guo\YccSdk\Lib\Http;


use GuzzleHttp\Client;
use Huang007guo\YccSdk\Constant\Code;
use Huang007guo\YccSdk\Exceptions\ApiResultException;
use Huang007guo\YccSdk\Exceptions\ApiResultFormatException;
use Huang007guo\YccSdk\YccSdk;

class HttpClientYcc implements HttpClientInterface
{
    /**
     * @var Client
     */
    protected $httpHandler;
    /**
     * @var YccSdk
     */
    protected $yccSdk;
    public function __construct(YccSdk $yccSdk = null)
    {
        $this->httpHandler = new Client();
        $this->yccSdk = $yccSdk;
    }
    public function setYccSdk(YccSdk $yccSdk)
    {
        $this->yccSdk = $yccSdk;
    }

    public function get($url, $param){
        $resultData = $this->request('get', $url, [
            'query' => $param,
        ]);
        return $resultData;
    }
    public function post($url, $param){
        $resultData = $this->request('post', $url, [
            'form_params' => $param,
        ]);
        return $resultData;
    }
    public function postFile($url, $param){
        $multipart = [];
        foreach ($param as $key => $value) {
            $multipart[] = [
                'name' => $key,
                'contents' => $value,
            ];
        }
        $resultData = $this->request('post', $url, [
            'multipart' => $multipart,
        ]);
        return $resultData;
    }

    /**
     * 请求 api
     * @param $method
     * @param string $uri
     * @param array $options
     * @return mixed 成功返回 result['data']
     * @throws ApiResultFormatException json_decode 后没有code 抛出异常
     * @throws ApiResultException json_decode 后没有code!=Code::GOD_BLESS_YOU  抛出异常
     */
    protected function request($method, $uri = '', array $options = []){
        $baseOpt = [
            'headers' => [
                'X-Ycc-Access-Token'=>$this->yccSdk->getAccessToken(),
                'Accept'=>'application/json',
            ]
        ];
        $options = array_merge($baseOpt, $options);
        $response = $this->httpHandler->request($method, $uri, $options);
        $rawResponseBody = $response->getBody();
        $result = json_decode($rawResponseBody, true);
        if(!isset($result['code'])){
            ApiResultFormatException::throwErr($rawResponseBody);
        }
        if($result['code'] != Code::GOD_BLESS_YOU){
            ApiResultException::throwErr(
                $result['code'],
                isset($result['msg']) ? $result['msg'] : '',
                isset($result['data']) ? $result['data'] : null
            );
        }
        return isset($result['data']) ? $result['data'] : true;
    }
}
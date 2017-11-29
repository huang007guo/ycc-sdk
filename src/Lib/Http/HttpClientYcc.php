<?php
/**
 * Created by PhpStorm.
 * User: Hank
 * Date: 2017/11/29 0029
 * Time: 下午 15:17
 */

namespace Huang007guo\YccSdk\Lib\Http;


use GuzzleHttp\Client;
use Huang007guo\YccSdk\Exceptions\ApiResultFormatException;

class HttpClientYcc implements HttpClientInterface
{
    /**
     * @var Client
     */
    protected $httpHandler;
    protected $accessToken = '';
    public function __construct()
    {
        $this->httpHandler = new Client();
    }

    public function get($url, $param){
        $result = $this->request('get', $url, [
            'query' => $param,
        ]);
        return $result;
    }
    public function post($url, $param){
        $result = $this->request('post', $url, [
            'form_params' => $param,
        ]);
        return $result;
    }
    public function postFile($url, $param){
        $multipart = [];
        foreach ($param as $key => $value) {
            $multipart[] = [
                'name' => $key,
                'contents' => $value,
            ];
        }
        $result = $this->request('post', $url, [
            'multipart' => $multipart,
        ]);
        return $result;
    }
    protected function request($method, $uri = '', array $options = []){
        $baseOpt = [
            'headers' => [
                'X-Ycc-Access-Token'=>$this->accessToken,
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
        return $result;
    }
}
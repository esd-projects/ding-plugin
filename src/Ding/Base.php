<?php

namespace ESD\Plugins\Ding;

use ESD\Core\Plugins\Logger\GetLogger;
use Monolog\Logger;
use Swlib\Http\ContentType;
use Swlib\Saber;

/**
 * Class BaseObject
 * @package Jormin\Qiniu
 */
class Base
{
    /**
     * @var Saber
     */
    private static $http_client;


    const API_URL = "https://oapi.dingtalk.com";
    /**
     * @var string
     */
    private $hook;

    use GetLogger;
    /**
     * Base constructor.
     * @param DingConfig $dingConfig
     */
    public function __construct(DingConfig $dingConfig)
    {
        $this->hook = "/robot/send?access_token=" . $dingConfig->getToken();
    }

    /**
     * 发送消息
     * @param $data
     *
     * @return void
     *
     */
    protected function send($data)
    {
        $response = self::client()->post($this->hook,json_encode($data),['headers' => ['content-type' => ContentType::JSON]]);
        if ($response->success) {
            $this->log(Logger::INFO,"钉钉通知成功");
        }else{
            $this->log(Logger::ERROR,$response);
        }
    }

    /**
     * 获取一个协程客户端
     * @return Saber 返回客户端
     */
    private static function client(): Saber
    {
        if (empty(self::$http_client)) {
            self::$http_client = Saber::create([
                'base_uri' => self::API_URL,
                'use_pool' => true,
                'timeout' => 1,
            ]);
        }
        return self::$http_client;
    }
}

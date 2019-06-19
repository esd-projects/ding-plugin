<?php
/**
 * ClassDescription
 * @author qap <qiuapeng921@163.com>
 * @link http://127.0.0.1:8000/index
 * @Date 19-6-19 上午10:24
 */

namespace ESD\Plugins\Ding;


use ESD\Core\Plugins\Config\BaseConfig;

/**
 * Class DingConfig
 * @package ESD\Plugins\Ding
 */
class DingConfig extends BaseConfig
{
    /**
     *
     */
    const key = "ding";

    /**
     * @var
     */
    protected $token;

    /**
     * DingConfig constructor.
     */
    public function __construct()
    {
        parent::__construct(self::key);
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token): void
    {
        $this->token = $token;
    }
}

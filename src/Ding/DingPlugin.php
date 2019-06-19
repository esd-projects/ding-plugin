<?php
/**
 * ClassDescription
 * @author qap <qiuapeng921@163.com>
 * @link http://127.0.0.1:8000/index
 * @Date 19-6-19 上午10:21
 */

namespace ESD\Plugins\Ding;

use ESD\Core\Context\Context;
use ESD\Core\PlugIn\AbstractPlugin;
use ESD\Core\PlugIn\PluginInterfaceManager;
use ESD\Core\Plugins\Config\ConfigException;
use ReflectionException;

class DingPlugin extends AbstractPlugin
{
    /**
     * @var DingConfig
     */
    private $dingConfig;


    /**
     * 获取插件名字
     * @return string
     */
    public function getName(): string
    {
        return "Ding";
    }

    /**
     * DingPlugin constructor.
     * @param DingConfig|null $dingConfig
     */
    public function __construct(?DingConfig $dingConfig = null)
    {
        parent::__construct();
        if ($dingConfig == null) {
            $dingConfig = new DingConfig();
        }
        $this->dingConfig = $dingConfig;
    }

    /**
     * @param PluginInterfaceManager $pluginInterfaceManager
     * @return mixed|void
     */
    public function onAdded(PluginInterfaceManager $pluginInterfaceManager)
    {
        parent::onAdded($pluginInterfaceManager);
    }

    /**
     * init
     * @param Context $context
     *
     * @return mixed|void
     *
     * @throws ConfigException
     * @throws ReflectionException
     */
    public function init(Context $context)
    {
        parent::init($context);
        $this->dingConfig->merge();
    }

    /**
     * beforeServerStart
     * @param Context $context
     *
     * @return mixed|void
     *
     */
    public function beforeServerStart(Context $context)
    {
    }

    /**
     * 在进程启动前
     * @param Context $context
     *
     * @return mixed|void
     *
     */
    public function beforeProcessStart(Context $context)
    {
        $this->ready();
    }
}

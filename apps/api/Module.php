<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 2017/8/24
 * Time: 16:11
 */

namespace BBSMS\API;

use BBSMS\Listener\APICheckIPListener;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    /**
     * 注册自定义加载器
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces(
            [
                "BBSMS\\API\\Controller" => APP_PATH."/api/controllers/",
            ]
        );

        $loader->register();

    }

    /**
     * 注册自定义服务
     */
    public function registerServices(DiInterface $di)
    {
        //事件管理器
        $eventsManager =$di->getShared('eventsManager');
        //分发器
        $dispatcher = new Dispatcher();
        $dispatcher->setEventsManager($eventsManager);
        //在进行环分发之前检查访问者ip
        $eventsManager->attach('dispatch:beforeDispatch',new APICheckIPListener());

        //默认的命名空间
        $dispatcher->setDefaultNamespace("BBSMS\\API\\Controller");

        // Registering a dispatcher
        $di->set(
            "dispatcher",
            $dispatcher
        );
    }
}
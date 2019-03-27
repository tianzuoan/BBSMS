<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 2017/8/24
 * Time: 16:11
 */

namespace BBSMS\Home;

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
                "BBSMS\\Home\\Controller" => APP_PATH."/home/controllers/",
                "BBSMS\\Home\\Model" => APP_PATH."/home/models/",
            ]
        );


        $loader->register();
    }

    /**
     * 注册自定义服务
     */
    public function registerServices(DiInterface $di)
    {
        $dispatcher = new Dispatcher();

        $dispatcher->setDefaultNamespace("BBSMS\\Home\\Controller");


        //Registering a dispatcher
        $di->set(
            "dispatcher",
            $dispatcher
        );
    }
}
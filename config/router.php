<?php

/** @var \Phalcon\Mvc\Router $router */
$router = $di->getRouter();

// Define your routes here
$router->setDefaultModule('home');
//默认路由,默认访问home模块下的index控制器下的index函数
$router->add(
    "/",
    [
        "module"=>'home',
        "controller" => "index",
        "action"     => "index",
    ]
);
//默认路由,默认访问各模块下的Index控制器下的index函数
$router->add(
    "/:module",
    [
        "module"=>1,
        "controller" => "Index",
        "action"     => "index",
    ]
);
////默认路由,默认访问各模块下的各控制器下的index函数
$router->add(
    "/:module/:controller",
    [
        "module"=>1,
        "controller" => 2,
        "action"     => "index",
    ]
);

//总路由
$router->add(
    '/:module/:controller/:action/:params',
    [
        'module'=>1,
        "controller" => 2,
        "action"     => 3,
        "params"     => 4,
    ]
);
// Set 404 paths,以上所有路由不匹配
$router->notFound(
    [
        'module'=>'home',
        'controller' => 'Error',
        'action'     => 'http404',
    ]
);

$router->handle();



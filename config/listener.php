<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 2017/8/29
 * Time: 16:37
 */
use BBSMS\Event\APIRootEvent;
use BBSMS\Listener\APIRootListener;
$eventsManager =$di->getShared('eventsManager');
// 建立事件管理器以为收集结果响应
$eventsManager->collectResponses(true);

// 短信api模块中的根部(Index控制器)访问事件的侦听者，即通过通用的api接口使用阿里云短信服务
$eventsManager->attach(
    APIRootEvent::class.':before',
    new APIRootListener()
);


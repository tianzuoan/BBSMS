<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 2017/8/30
 * Time: 19:59
 */

namespace BBSMS\Listener;
use HJ100\BBSMS\SMSError;
use HJ100\BBSMS\SMSResult;
use Phalcon\Config;
use Phalcon\Dispatcher;
use Phalcon\Events\Event;

class APICheckIPListener
{

    /**
     * //在执行环分发前
     * @param Event $event
     * @param Dispatcher $dispatcher
     */
    public function beforeDispatch(Event $event, Dispatcher $dispatcher)
    {
        //进到这里的都是访问api模块的
        $uip=$_SERVER['REMOTE_ADDR'];
        
        $logger=$dispatcher->getDI()->getShared('logger');
        
        $logger->info('ip:'.$uip);
        
//        $config=$dispatcher->getDI()->getShared('config');
//        if (!in_array($uip,$config->acl->api->hostnames->toArray())){
//            //不在访问列表里面
//            $re = new SMSResult();
//            $re->code=SMSError::E;
//            $re->message='您没有使用权限';
//            exit(json_encode($re));
//        }


    }
}
<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 2017/8/29
 * Time: 16:01
 */

namespace BBSMS\Listener;

use Phalcon\Events\Event;

interface IListener
{
    /**
     * 某一操作之前
     * @param Event $event 事件类型
     * @param $source  产生事件的来源
     * @return mixed
     */
    public function before(Event $event, $source);

    /**
     * 某一操作之后
     * @param Event $event 事件类型
     * @param $source  产生事件的来源
     * @return mixed
     */
    public function after(Event $event, $source);

}
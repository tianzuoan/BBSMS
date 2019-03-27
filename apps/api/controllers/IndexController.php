<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 2017/8/29
 * Time: 10:05
 */

namespace BBSMS\API\Controller;
use BBSMS\ISMS;

class IndexController extends BaseController
{
    /**
     * api 中的顶层接口，所有的短信发送都可以通过这个接口发送
     */
    public function indexAction()
    {
        /** @var ISMS $smser */
        $smser = $this->getDI()->getShared('smser');
        $result = $smser->send($this->getApp(), $this->getTempId(),$this->getPhoneNumbers(),
            $this->getTempParam(false));
        return json_encode($result);
    }

    
}
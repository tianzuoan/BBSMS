<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 2017/8/25
 * Time: 15:31
 */

namespace BBSMS\API\Controller;

use BBSMS\SMS;
use Phalcon\Mvc\Controller;

/*
 * 短信验证码
 */
class CommonController extends BaseController
{

    /**
     * 获取短信验证码
     */
    public function indexAction()
    {
        /** @var SMS $smser */
        $smser=$this->di->getShared('smser');
        $re=$smser->sendCommonCode($this->getPhoneNumbers(),$this->getCode());
        return json_encode($re);
    }
    
}
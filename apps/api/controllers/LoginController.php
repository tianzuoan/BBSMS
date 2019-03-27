<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 2017/8/28
 * Time: 18:14
 */

namespace BBSMS\API\Controller;
use BBSMS\ISMS;
use BBSMS\SMS;

/**
 * Class LoginController
 * @package BBSMS\API\Controller
 */
class LoginController extends BaseController
{
    /**
     * 发送注册验证码
     */
    public function indexAction()
    {
        /** @var ISMS $smser */
        $smser=$this->di->getShared('smser');
        $re=$smser->sendLoginCode($this->getPhoneNumbers(),$this->getCode(),$this->getProduct());
        return json_encode($re);
    }
    
    
}
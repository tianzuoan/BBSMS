<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 2017/8/28
 * Time: 18:14
 */

namespace BBSMS\API\Controller;
use BBSMS\SMS;

/**
 * Class EditPasswordController
 * @package BBSMS\API\Controller
 */
class EditpasswordController extends BaseController
{
    /**
     * 发送注册验证码
     */
    public function indexAction()
    {
        /** @var SMS $smser */
        $smser=$this->di->getShared('smser');
        $re=$smser->sendEditPasswordCode($this->getPhoneNumbers(),$this->getCode(),$this->getProduct());
        return json_encode($re);
    }
    
    
}
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
 * Class AuthenticateController
 * @package BBSMS\API\Controller
 */
class AuthenticateController extends BaseController
{
    /**
     * 发送发送身份验证验证码
     * 模板内容:验证码${code}，您正在进行${product}身份验证，打死不要告诉别人哦！
     */
    public function indexAction()
    {
        /** @var SMS $smser */
        $smser=$this->di->getShared('smser');
        $re=$smser->sendAuthenticateCode($this->getPhoneNumbers(),
            $this->getCode(),$this->getProduct(false));
        return json_encode($re);
    }
    
    
}
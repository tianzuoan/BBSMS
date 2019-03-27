<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 17-10-24
 * Time: 下午5:53
 */

namespace BBSMS\API\Controller;


use BBSMS\ISMS;

class ForgetpasswordController extends BaseController
{
    /**
     * 发送忘记密码
     */
    public function indexAction()
    {
        /** @var ISMS $smser */
        $smser=$this->di->getShared('smser');
        $re=$smser->sendEditPasswordCode($this->getPhoneNumbers(),$this->getCode());
        return json_encode($re);
    }
}
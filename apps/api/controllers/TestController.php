<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 2017/8/29
 * Time: 18:05
 */

namespace BBSMS\API\Controller;
use BBSMS\SMS;
use HJ100\BBSMS\SMSError;
use HJ100\BBSMS\SMSResult;
use Phalcon\Http\Response;

/**
 * 测试
 * Class TestController
 * @package BBSMS\API\Controller
 */
class TestController extends BaseController
{

    /**
     * 发送测试验证码
     */
    public function indexAction()
    {
        /** @var SMS $smser */
        $smser=$this->di->getShared('smser');
        $re=$smser->sendTest($this->getPhoneNumbers(),$this->getCustomer());
        return json_encode($re);
    }

    public function tAction(){
        $re=new SMSResult();
        $re->message='dd';
        $re->code=SMSError::NO_CODE;
//        $re->message=$this->getTest();
        echo '===';

    }

    public function t2Action(){
        $re=new SMSResult();
        $re->code=SMSError::NO_APPID;
        $re->message='999999999999';
        return json_encode($re);
    }
}


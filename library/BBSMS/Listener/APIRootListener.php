<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 2017/8/29
 * Time: 14:44
 */

namespace BBSMS\Listener;


use BBSMS\Error;
use Phalcon\Events\Event;

class APIRootListener implements IListener
{

    /**
     * 某一操作之前
     * @param Event $event 事件类型
     * @param $source  产生事件的来源
     * @return mixed
     */
    public function before(Event $event, $source)
    {
        // TODO: Implement before() method.
        $result =new \stdClass();
        $result->Code=Error::NO;
        $result->Message='成功！';

        if (isset($_REQUEST['PhoneNumbers'])) {//手机号
            $data['PhoneNumbers']=$_REQUEST['PhoneNumbers'];
        }else{
            $result->Code=Error::NO_PHONE;
            $result->Message='请填写手机号';
            return $result;
        }
        if (isset($_REQUEST['SignName'])) {//签名
            $data['SignName']=$_REQUEST['SignName'];
        }else{
            $result->Code=Error::NO_SIGNNAME;
            $result->Message='请填写签名';
            return $result;
        }

        if (isset($_REQUEST['TemplateCode'])) {
            $data['TemplateCode']=$_REQUEST['TemplateCode'];//模板id
        }else{
            $result->Code=Error::NO_TMPID;
            $result->Message='请填写模板ID';
            return $result;
        }
        if (isset($_REQUEST['TemplateParam'])) {
//            $data['TemplateParam']=str_replace('"','\\"',$_REQUEST['TemplateParam']);//模板内容
            $data['TemplateParam']=$_REQUEST['TemplateParam'];//模板内容
        }

        $result->data=$data;
        return $result;
    }

    /**
     * 某一操作之后
     * @param Event $event 事件类型
     * @param $source  产生事件的来源
     * @return mixed
     */
    public function after(Event $event, $source)
    {
        // TODO: Implement after() method.
        $result =new \stdClass();
        $result->Code=Error::NO;
        $result->Message='成功！';
        return $result;
    }
}
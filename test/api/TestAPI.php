<?php
require_once(dirname(__FILE__).'/../common.php');
require_once(dirname(__FILE__).'/../simpletest/autorun.php');
require_once(dirname(__FILE__).'/../simpletest/web_tester.php');
class TestGet extends WebTestCase {

    // function setUp(){
    //     $post['username']='18376725308';
    //     $post['password']='123456';
    //     $this->post(DOMAIN.'/index.php?g=user&m=Login&a=dologin',$post);
    // }

    /**
     * TestGet constructor.
     */
    function testAPI(){
        $post['PhoneNumbers']='18376725308';
        $post['SignName']='阿里云短信测试专用';
        $post['TemplateCode']='SMS_105650013';
        $post['TemplateParam']=array('customer'=>'123546',
            '');
        $this->post(DOMAIN.'/api',$post);
        $this->showText();
    }


}
echo 'test';
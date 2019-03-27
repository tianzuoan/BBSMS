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
    function testGet(){
        echo '=======================';
        $post['mt4account']='890800';
        $this->get(DOMAIN.'/api/code/get');
        $this->showText();
    }


}

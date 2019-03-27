<?php
require_once(dirname(__FILE__).'/../common.php');
require_once(dirname(__FILE__).'/../simpletest/autorun.php');
require_once(dirname(__FILE__).'/../simpletest/web_tester.php');
class TestMT4 extends WebTestCase {
    
    // function setUp(){
    //     $post['username']='18376725308';
    //     $post['password']='123456';
    //     $this->post(DOMAIN.'/index.php?g=user&m=Login&a=dologin',$post);
    // }
    
    /**
     * 修改密码
     *
     * @return void
     */
    function testResetpassword(){
        
    }
    
    /**
     * 仓位总结
     *
     * @return void
     */
    private function testwareSummary(){
        $post['mt4account']='890800';
        $this->get(DOMAIN.'/index.php?g=trade&m=trade&a=wareSummary',$post);
        $this->showText();
    }
    
    
}

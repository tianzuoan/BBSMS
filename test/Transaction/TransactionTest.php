<?php
require_once(dirname(__FILE__).'/../common.php');
require_once(dirname(__FILE__).'/../simpletest/autorun.php');
require_once(dirname(__FILE__).'/../simpletest/web_tester.php');
class TransactionTest extends WebTestCase {
    
    function setUp(){
        $post['username']='18376725308';
        $post['password']='123456';
        $this->post(DOMAIN.'/index.php?g=user&m=Login&a=dologin',$post);
    }
    
    function testwareSummary(){
        $post['mt4account']='890800';
        $this->get(DOMAIN.'/index.php?g=trade&m=trade&a=wareSummary',$post);
        $this->showText();
    }
    
    /**
     * Undocumented function
     * @access public
     * @return void
     * 
     */
    private function testverifyDeposit(){
        $post['money']=100;
        
        $this->post(DOMAIN.'/index.php?g=Transaction&m=Transaction&a=verifyDeposit',$post);
        
        $this->showText();
    }
    
    /**
     * Undocumented function
     * @return void
     */
    private function testD(){
        echo 'DDDDDDDDDDDDDDDDDD';
    }
}

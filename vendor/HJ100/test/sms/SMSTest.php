<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 17-9-25
 * Time: 下午8:59
 */
require_once(dirname(__FILE__) . '/../simpletest/autorun.php');
require_once(__DIR__ . '/../../autoloader.php');

class SMSTest extends UnitTestCase
{
    /**
     * @var \HJ100\BBSMS\SMS $sms
     */
    private $sms;

    function setUp()
    {
//        $this->sms = new HJ100\BBSMS\SMS(array('signName' => '阿里云短信测试专用',
//            'hostname' => 'bbsms.com',
//            'protocol' => 'http',
//            'port' => '80'));
        $this->sms = new HJ100\BBSMS\SMS(array('signName' => '阿里云短信测试专用'));
    }

    /**
     *
     */
    private function testSendTest()
    {
        $re = $this->sms->sendTest('18376725308', 'qhk');
        $this->assertEqual(\HJ100\BBSMS\SMSError::OK, $re->code);
    }

    private function testSendCommonCode()
    {
        $re = $this->sms->sendCommonCode('18376725308');
        $this->assertEqual(\HJ100\BBSMS\SMSError::OK, $re->code);
    }

    private function testsendAuthenticateCode()
    {
        $re = $this->sms->sendAuthenticateCode('18376725308');
        $this->assertEqual(\HJ100\BBSMS\SMSError::OK, $re->code);
    }

    private function testsendLoginCode()
    {
        $re = $this->sms->sendLoginCode('18376725308');
        $this->assertEqual(\HJ100\BBSMS\SMSError::OK, $re->code);
    }

    private function testsendRegisterCode()
    {
        $re = $this->sms->sendRegisterCode('18376725308');
        $this->assertEqual(\HJ100\BBSMS\SMSError::OK, $re->code);
    }

    private function testsendEditPasswordCode()
    {
        $re = $this->sms->sendEditPasswordCode('18376725308');
        $this->assertEqual(\HJ100\BBSMS\SMSError::OK, $re->code);
    }

     function testSendDeposit()
    {
        $re = $this->sms->sendDepositeSuccessToCustomer('18376725308','qhk'
            ,'34979209380',600,'2015-03-05','dd463636363634634');
        $this->assertEqual(\HJ100\BBSMS\SMSError::OK, $re->code);
    }
}
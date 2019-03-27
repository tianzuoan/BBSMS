<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 17-10-23
 * Time: 上午11:35
 */

namespace BBSMS\API\Controller;


use BBSMS\ISMS;

class CustomerController extends BaseController
{
    
    
    public function successWithdralAction(){
        /** @var ISMS $smser */
        $smser=$this->di->getShared('smser');

        $re=$smser->sendWithdralSuccessToCustomer($this->getPhoneNumbers(),$this->getName(),
            $this->getMT4Account(),$this->getMoney(),$this->getTime(),
            $this->getOrderNo());
        return json_encode($re);
    }
    
    public function failedWithdralAction(){
        
    }
    
    public function successDepositeAction(){
        /** @var ISMS $smser */
        $smser=$this->di->getShared('smser');

        $re=$smser->sendDepositeSuccessToCustomer($this->getPhoneNumbers(),$this->getName(),
            $this->getMT4Account(),$this->getMoney(),$this->getTime(),
            $this->getOrderNo());
        return json_encode($re);
    }
    
    public function failedDepositeAction(){
        
    }

    /**
     * 注册成功
     * 注册通知：${name}您好！恭喜您于${time}成功注册账户${mt4account}，密码${password}；为确保您的账户安全，请及时修改密码
     */
    public function successRegisterAction(){
        /** @var ISMS $smser */
        $smser=$this->di->getShared('smser');

        $re=$smser->sendRegisterSuccessToCustomer($this->getPhoneNumbers(),$this->getName()
            ,$this->getTime(),$this->getMT4Account(),$this->getPassword());
        return json_encode($re);
    }

    /**
     * 注册成功 在推广页面注册成功
     * 注册通知：{1}您好！恭喜您于{2}成功注册账户{3}，密码{4}；为确保您的账户安全,请及时登陆{5}进行修改密码。
     */
    public function successSpreadRegisterAction(){
        /** @var ISMS $smser */
        $smser=$this->di->getShared('smser');

        $re=$smser->sendSpreadRegisterSuccessToCustomer($this->getPhoneNumbers(),$this->getName()
            ,$this->getTime(),$this->getMT4Account(),$this->getPassword(),$this->getWebsite());
        return json_encode($re);
    }


}
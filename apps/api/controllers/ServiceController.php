<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 17-10-23
 * Time: 上午11:35
 */

namespace BBSMS\API\Controller;


use BBSMS\ISMS;

class ServiceController extends BaseController
{
    
    public function successWithdralAction(){
        /** @var ISMS $smser */
        $smser=$this->di->getShared('smser');

        $re=$smser->sendWithdralSuccessToService($this->getPhoneNumbers(),$this->getName(),
            $this->getMT4Account(),$this->getMoney(),$this->getTime(),
            $this->getOrderNo());
        return json_encode($re);
    }
    
    public function failedWithdralAction(){
        
    }

    /**
     * 入金通知：时间：${time}，用户：${name}：账户${mt4account}，入金：${money}美元，订单号${orderno}，入金状态：成功
     */
    public function successDepositeAction(){
        /** @var ISMS $smser */
        $smser=$this->di->getShared('smser');

        $re=$smser->sendDepositeSuccessToService($this->getPhoneNumbers(),$this->getName(),
            $this->getMT4Account(),$this->getMoney(),$this->getTime(),
            $this->getOrderNo());
        return json_encode($re);
    }
    
    public function failedDepositeAction(){
        
    }

    /**
     * 客户申请出金成功
     * @return string
     */
    public function successApplyWithdralAction(){
        /** @var ISMS $smser */
        $smser=$this->di->getShared('smser');

        $re=$smser->successApplyWithdral($this->getPhoneNumbers(),$this->getName(),
            $this->getMT4Account(),$this->getMoney(),$this->getTime(),
            $this->getOrderNo());
        return json_encode($re);
    }
}
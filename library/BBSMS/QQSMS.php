<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 17-11-2
 * Time: 下午2:10
 */

namespace BBSMS;


use HJ100\BBSMS\SMSError;
use HJ100\BBSMS\SMSResult;
use Qcloud\Sms\SmsSingleSender;

class QQSMS extends SMS
{

    public function __construct($appid, $appkey, $signName, array $tempids)
    {
        parent::__construct($appid, $appkey, $signName, $tempids);
    }

    /**
     * 发送短信
     *
     * @param string $templateCode <p>
     * 必填, 短信模板Code，应严格按"模板CODE"填写,
     * 参考：<a href="https://dysms.console.aliyun.com/dysms.htm#/template">短信模板页</a>
     * (e.g. SMS_0001)
     * </p>
     * @param string $phoneNumbers 必填, 短信接收号码 (e.g. 12345678901)
     * @param array|null $templateParam <p>
     * 选填, 假如模板中存在变量需要替换则为必填项 (e.g. Array("code"=>"12345", "product"=>"阿里通信"))
     * </p>
     * @param string|null $outId [optional] 选填, 发送短信流水号 (e.g. 1234)
     * @return SMSResult
     */
    public function send($templateCode, $phoneNumbers, $templateParam = null, $outId = null)
    {
        
        // TODO: Implement send() method.
        $smsSingleSender = new SmsSingleSender($this->account, $this->password);
        //国家代码 分割
        $len=strlen($phoneNumbers);
        $nation=86;
        if ($len>11){
            //大于11位则表示有国家代码
            $phone=substr($phoneNumbers,-11,11);
            $nation=substr($phoneNumbers,0,$len-11);
        }else{
            $phone=$phoneNumbers;
        }

        $re=$smsSingleSender->sendWithParam($nation,$phone,$templateCode,$templateParam,$this->signName);
        if (isset($this->logger)){
            $this->logger->debug($re);
            $this->logger->debug($templateParam);
        }
        $re=json_decode($re,true);
        $smsre = new SMSResult();
        $smsre->code=$re['result'];
        $smsre->message=$re['errmsg'];
        $smsre->requestId=$re['sid'];
        $smsre->fee=$re['fee'];
        $smsre->ext=$re['ext'];
        if ($smsre->code===0){
            $smsre->code=SMSError::OK;
        }
        if (isset($this->logger)){
            $this->logger->debug($smsre);
        }
        return $smsre;
    }

    /**
     * 发送测试短信
     * @param array|string $phonenumbers 短信接收人电话号码,如果是多个请放入数组中
     * @param string $customer 接收人姓名
     * @return SMSResult
     */
    public function sendTest($phonenumbers, $customer)
    {
        // TODO: Implement sendTest() method.
        return $this->send($this->tmpid_test,$phonenumbers,array($customer));
    }

    /**
     * 发送一般短信验证码
     * 模板内容:您的验证码为${code}，请于2分钟内正确输入，如非本人操作，请忽略此短信。
     * @param string $phoneNumbers 验证码接收人
     * @param string|int $code 验证码
     * @return SMSResult
     */
    public function sendCommonCode($phoneNumbers, $code)
    {
        // TODO: Implement sendCommonCode() method.
        return $this->send($this->tmpid_common,$phoneNumbers,array($code));
    }

    /**
     * 发送身份验证验证码
     * 模板内容:验证码${code}，您正在进行${product}身份验证，打死不要告诉别人哦！
     * @param string $phoneNumbers 验证码接收人号码
     * @param string $product 产品,如果不传入则默认为签名
     * @param string|int $code 验证码
     * @return SMSResult
     */
    public function sendAuthenticateCode($phoneNumbers, $code, $product = null)
    {
        // TODO: Implement sendAuthenticateCode() method.
        return $this->send($this->tmpid_auth,$phoneNumbers,array($code,$product?$product:$this->signName));
    }

    /**
     * 发送登录确认验证码
     * 模板内容:验证码${code}，您正在登录${product}，若非本人操作，请勿泄露。
     * @param string $phoneNumbers 验证码接收人
     * @param string|int $code 验证码
     * @param string $product 产品,如果不传入则默认为签名
     * @return SMSResult
     */
    public function sendLoginCode($phoneNumbers, $code, $product = null)
    {
        // TODO: Implement sendLoginCode() method.
        return $this->send($this->tmpid_login,$phoneNumbers,array($code,$product?$product:$this->signName));
    }

    /**
     * 发送用户注册验证码
     * 模板内容:验证码${code}，您正在注册成为${product}用户，感谢您的支持！
     * @param string $phoneNumbers 验证码接收人
     * @param string|int $code 验证码
     * @param string $product 产品,如果不传入则默认为签名
     * @return SMSResult
     */
    public function sendRegisterCode($phoneNumbers, $code, $product = null)
    {
        // TODO: Implement sendRegisterCode() method.
        return $this->send($this->tmpid_register,$phoneNumbers,array($code,$product?$product:$this->signName));
    }

    /**
     * 发送修改密码验证码
     * 模板内容:验证码${code}，您正在尝试修改${product}登录密码，请妥善保管账户信息。
     * @param string $phoneNumbers 验证码接收人
     * @param string|int $code 验证码
     * @param string $product 产品,如果不传入则默认为签名
     * @return SMSResult
     */
    public function sendEditPasswordCode($phoneNumbers, $code, $product = null)
    {
        // TODO: Implement sendEditPasswordCode() method.
        return $this->send($this->tmpid_edit_password,$phoneNumbers,array($code,$product?$product:$this->signName));

    }

    /**
     * 发送找回重置密码验证码
     * 模板内容:验证码${code}，您正在尝试找回重置登录密码，请妥善保管账户信息。
     * @param number $phoneNumbers 验证码接收人
     * @param string|int $code 验证码,如果为空会自动生成6位数字验证码
     * @return SMSResult
     */
    public function sendForgetPasswordCode($phoneNumbers, $code)
    {
        // TODO: Implement sendForgetPasswordCode() method.
        return $this->send($this->tmpid_find_password,$phoneNumbers,array($code));
    }

    /**
     * 发送用户信息变更验证码
     * 模板内容:验证码${code}，您正在尝试变更${product}重要信息，请妥善保管账户信息。
     * @param string $phoneNumbers 验证码接收人
     * @param string|int $code 验证码
     * @param string $product 产品,如果不传入则默认为签名
     * @return SMSResult
     */
    public function sendInfoChangeCode($phoneNumbers, $code, $product = null)
    {
        // TODO: Implement sendInfoChangeCode() method.
        return $this->send($this->tmpid_info_change,$phoneNumbers,array($code,$product?$product:$this->signName));
    }

    /**
     * 发送实名认证失败通知
     * 尊敬的${name},您在${product}进行的实名认证审核不通过.原因是:${reason},请您修正后再申请.
     * @param number $phoneNumbers
     * @param string $product 产品|应用
     * @param string $name 姓名
     * @param string $reason 原因
     * @return SMSResult
     */
    public function sendAuthRealnameFaild($phoneNumbers, $product, $name, $reason)
    {
        // TODO: Implement sendAuthRealnameFaild() method.
        return $this->send($this->tmpid_auth_realname_f,$phoneNumbers,array($name,$product?$product:$this->signName,$reason));
    }

    /**
     * 发送实名认证通过通知
     * 尊敬的${name},您在${product}进行的实名认证审核已通过.
     * @param number $phoneNumbers
     * @param string $product 产品|应用
     * @param string $name 姓名
     * @return SMSResult
     */
    public function sendAuthRealnameSuccess($phoneNumbers, $product, $name)
    {
        // TODO: Implement sendAuthRealnameSuccess() method.
        return $this->send($this->tmpid_auth_realname_s,$phoneNumbers,array($name,$product?$product:$this->signName));
    }

    /**
     * 发送入金成功通知给客户
     * @param number $phoneNumber 手机号码
     * @param string $name 用户名
     * @param number $mt4account mt4账号
     * @param double $money 金额
     * @param DateTime $datetime 时间
     * @param string $orderno 订单号
     * @return SMSResult
     */
    public function sendDepositeSuccessToCustomer($phoneNumber, $name, $mt4account, $money, $datetime, $orderno)
    {
        // TODO: Implement sendDepositeSuccessToCustomer() method.
        return $this->send($this->tmpid_deposit_s,$phoneNumber,array($datetime,$name,$mt4account,$money,$orderno));
    }

    /**
     * 发送入金成功通知给客服
     * @param number $phoneNumber 手机号码
     * @param string $name 用户名
     * @param number $mt4account mt4账号
     * @param double $money 金额
     * @param DateTime $datetime 时间
     * @param string $orderno 订单号
     * @return SMSResult
     */
    public function sendDepositeSuccessToService($phoneNumber, $name, $mt4account, $money, $datetime, $orderno)
    {
        // TODO: Implement sendDepositeSuccessToService() method.
        return $this->send($this->tmpid_deposit_s,$phoneNumber,array($datetime,$name,$mt4account,$money,$orderno));
    }

    /**
     * 发送入金失败通知给客户
     * @param number $phoneNumber 手机号码
     * @param string $name 用户名
     * @param number $mt4account mt4账号
     * @param double $money 金额
     * @param DateTime $datetime 时间
     * @param string $orderno 订单号
     * @return SMSResult
     */
    public function sendDepositeFailedToCustomer($phoneNumber, $name, $mt4account, $money, $datetime, $orderno)
    {
        // TODO: Implement sendDepositeFailedToCustomer() method.
    }

    /**
     * 发送入金失败通知给客服
     * @param number $phoneNumber 手机号码
     * @param string $name 用户名
     * @param number $mt4account mt4账号
     * @param double $money 金额
     * @param DateTime $datetime 时间
     * @param string $orderno 订单号
     * @return SMSResult
     */
    public function sendDepositeFailedToService($phoneNumber, $name, $mt4account, $money, $datetime, $orderno)
    {
        // TODO: Implement sendDepositeFailedToService() method.
    }

    /**
     * 发送出金成功通知给客户
     * @param number $phoneNumber 手机号码
     * @param string $name 用户名
     * @param number $mt4account mt4账号
     * @param double $money 金额
     * @param DateTime $datetime 时间
     * @param string $orderno 订单号
     * @return SMSResult
     */
    public function sendWithdralSuccessToCustomer($phoneNumber, $name, $mt4account, $money, $datetime, $orderno)
    {
        // TODO: Implement sendWithdralSuccessToCustomer() method.
        return $this->send($this->tmpid_withdraw_s,$phoneNumber,array($datetime,$name,$mt4account,$money,$orderno));
    }

    /**
     * 发送出金成功通知给客服
     * @param number $phoneNumber 手机号码
     * @param string $name 用户名
     * @param number $mt4account mt4账号
     * @param double $money 金额
     * @param DateTime $datetime 时间
     * @param string $orderno 订单号
     * @return SMSResult
     */
    public function sendWithdralSuccessToService($phoneNumber, $name, $mt4account, $money, $datetime, $orderno)
    {
        // TODO: Implement sendWithdralSuccessToService() method.
        return $this->send($this->tmpid_withdraw_s,$phoneNumber,array($datetime,$name,$mt4account,$money,$orderno));
    }

    /**
     * 发送出金失败通知给客户
     * @param number $phoneNumber 手机号码
     * @param string $name 用户名
     * @param number $mt4account mt4账号
     * @param double $money 金额
     * @param DateTime $datetime 时间
     * @param string $orderno 订单号
     * @return SMSResult
     */
    public function sendWithdralFailedToCustomer($phoneNumber, $name, $mt4account, $money, $datetime, $orderno)
    {
        // TODO: Implement sendWithdralFailedToCustomer() method.
    }

    /**
     * 发送出金失败通知给客服
     * @param number $phoneNumber 手机号码
     * @param string $name 用户名
     * @param number $mt4account mt4账号
     * @param double $money 金额
     * @param DateTime $datetime 时间
     * @param string $orderno 订单号
     * @return SMSResult
     */
    public function sendWithdralFailedToService($phoneNumber, $name, $mt4account, $money, $datetime, $orderno)
    {
        // TODO: Implement sendWithdralFailedToService() method.
    }

    /**
     * 注册成功
     * @param number $phoneNumber 手机号码
     * @param string $name 用户名
     * @param number $mt4account mt4账号
     * @param DateTime $datetime 时间
     * @param string $password 密码
     * @return SMSResult
     */
    public function sendRegisterSuccessToCustomer($phoneNumber, $name, $datetime, $mt4account, $password)
    {
        // TODO: Implement sendRegisterSuccessToCustomer() method.
        return $this->send($this->tmpid_register_s,$phoneNumber,array($name,$datetime,$mt4account,$password));
    }

    /**
     * 提现通知：时间：{1}，用户：{2}：账户{3}，提现：{4}美元，订单号{5}，提现状态：待审核处理
     * @param number $phoneNumber 手机号码
     * @param string $name 用户名
     * @param number $mt4account mt4账号
     * @param double $money 金额
     * @param DateTime $datetime 时间
     * @param string $orderno 订单号
     * @return SMSResult
     */
    public function successApplyWithdral($phoneNumber, $name, $mt4account, $money, $datetime, $orderno)
    {
        // TODO: Implement successApplyWithdral() method.
        return $this->send($this->tmpid_withdraw_apply,$phoneNumber,array($datetime,$name,$mt4account,$money,$orderno));
    }

    /**
     * 注册成功
     * @param number $phoneNumber 手机号码
     * @param string $name 用户名
     * @param DateTime $datetime 时间
     * @param number $mt4account mt4账号
     * @param string $password 密码
     * @param string $site 网站地址
     * @return SMSResult
     */
    public function sendSpreadRegisterSuccessToCustomer($phoneNumber, $name, $datetime, $mt4account, $password, $site)
    {
        // TODO: Implement sendSpreadRegisterSuccessToCustomer() method.
        return $this->send($this->tmpid_spread_register_s,$phoneNumber,array($name,$datetime,$mt4account,$password,$site));
    }
}
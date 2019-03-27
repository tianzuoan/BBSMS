<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 2017/8/25
 * Time: 16:00
 */

namespace BBSMS;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\Regions\EndpointProvider;
use HJ100\BBSMS\SMSResult;

class ALiYunSMS extends SMS
{
    /**
     * 构造器
     * @param string $accessKeyId 必填，AccessKeyId
     * @param string $accessKeySecret 必填，AccessKeySecret
     * @param string $signName 必须 签名|应用
     * @param array $tempids 必须 模板id数组,数组的key一定要和本类的表示模板id的变量名相同
     */
    public function __construct($accessKeyId, $accessKeySecret,$signName,array $tempids)
    {
        parent::__construct($accessKeyId,$accessKeySecret,$signName,$tempids);
        // 短信API产品名
        $product = "Dysmsapi";

        // 短信API产品域名
        $domain = "dysmsapi.aliyuncs.com";

        // 暂时不支持多Region
        $region = "cn-hangzhou";

        // 服务结点
        $endPointName = "cn-hangzhou";

        // 增加服务结点
        DefaultProfile::addEndpoint($endPointName, $region, $product, $domain);

        EndpointProvider::setEndpoints(DefaultProfile::getEndpoints());//bixu

        // 初始化用户Profile实例
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);

        // 初始化AcsClient用于发起请求
        $this->acsClient = new DefaultAcsClient($profile);
    }

    /**
     * 发送短信
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
        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();

        // 必填，设置雉短信接收号码
        $request->setPhoneNumbers($phoneNumbers);

        // 必填，设置签名名称
        $request->setSignName($this->signName);

        // 必填，设置模板CODE
        $request->setTemplateCode($templateCode);

        //接受json格式数据
//        $request->setAcceptFormat('JSON');

        // 可选，设置模板参数
        if($templateParam) {
            if (is_array($templateParam)){
                $templateParam=json_encode($templateParam);
            }
            $request->setTemplateParam($templateParam);
        }

        // 可选，设置流水号
        if($outId) {
            $request->setOutId($outId);
        }
        // 发起访问请求
        if (!empty($this->logger)){
//            $this->logger->info('请求数据:'.json_encode($request));
        }
        $acsResponse = $this->acsClient->getAcsResponse($request);
        
        $re=new SMSResult();
        if ($acsResponse->Code==='OK'){
            $re->code=Error::NO;
        }else{
            $re->code=$acsResponse->Code;
        }
        $re->message=$acsResponse->Message;
        $re->requestId=$acsResponse->RequestId;
        $re->bizId=$acsResponse->BizId;
        
        //记录日志
        if (!empty($this->logger)){
//            $this->logger->info('结果:'.json_encode($acsResponse));
        }
        return $re;
    }

    /**
     * 发送测试短信
     * @param string $phonenumbers 短信接收人电话号码,如果是多个可用英文逗号隔开
     * @param string $customer 接收人姓名
     * @return SMSResult
     */
    public function sendTest($phonenumbers, $customer)
    {
        // TODO: Implement sendTest() method.
        $pa['customer']=$customer;
        return $this->send($this->tmpid_test,$phonenumbers,$pa);
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
        $para['code']=$code;
        return $this->send($this->tmpid_common,$phoneNumbers,$para);
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
        $para['code']=$code;
        $para['product']=$product?$product:$this->signName;
        return $this->send($this->tmpid_auth,$phoneNumbers,$para);
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
        $para['code']=$code;
        $para['product']=$product?$product:$this->signName;
        return $this->send($this->tmpid_login,$phoneNumbers,$para);
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
        $para['code']=$code;
        $para['product']=$product?$product:$this->signName;
        return $this->send($this->tmpid_register,$phoneNumbers,$para);
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
        $para['code']=$code;
        $para['product']=$product?$product:$this->signName;
        return $this->send($this->tmpid_edit_password,$phoneNumbers,$para);
    }
    /**
     * 发送找回重置密码验证码
     * 模板内容:验证码${code}，您正在尝试找回重置登录密码，请妥善保管账户信息。
     * @param number $phoneNumbers 验证码接收人
     * @param string|int $code 验证码,如果为空会自动生成6位数字验证码
     * @return SMSResult
     */
    public function sendForgetPasswordCode($phoneNumbers, $code){
        $para['code']=$code;
        return $this->send($this->tmpid_find_password,$phoneNumbers,$para);
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
        $para['code']=$code;
        $para['product']=$product?$product:$this->signName;
        return $this->send($this->tmpid_info_change,$phoneNumbers,$para);
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
        $para['name']=$name;
        $para['product']=$product?$product:$this->signName;
        $para['reason']=$reason;
        return $this->send($this->tmpid_info_change,$phoneNumbers,$para);
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
        $para['name']=$name;
        $para['product']=$product?$product:$this->signName;
        return $this->send($this->tmpid_info_change,$phoneNumbers,$para);
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
        $para['name']=$name;
        $para['mt4account']=$mt4account;
        $para['money']=$money;
        $para['time']=$datetime;
        $para['orderno']=$orderno;
        return $this->send($this->tmpid_deposit_s,$phoneNumber,$para);
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
        $para['name']=$name;
        $para['mt4account']=$mt4account;
        $para['money']=$money;
        $para['time']=$datetime;
        $para['orderno']=$orderno;
        return $this->send($this->tmpid_withdraw_s,$phoneNumber,$para);
        
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
     * @param $password 密码
     * @return SMSResult
     */
    public function sendRegisterSuccessToCustomer($phoneNumber, $name, $datetime, $mt4account, $password)
    {
        // TODO: Implement sendRegisterSuccessToCustomer() method.
        $para['name']=$name;
        $para['mt4account']=$mt4account;
        $para['password']=$password;
        $para['time']=$datetime;
        return $this->send($this->tmpid_register_s,$phoneNumber,$para);
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
        $para['name']=$name;
        $para['mt4account']=$mt4account;
        $para['password']=$password;
        $para['time']=$datetime;
        $para['website']=$site;
        return $this->send($this->tmpid_register_s,$phoneNumber,$para);
    }
}
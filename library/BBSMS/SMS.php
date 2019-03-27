<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 17-10-11
 * Time: 下午2:35
 */

namespace BBSMS;

abstract class SMS implements ISMS
{
    /**
     * @var string 账号
     */
    public $account;

    /**
     * @var string 账号密码
     */
    public $password;

    /**
     * @var string 短信签名|应用
     */
    public $signName;

    public $logger;

    /**
     * @return mixed
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param mixed $logger
     * @return SMS
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * @return string
     */
    public function getTmpidTest(): string
    {
        return $this->tmpid_test;
    }

    /**
     * @param string $tmpid_test
     * @return SMS
     */
    public function setTmpidTest(string $tmpid_test): SMS
    {
        $this->tmpid_test = $tmpid_test;
        return $this;
    }

    /**
     * @return string
     */
    public function getTmpidWithdrawS(): string
    {
        return $this->tmpid_withdraw_s;
    }

    /**
     * @param string $tmpid_withdraw_s
     * @return SMS
     */
    public function setTmpidWithdrawS(string $tmpid_withdraw_s): SMS
    {
        $this->tmpid_withdraw_s = $tmpid_withdraw_s;
        return $this;
    }

    /**
     * @return string
     */
    public function getTmpidDepositS(): string
    {
        return $this->tmpid_deposit_s;
    }

    /**
     * @param string $tmpid_deposit_s
     * @return SMS
     */
    public function setTmpidDepositS(string $tmpid_deposit_s): SMS
    {
        $this->tmpid_deposit_s = $tmpid_deposit_s;
        return $this;
    }

    /**
     * @return string
     */
    public function getTmpidRegisterS(): string
    {
        return $this->tmpid_register_s;
    }

    /**
     * @param string $tmpid_register_s
     * @return SMS
     */
    public function setTmpidRegisterS(string $tmpid_register_s): SMS
    {
        $this->tmpid_register_s = $tmpid_register_s;
        return $this;
    }
    
    /**
     * @var string $tmpid_register 短信模板id 注册
     */
    public $tmpid_register;
    /**
     * @var string $tmpid_test 短信模板id 测试
     */
    public $tmpid_test;

    /**
     * @var string $tmpid_login 短信模板id 登录
     */
    public $tmpid_login;

    /**
     * @var string $tmpid_common 短信模板id 一般验证码
     */
    public $tmpid_common;

    /**
     * @var string $tmpid_auth 短信模板id 身份验证
     */
    public $tmpid_auth;

    /**
     * @var string $tmpid_edit_password 短信模板id 修改密码
     */
    public $tmpid_edit_password;

    /**
     * @var string $tmpid_find_password 短信模板id 找d回密码
     */
    public $tmpid_find_password;

    /**
     * @var string $tmpid_info_change 短信模板id 信息变更
     */
    public $tmpid_info_change;

    /**
     * @var string $tmpid_auth_realname_f 短信模板id 实名认证失败
     */
    public $tmpid_auth_realname_f;

    /**
     * @var string $tmpid_auth_realname_s 短信模板id 实名认证成功
     */
    public $tmpid_auth_realname_s;
    /**
     * @var string $tmpid_withdraw_s 短信模板id 出金成功
     */
    public $tmpid_withdraw_s;
    /**
     * @var string $tmpid_withdraw_apply 短信模板id 出金申请成功
     */
    public $tmpid_withdraw_apply;

    /**
     * @var string $tmpid_deposit_s 短信模板id 入金成功
     */
    public $tmpid_deposit_s;

    /**
     * @var string $tmpid_register_s 注册成功
     */
    public $tmpid_register_s;

    /**
     * @var string $tmpid_spread_register_s 注册成功(推广)
     */
    public $tmpid_spread_register_s;



    /**
     * 构造器
     * @param string $appid 必填
     * @param string $appkey 必填
     * @param string $signName 必须 签名|应用
     * @param array $tempids 必须 模板id数组,数组的key一定要和本类的表示模板id的变量名相同
     */
    public function __construct($appid, $appkey,$signName,array $tempids)
    {
        $this->account=$appid;
        $this->password=$appkey;
        $this->signName=$signName;
        $this->setTempId($tempids);
    }

    /**
     * @param array $tempids 模板id数组,数组的key一定要和本类的表示模板id的变量名相同
     * @return object
     */
    public function setTempId(array $tempids){
        return array_to_properties($this,$tempids);
    }

    /**
     * @return string
     */
    public function getAccount(): string
    {
        return $this->account;
    }

    /**
     * @param string $account
     * @return SMS
     */
    public function setAccount(string $account): SMS
    {
        $this->account = $account;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return SMS
     */
    public function setPassword(string $password): SMS
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getSignName(): string
    {
        return $this->signName;
    }

    /**
     * @param string $signName
     * @return SMS
     */
    public function setSignName(string $signName): SMS
    {
        $this->signName = $signName;
        return $this;
    }

    /**
     * @return string
     */
    public function getTmpidRegister(): string
    {
        return $this->tmpid_register;
    }

    /**
     * @param string $tmpid_register
     * @return SMS
     */
    public function setTmpidRegister(string $tmpid_register): SMS
    {
        $this->tmpid_register = $tmpid_register;
        return $this;
    }

    /**
     * @return string
     */
    public function getTmpidLogin(): string
    {
        return $this->tmpid_login;
    }

    /**
     * @param string $tmpid_login
     * @return SMS
     */
    public function setTmpidLogin(string $tmpid_login): SMS
    {
        $this->tmpid_login = $tmpid_login;
        return $this;
    }

    /**
     * @return string
     */
    public function getTmpidCommon(): string
    {
        return $this->tmpid_common;
    }

    /**
     * @param string $tmpid_common
     * @return SMS
     */
    public function setTmpidCommon(string $tmpid_common): SMS
    {
        $this->tmpid_common = $tmpid_common;
        return $this;
    }

    /**
     * @return string
     */
    public function getTmpidAuth(): string
    {
        return $this->tmpid_auth;
    }

    /**
     * @param string $tmpid_auth
     * @return SMS
     */
    public function setTmpidAuth(string $tmpid_auth): SMS
    {
        $this->tmpid_auth = $tmpid_auth;
        return $this;
    }

    /**
     * @return string
     */
    public function getTmpidEditPassword(): string
    {
        return $this->tmpid_edit_password;
    }

    /**
     * @param string $tmpid_edit_password
     * @return SMS
     */
    public function setTmpidEditPassword(string $tmpid_edit_password): SMS
    {
        $this->tmpid_edit_password = $tmpid_edit_password;
        return $this;
    }

    /**
     * @return string
     */
    public function getTmpidFindPassword(): string
    {
        return $this->tmpid_find_password;
    }

    /**
     * @param string $tmpid_find_password
     * @return SMS
     */
    public function setTmpidFindPassword(string $tmpid_find_password): SMS
    {
        $this->tmpid_find_password = $tmpid_find_password;
        return $this;
    }

    /**
     * @return string
     */
    public function getTmpidInfoChange(): string
    {
        return $this->tmpid_info_change;
    }

    /**
     * @param string $tmpid_info_change
     * @return SMS
     */
    public function setTmpidInfoChange(string $tmpid_info_change): SMS
    {
        $this->tmpid_info_change = $tmpid_info_change;
        return $this;
    }

    /**
     * @return string
     */
    public function getTmpidAuthRealnameF(): string
    {
        return $this->tmpid_auth_realname_f;
    }

    /**
     * @param string $tmpid_auth_realname_f
     * @return SMS
     */
    public function setTmpidAuthRealnameF(string $tmpid_auth_realname_f): SMS
    {
        $this->tmpid_auth_realname_f = $tmpid_auth_realname_f;
        return $this;
    }

    /**
     * @return string
     */
    public function getTmpidAuthRealnameS(): string
    {
        return $this->tmpid_auth_realname_s;
    }

    /**
     * @param string $tmpid_auth_realname_s
     * @return SMS
     */
    public function setTmpidAuthRealnameS(string $tmpid_auth_realname_s): SMS
    {
        $this->tmpid_auth_realname_s = $tmpid_auth_realname_s;
        return $this;
    }


}
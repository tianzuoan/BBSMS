<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 2017/8/25
 * Time: 15:32
 */

namespace BBSMS\API\Controller;


use BBSMS\Exception\ContinueException;
use HJ100\BBSMS\SMSError;
use HJ100\BBSMS\SMSResult;
use Phalcon\Mvc\Controller;

class BaseController extends Controller
{
    /**
     * 获取post过来的模板变量
     * @param $name
     * @param string $errmsg
     * @param string $errno
     * @param bool $break
     * @return mixed|string
     * @throws ContinueException
     */
    public function get($name,$break=true,$errmsg='缺少模板变量',$errno=SMSError::NO_TMPPARAM){
        $var=$this->request->getPost($name);
        if (empty($var)){
            if ($break===true){
                $re=new SMSResult();
                $re->code=$errno;
                $re->message=$errmsg.$name;
                $this->response->appendContent(json_encode($re));
                throw new ContinueException();
            }else{
                $var=$errmsg.$name;
            }
        }
        return $var;
    }
    
    /**
     * 获取post过来的模板变量
     * @param bool $break 如果为空是否直接中断程序,输出警告信息
     * @return string 模板变量.如果$break=false且校验错误那么返回错误提示信息
     * @throws ContinueException
     */
    public function getTempParam($break=true){
        return $this->get('TemplateParam',$break);
    }

    /**
     * 获取post过来的模板id
     * @param bool $break 如果为空是否直接中断程序,输出警告信息
     * @return string 返回模板id.如果$break=false且校验错误那么返回错误提示信息
     * @throws ContinueException
     */
    public function getTempId($break=true){
        return $this->get('TemplateCode',$break,'请输入模板id',SMSError::NO_TMPID);
    }

    /**
     * 获取post过来的签名|应用
     * @param bool $break 如果为空是否直接中断程序,输出警告信息
     * @return string 返回签名,如果$break=false且校验错误那么返回错误提示信息
     * @throws ContinueException
     */
    public function getApp($break=true){
        return $this->get('SignName',$break,'请输入签名或者应用名',SMSError::NO_APPID);
    }

    /**
     * 获取post过来的手机号码
     * @param bool $break 如果为空是否直接中断程序,输出警告信息
     * @return string|number 手机号码或者是手机号码串,如果是多个手机号码则用英文逗号隔开,
     *              如果$break=false且校验错误那么返回错误提示信息
     * @throws ContinueException
     */
    public function getPhoneNumbers($break=true){
        return $this->get('PhoneNumbers',$break,'请输入手机号码',SMSError::NO_PHONE);
    }

    /**
     * 获取post过来的验证码
     * @param bool $break 如果为空是否直接中断程序,输出警告信息
     * @return string 返回验证码,如果$break=false且校验错误那么返回错误提示信息
     * @throws ContinueException
     */
    public function getCode($break=true){
        return $this->get('Code',$break,'请输入验证码',SMSError::NO_CODE);
    }

    /**
     * 获取post过来的customer姓名
     * @param bool $break 如果为空是否直接中断程序,输出警告信息
     * @return string 返回接收人姓名,如果$break=false且校验错误那么返回错误提示信息
     * @throws ContinueException
     */
    public function getCustomer($break=true){
        return $this->get('Customer',$break,'请输入接收人',SMSError::NO_CUSTOMER);
    }

    /**
     * 获取post过来的产品名称product
     * @param bool $break 如果为空是否直接中断程序,输出警告信息
     * @return string 返回产品名,如果$break=false且校验错误那么返回错误提示信息
     * @throws ContinueException
     */
    public function getProduct($break=true){
        return $this->get('Product',$break,'请输入产品名',SMSError::NO_PRODUCT);
    }

    /**
     * 获取post过来的时间
     * @param bool $break 如果为空是否直接中断程序,输出警告信息
     * @return string|DateTime 返回时间,如果$break=false且校验错误那么返回错误提示信息
     * @throws ContinueException
     */
    public function getTime($break=true){
        return $this->get('Time',$break,'请输入时间');
    }

    /**
     * 获取post过来的用户名
     * @param bool $break 如果为空是否直接中断程序,输出警告信息
     * @return string 返回用户名,如果$break=false且校验错误那么返回错误提示信息
     * @throws ContinueException
     */
    public function getName($break=true){
        return $this->get('Name',$break,'请输入用户名');
    }
    /**
     * 获取post过来的金额
     * @param bool $break 如果为空是否直接中断程序,输出警告信息
     * @return string 返回金额,如果$break=false且校验错误那么返回错误提示信息
     * @throws ContinueException
     */
    public function getMoney($break=true){
        return $this->get('Money',$break,'请输入金额');
    }
    /**
     * 获取post过来的MT4Account
     * @param bool $break 如果为空是否直接中断程序,输出警告信息
     * @return string|number 返回mt4账号,如果$break=false且校验错误那么返回错误提示信息
     * @throws ContinueException
     */
    public function getMT4Account($break=true){
        return $this->get('Mt4account',$break,'请输入MT4账号');
    }

    /**
     * 获取post过来的订单号
     * @param bool $break 如果为空是否直接中断程序,输出警告信息
     * @return string 返回订单号,如果$break=false且校验错误那么返回错误提示信息
     * @throws ContinueException
     */
    public function getOrderNo($break=true){
        return $this->get('Orderno',$break,'请输入订单号');
    }

    /**
     * 获取post过来的网站地址
     * @param bool $break 如果为空是否直接中断程序,输出警告信息
     * @return string 返回网站地址,如果$break=false且校验错误那么返回错误提示信息
     * @throws ContinueException
     */
    public function getWebsite($break=true){
        return $this->get('Website',$break,'请输入网站地址');
    }

    /**
     * 获取post过来的网站地址
     * @param bool $break 如果为空是否直接中断程序,输出警告信息
     * @return string 返回网站地址,如果$break=false且校验错误那么返回错误提示信息
     * @throws ContinueException
     */
    public function getPassword($break=true){
        return $this->get('Password',$break);
    }
}
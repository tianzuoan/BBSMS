<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 17-9-18
 * Time: 下午5:15
 */

namespace HJ100\MT4;


class MT4Error extends \HJ100\Core\Error
{
    /**
     * 操作失败
     */
    const FAIld=1;

    /**
     * 账户不存在
     */
    const ACCOUNT_NOT_EXIT=6;

    /**
     * 组不存在
     */
    const GROUP_NOT_EXIT=8;



    /**
     * 账号已经存在
     */
    const ACCOUNT_EXIT=27;

    /**
     * 手机号已经被注册
     */
    const PHONE_NUMBER_EXIT=28;
}
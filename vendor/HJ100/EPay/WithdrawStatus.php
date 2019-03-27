<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 17-9-21
 * Time: 下午2:45
 */

namespace HJ100\EPay;

/***
 * Class WithdrawStatus 取款状态
 * @package HJ100\EPay
 */
class WithdrawStatus
{
    /**
     * @var string   新申请,等待平台审核
     */
    const WAIT_AUDIT1='0';

    /**
     * @var string WAIT_AUDIT2 平台审核通过,等待第一支付审核
     */
    const WAIT_AUDIT2='1';

    /**
     * @var string FAILD 审核不通过
     */
    const FAILD='2';

    /**
     * @var string SUCCESS 取款成功
     */
    const SUCCESS='3';

    /**
     * @var string PAYMENT_FAILD 结算失败
     */
    const PAYMENT_FAILD='4';

    /**
     * @var string COMPLETE 已完成
     */
    const COMPLETE='10';

    /**
     * @var array 状态码
     */
    private static $status=array(
        self::WAIT_AUDIT1=>'等待平台审核',
        self::WAIT_AUDIT2=>'等待EPay审核',
        self::FAILD=>'审核不通过',
        self::PAYMENT_FAILD=>'结算失败',
        self::SUCCESS=>'提现成功',
        self::COMPLETE=>'已完成'
    );

    /**
     * 获取状态码对应的文字说明
     * @param int $status
     * @return string
     */
    public static function getLabel($status){
        return self::$status[$status];
    }

}
<?php
/**
 * 佣金计算
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/9
 * Time: 18:43
 */

namespace Tadm\Biz;


class Commission
{
    private $debug   = false;
    private $mid     = 0;
    private $price   = 0;
    private $ordersn = "";

    private $levels
        = array(
            '0' => .18,
            '1' => .1,
            '2' => .05,
            '3' => .03,
        );

    /**
     * 计算佣金递归深度
     * 默认递归三级
     * @var int
     */
    private $depth = 4;

    public function __construct($member_id = 0)
    {
        $this->mid = $member_id;
    }

    public function setMid($mid)
    {
        $this->mid = $mid;
    }

    public function getMid()
    {
        return $this->mid;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setOrderSN($ordersn = "")
    {
        $this->ordersn = $ordersn;
    }

    public function getOrderSN()
    {
        return $this->ordersn;
    }

    public function Debug($flag = true)
    {
        $this->debug = $flag;
    }

    public function process()
    {
        return $this->calc();
    }

    private function calc()
    {
        $mid   = $this->mid;
        $count = 0;
        $list  = [];

        while (true) {
            $member = M("Member");
            $rs     = $member->where("mid='{$mid}'")->find();
            if ($rs) {

                $mid           = $rs['recom_id'];
                $rs['returnd'] = $this->price * $this->levels[$count];
                $rs['ordersn'] = $this->ordersn;
                if ($this->debug) {
                    $list[] = $rs;
                } else {
                    $list[] = array(
                        'level'   => $count,
                        'mid'     => $rs['mid'],
                        'returnd' => $rs['returnd'],
                        'msn'     => $rs['msn'],
                        'ordersn' => $rs['ordersn'] = $this->ordersn,
                    );
                }

            } else {
                break;
            }
            if (intval($rs['recom_id']) == 0) break;
            $count++;
            if ($count == $this->depth) break;
        }
        return $list;
    }


}
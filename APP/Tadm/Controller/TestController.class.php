<?php
/**
 * Created by PhpStorm.
 * User: Funky
 * Date: 2017/4/7
 * Time: 上午5:05
 */

namespace Tadm\Controller;


use Tadm\Biz\Levels;
use Tadm\Biz\MemberRechage;
use Think\Controller;

class TestController extends Controller
{
    public function index(){
        //step one
        //插入address表相关信息，返回id
//        $address = D('address');
//        $adddata['msn'] = '';
//        $adddata['msn'] = '';
//        $adddata['msn'] = '';
//        $adddata['msn'] = '';
//        $adddata['msn'] = '';
        //step two
        //查询商品信息
        $totalamount = 0;
        $goods = M('goods')->where("goods_id in (1,2)")->select();
        foreach ($goods as &$g ){
            $g['num'] = 2;
            $totalamount+=$g['num']*$g['goods_price'];
        }
        //开始创建订单
        $order = new \Tadm\Biz\Order();
        $cart = array('sum'=>$totalamount,'items'=>$goods);
        $order->create(1,2,$cart);
    }

    public function tree(){
        $recharge = new MemberRechage(4);
        $recharge->setPrice(10000);
        $recharge->relationTree();

        echo "<pre>";
        $recharge->getTree();
        $recharge->save();

    }

    public function member(){
        $member = new Levels("000001");
        $member->check(0);
    }
}
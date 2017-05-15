<?php
/**
 * Created by PhpStorm.
 * User: Funky
 * Date: 2017/4/7
 * Time: 上午5:03
 */

namespace Tweb\Biz;


class Order
{

	
    /**
     * 得到历史订单
     * @param  string  $cond     条件
     * @param  integer $page     当前页
     * @param  integer $pagesize 每页条数
     * @return [array            佣金数据
     */
    static public function getOrder($cond='',$page=1,$pagesize=10){
        $whereStr = "";
        $result = array();

        $orderby = 'order by create_time desc';

        $start = ($page-1) * $pagesize;
        $limit = " limit {$start},{$pagesize}";
        $whereStr = implode(" AND ", $cond);

        $str = " FROM ts_order WHERE %s %s";
        $tplcount = ' SELECT count(*) num '.$str;
        $tpl      = " SELECT * ".$str;
        $sqlcount = sprintf($tplcount,$whereStr,$orderby);
        $sql = sprintf($tpl,$whereStr,$orderby);
// echo $sql;exit;
        $model = M();
        $countdata = $model->query($sqlcount);
        $count = $countdata[0]['num'];

        $sql .= $limit;
        $list = $model->query($sql);

        foreach ($list as $key => $value) {
            //查询订单商品信息
            $order_goods = M('order_goods')->field('goods_thumb,goods_code')->where("order_sn='{$value[order_sn]}'")->select();
            $list[$key]['order_goods'] = empty($order_goods) ? [] : $order_goods;
            //查询订单状态
            if($value['is_comm']==1){
                $order_sta_str = '已评论';
            }elseif($value['shipping_status']==2){
                $order_sta_str = '已确认收货';
            }elseif($value['shipping_status']==1){
                $order_sta_str = '已发货';
            }elseif($value['order_status']==1){
                $order_sta_str = '已付款';
            }elseif($value['order_status']==0){
                $order_sta_str = '未付款';
            }elseif($value['order_status']==2){
                $order_sta_str = '已取消';
            }
            $list[$key]['order_sta_str'] = $order_sta_str;

        }
// print_r($list);exit;
        return array(
            'pagetotal' => ceil($count/$pagesize),
            'count' => $count,
            'data' => empty($list) ? [] : $list,
        );
    }

    /**
     * 计算不同用户类型订单总金额
     * @param  array   $goods    商品信息
     * @param  integer $mid      用户id
     * @param  integer $gNum     商品购买数量
     * @return decimal           金额
     */
    public function getOrderSumByid($goods=array(),$mid=0,$gNum=1){
        if(empty($goods) || !$mid) return false;
        $sum = 0;   //订单总金额
        // 查询用户信息 
        // 会员类型：1.众筹股东(金牌) 2.总代理(银牌) 3.VIP会员(铜牌) 4.普通会员(无)
        $userinfo = M('member')->field('type')->where("mid='{$mid}'")->find();
        switch ($userinfo['type']) {
            case '1':
                $sum = $goods['goods_partner_price'] * $gNum;
                break;
            case '2':
                $sum = $goods['goods_agency_price'] * $gNum;
                break;
            case '3':
                $sum = $goods['goods_vip_price'] * $gNum;
                break;          
            default :
                $sum = $goods['goods_price'] * $gNum;
                break; 
        }

        return $sum;
    }

}
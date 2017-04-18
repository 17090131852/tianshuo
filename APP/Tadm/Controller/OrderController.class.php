<?php
namespace Tadm\Controller;

use Tadm\Biz\Commission;
use Tadm\Biz\Levels;


class OrderController extends Base
{
    /**
     * 线上订单列表
     */
    public function index()
    {
        $map             = array('1=1'); //条件数组
        $pagesize        = 10;
        $order_status    = $this->request('order_status', 'int', 0);    //订单状态：0未付款；1已付款；2关闭
        $shipping_status = $this->request('shipping_status', 'int', 0); //商品配送状态：0未发货；1已发货；2已确认收货
        $start_time      = $this->request('start_time', 'string', '');
        $end_time        = $this->request('end_time', 'string', '');
        $order_sn        = $this->request('order_sn', 'string', '');
        $tel             = $this->request('tel', 'string', '');
        $realname        = $this->request('realname', 'string', '');
        $msn             = $this->request('msn', 'string', '');

        if ($order_status) {
            $map['order_status'] = $order_status - 1;
        }
        if ($shipping_status) {
            $map['shipping_status'] = $shipping_status - 1;
        }
        if (!empty($start_time) && empty($end_time)) {
            $map['create_time'] = array('egt', $start_time);
        }
        if (!empty($end_time) && empty($start_time)) {
            $map['create_time'] = array('elt', $end_time);
        }
        if (!empty($start_time) && !empty($end_time)) {
            $map['create_time'] = array('between', "{$start_time},{$end_time}");
        }
        if (!empty($order_sn)) {
            $map['order_sn'] = array('like', $order_sn . '%');
        }
        if (!empty($msn)) {
            $map['ts_member.msn'] = array('like', $msn . '%');
        }
        if (!empty($tel)) {
            $map['tel'] = $tel;
        }
        if (!empty($realname)) {
            $map['ts_member.realname'] = array('like', $realname . '%');
        }

        $model = M('order');
        $count = $model->where($map)
            ->join('ts_member on ts_order.msn=ts_member.msn', 'LEFT')
            ->count();

        $Page = new \Think\Page($count, $pagesize);
        $show = $Page->show();

        $data = $model
            ->where($map)
            ->field('id,order_sn,ts_order.msn as o_msn,order_status,shipping_status,ts_order.realname as o_name,province,ts_order.city as o_city,county,ts_order.address as o_address,tel,create_time,integral,ts_member.nickname as m_nickname,ts_member.realname as m_realname,mobile_phone')
            ->join('ts_member on ts_order.msn=ts_member.msn', 'LEFT')
            ->order('id desc')
            ->limit($Page->firstRow . ',' . $Page->listRows)->select();
//        echo $model->getLastSql();

        $this->order_status    = $order_status;
        $this->shipping_status = $shipping_status;
        $this->start_time      = $start_time;
        $this->end_time        = $end_time;
        $this->order_sn        = $order_sn;
        $this->tel             = $tel;
        $this->realname        = $realname;
        $this->order_sn        = $order_sn;
        $this->msn             = $msn;
        $this->data            = $data;
        $this->page            = $show;
    }

    /**
     * 线上订单详情
     */
    public function view()
    {
//        echo '<pre>';
        $id = $this->request('id', 'int', 0);

        //主订单信息
        $model = M('order');
        $data  = $model->where("id='{$id}'")->find();
        if (empty($data)) {
            $this->error('订单信息有误', '/Tadm/order/index');
        }
        $order_sn   = $data['order_sn'];
        $member_msn = $data['msn'];
        //订单商品信息
        $order_goods_model = M('order_goods');
        $goods_data        = $order_goods_model->where("order_sn = '{$order_sn}'")->select();

        //用户信息
        $member      = M('member');
        $member_data = $member->where("msn='{$member_msn}'")->find();

        $this->data        = $data;
        $this->goods_data  = $goods_data;
        $this->member_data = $member_data;
    }

    /**
     * 更新订单支付状态
     */
    public function changeOrderStatus()
    {
        $id     = $this->get('id', 'int', 0);
        $status = $this->get('status', 'int', 0);
        if (!$id) {
            $this->error('订单信息有误！', '/Tadm/order/index');
        }

        //更新订单状态
        $orderobj             = M("order");
        $data['order_status'] = $status;
        $res                  = $orderobj->where("id='{$id}'")->save($data);

        if (!$res) {
            $this->error('订单操作失败', '/Tadm/order/index');
            exit;
        }

        //查询用户msn - 更新用户等级
        $order = $orderobj->field('msn')->where("id='{$id}'")->find();
        if (!empty($member)) {
            //更新用户等级
            $level = new Levels($member['msn']);
            $rs    = $level->check($order['integral']);
        }

        $this->success('订单状态操作成功！', '/Tadm/order/index');
        exit;

    }

    /**
     * 更新订单配送状态
     */
    public function changeOrderShippingStatus()
    {
        $id     = $this->get('id', 'int', 0);
        $status = $this->get('status', 'int', 0);
        if (!$id) {
            $this->error('订单信息有误！', '/Tadm/order/index');
        }

        //更新订单状态
        $order                   = M("order");
        $data['shipping_status'] = $status;
        $res                     = $order->where("id='{$id}'")->save($data);
        if (!$res) {
            $this->error('订单操作失败', '/Tadm/order/index');
            exit;
        }

        $this->success('订单状态操作成功！', '/Tadm/order/index', 10);
        exit;

    }

    /**
     * 线下订单列表
     */
    public function offline_index()
    {
        $map          = array('1=1'); //条件数组
        $pagesize     = 10;
        $order_sta    = $this->request('order_sta', 'int', 0);    //订单状态：0未审核；1已审核；
        $start_time   = $this->request('start_time', 'string', '');
        $end_time     = $this->request('end_time', 'string', '');
        $order_sn     = $this->request('order_sn', 'string', '');
        $carno        = $this->request('carno', 'string', '');
        $msn          = $this->request('msn', 'string', '');
        $mobile_phone = $this->request('mobile_phone', 'string', '');
        $auth         = $this->request('auth', 'string', '');
        $recom        = $this->request('recom', 'string', '');

        $starttime = strtotime($start_time);
        $endtime   = strtotime($end_time);

        if ($order_sta) {
            $map['order_sta'] = $order_sta - 1;
        }

        if (!empty($start_time) && empty($end_time)) {
            $map['ctime'] = array('egt', $starttime);
        }

        if (!empty($end_time) && empty($start_time)) {
            $map['ctime'] = array('elt', $endtime);
        }

        if (!empty($start_time) && !empty($end_time)) {
            $map['ctime'] = array('between', "{$starttime},{$endtime}");
        }

        if (!empty($order_sn)) {
            $map['order_sn'] = array('like', $order_sn . '%');
        }

        if (!empty($carno)) {
            $map['carno'] = array('like', $carno . '%');
        }

        if (!empty($msn)) {
            $map['msn'] = array('like', $msn . '%');
        }
        if (!empty($mobile_phone)) {
            $map['mobile_phone'] = $mobile_phone;
        }
        if (!empty($auth)) {
            $map['auth'] = array('like', $auth . '%');
        }
        if (!empty($recom)) {
            $map['recom'] = array('like', $msn . '%');
        }

        $model = M('offline_order');
        $count = $model->where($map)->count();

        $Page = new \Think\Page($count, $pagesize);
        $show = $Page->show();

        $data = $model
            ->where($map)
            ->order('id desc')
            ->limit($Page->firstRow . ',' . $Page->listRows)->select();
//        echo $model->getLastSql();

        $this->order_sta    = $order_sta;
        $this->start_time   = $start_time;
        $this->end_time     = $end_time;
        $this->order_sn     = $order_sn;
        $this->mobile_phone = $mobile_phone;
        $this->auth         = $auth;
        $this->order_sn     = $order_sn;
        $this->msn          = $msn;
        $this->recom        = $recom;
        $this->data         = $data;
        $this->page         = $show;
    }

    //线下订单录入
    public function add()
    {
        if (!IS_POST) {
            $this->display('Tpl/orderAdd');
        } else {
            //验证数据
            $exsist = M('offline_order')->where('order_sn="' . I('post.orderSn') . '"')->find();
            if ($exsist) {
                $this->error('订单号已存在', '', 1);
            }
            $memInfo = M('member')->where('mobile_phone="' . I('post.mid') . '"')->find();
            //检测用户是否存在
            if (!$memInfo) {
                $this->error('用户不存在', '', 1);
                /* 注册新用户
                $recom = M('member')->where('mobile_phone="'.I('post.recom').'"')->find();
                if(!$recom){
                    $this->error('推荐人不存在','',1);
                }else{
                    $dataM['recom'] = $recom['msn'];
                } */
            } else {
                $data['order_sn'] = I('post.orderSn');
                $data['carno']    = I('post.carno');
                $data['price']    = I('post.price');
                $data['num']      = I('post.num');
                $data['total']    = I('post.total');
                $data['msn']      = $memInfo['msn'];
                $data['remark']   = I('post.remark');
                $data['auth']     = I('post.auth');
                $data['ctime']    = time();

                $addRs = M('offline_order')->add($data);
                if ($addRs !== false) {
                    $this->success('保存成功', '', 1);
                } else {
                    $this->error('保存失败', '', 1);
                }
            }
        }
    }
}
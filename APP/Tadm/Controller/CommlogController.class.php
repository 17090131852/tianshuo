<?php
namespace Tadm\Controller;


class CommlogController extends Base
{
    /**
     * 佣金提现
     */
    public function index()
    {
        $map        = array('1=1'); //条件数组
        $pagesize   = 10;
        $state      = $this->request('state', 'int', 0);    //状态 0、未申请 1、已提交  2、已审核 3、已支付
        $member_msn = $this->request('member_msn', 'string', '');
        $yearweek   = $this->request('yearweek', 'string', '');

        if ($state) {
            $map['state'] = $state - 1;
        }
        if (!empty($member_msn)) {
            $map['member_msn'] = array('like', $member_msn . '%');
        }
        if (!empty($yearweek)) {
            $map['yearweek'] = $yearweek;
        }
        $model = M('member_commlog');
        $count = $model->where($map)
            ->join('ts_member on ts_member_commlog.member_msn=ts_member.msn', 'LEFT')
            ->count();

        $Page = new \Think\Page($count, $pagesize);
        $show = $Page->show();

        $data = $model
            ->where($map)
            ->join('ts_member on ts_member_commlog.member_msn=ts_member.msn', 'LEFT')
            ->order('id desc')
            ->limit($Page->firstRow . ',' . $Page->listRows)->select();
//        echo $model->getLastSql();

        $yearweek = $model->field('yearweek')->select(); //查询所有的年周

        $this->member_msn = $member_msn;
        $this->yearweek   = $yearweek;
        $this->state      = $state;
        $this->data       = $data;
        $this->page       = $show;
    }

    /**
     * 佣金详情
     */
    public function view()
    {
//        echo '<pre>';
        $id = $this->request('id', 'int', 0);

        //佣金信息
        $model = M('member_commlog');
        $data  = $model->where("id='{$id}'")->find();
        if (empty($data)) {
            $this->error('佣金信息有误', '/Tadm/Commlog/index');
        }

        //查询用户信息
        $memberobj = M('member');
        $member = $memberobj->where("msn='{$data['member_msn']}'")->find();

        //根据佣金周查询佣金对应列表
        $startt            = strtotime($data['starttime']);
        $endt              = strtotime($data['endtime']);

        $map['addtime']    = array('between', "$startt,$endt");
        $map['member_msn'] = $data['member_msn'];

        //佣金详细信息
        $model_comm = M('member_commission');
        $comm_data  = $model_comm->where($map)->select();

        $this->data      = $data;
        $this->member    = $member;
        $this->comm_data = $comm_data;

    }

    /**
     * 更新订单支付状态
     */
    public function changeState()
    {
        $id    = $this->get('id', 'int', 0);
        $state = $this->get('state', 'int', 0);
        if (!$id) {
            $this->error('佣金信息有误！', '/Tadm/Commlog/index');
        }

        //更新订单状态
        $commlogobj    = M("member_commlog");
        $data['state'] = $state;
        $res           = $commlogobj->where("id='{$id}'")->save($data);

        if (!$res) {
            $this->error('佣金状态操作失败', '/Tadm/Commlog/index');
            exit;
        }

        $this->success('佣金状态操作成功！', '/Tadm/Commlog/index');
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
        $order_status = $this->request('order_status', 'int', 0);    //订单状态：0未审核；1已审核；
        $start_time   = $this->request('start_time', 'string', '');
        $end_time     = $this->request('end_time', 'string', '');
        $order_sn     = $this->request('order_sn', 'string', '');
        $tel          = $this->request('tel', 'string', '');
        $realname     = $this->request('realname', 'string', '');
        $msn          = $this->request('msn', 'string', '');
        $recom        = $this->request('recom', 'string', '');

        if ($order_status) {
            $map['order_sta'] = $order_status - 1;
        }

        if (!empty($start_time)) {
            $starttime    = strtotime($start_time);
            $map['ctime'] = array('egt', $starttime);
        }
        if (!empty($end_time)) {
            $endtime      = strtotime($end_time);
            $map['ctime'] = array('elt', $endtime);
        }
        if (!empty($order_sn)) {
            $map['order_sn'] = array('like', $order_sn . '%');
        }
        if (!empty($msn)) {
            $map['msn'] = array('like', $msn . '%');
        }
        if (!empty($tel)) {
            $map['mobile_phone'] = $tel;
        }
        if (!empty($realname)) {
            $map['auth'] = array('like', $realname . '%');
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

        $this->order_status = $order_status;
        $this->start_time   = $start_time;
        $this->end_time     = $end_time;
        $this->order_sn     = $order_sn;
        $this->tel          = $tel;
        $this->realname     = $realname;
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
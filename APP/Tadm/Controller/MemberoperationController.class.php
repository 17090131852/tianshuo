<?php
/**
 * Created by PhpStorm.
 * User: Funky
 * Date: 2017/4/7
 * Time: 上午5:51
 */

namespace Tadm\Controller;


use Tweb\Controller\Base;

class MemberoperationController extends Base
{
    public function gd()
    {
        $id     = intval($_GET['id']);
        $member = M("member")->where("mid = '$id'")->find();
        if ($member) {

        }
        $this->assign("mid", $id);
    }

    public function open()
    {
        $cart['items'] = array(
            'goods_code' => 'TS55983635JIULNB',
            'num'        => 2,
        );
        $cart['sum']   = 5000;

        if (IS_POST) {
            $member = M("member");
            $data   = $_POST;

            $mid = $data['mid'];
            unset($data['mid']);
            $member = M("member")->where("mid='{$mid}'")->find();

            if ($member) {
                $data['msn']   = $member['msn'];
                $data['ctime'] = time();
                $data['utime'] = time();
                $res           = M("address")->add($data);
                if (!$res) {
                    $this->error('收货地址填写错误！', '/Tadm/Member/index', 5);
                }
                //检测是否已升级成股东
                if ($member['type'] == 1 && $member['acount_sta'] == 2) {
                    redirect('/Tadm/Member/index/', 5, '该会员已升级为股东！');
//                    $this->error('该会员已升级为股东','/Tadm/Member/index',5);
                }
                //定向消费积分更新
                $member                     = M("member"); // 实例化MEMBER对象
                $member->orient_score       = 50000;
                $member->leave_orient_score = 50000;
                $member->where("mid='{$mid}'")->save(); // 根据条件更新记录
                //产生五笔订单
                $order  = new \Tadm\Biz\Order;
                $or_res = $order->Create($mid, $res, $cart);
                if ($or_res) {
                    redirect('/Tadm/Member/index/', 5, '审核成功！');
                } else {
                    redirect('/Tadm/Member/index/', 5, '数据提交不完全！');
                }

            }

        }

    }

    /**
     * 更新用户审核状态
     */
    public function audit()
    {
        $score = 0;//会员增加积分
        $mid   = isset($_GET['id']) ? intval($_GET['id']) : 0;

        //查询用户信息根据mid
        $member = M('member')->where("mid='{$mid}'")->find();
        //判断是否存在该会员
        if (empty($member)) {
            $this->redirect('/Tadm/Member/index', 5, '该会员不存在！');
        }

        //判断该会员类型
//        if ($member['type'] == 1) {
//            //如为股东，跳转到添加收货地址页面
//            $this->redirect('/Memberoperation/open');
//        } else {
        //更新该用户积分
        if ($member['type'] == 1) {
            $score = 50000;
        } elseif ($member['type'] == 2) {
            //总代
            $score = 10000;
        } elseif ($member['type'] == 3) {
            //VIP会员
            $score = 1000;
        }

        $member              = M("member"); // 实例化MEMBER对象
        $data['all_score']   = $score;
        $data['leave_score'] = $score;
        $data['acount_sta']  = 2;
        $member->where("mid='{$mid}'")->save($data); // 根据条件更新记录
        // echo $member->getLastSQL();
        // exit;
        $this->success('审核成功！','/Memberoperation/index');
        // exit;
    }
}
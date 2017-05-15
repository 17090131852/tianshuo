<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 10:24
 */
namespace Tweb\Controller;
use Tweb\Biz\datefmt;

class AwardController extends Base
{

	public function _initialize(){
        header("Content-type: text/html; charset=utf-8"); 

    	//返回轮播图资源等等等
    	$objCommend = M('commends');
    	$objResource = M('resources');
    	$commendStatus = $objCommend->where('location = "个人中心"')->find();
    	$resourceList = $objResource->where('resource_id="'.$commendStatus['id'].'"')->select();
    	$this->resourceList = $resourceList;
	}

    public function submit(){
        if(IS_POST){
            $data = $_POST;
            $id = intval($data['id']);
            if($id){
                $log = M("member_commlog");
                $data['state'] = 1;
                $result = $log->where("id='{$id}'")->save($data);
                $this->redirect("/Award/index");
            }
        }

        exit;
    }
    /**
     * 查询奖励历史
     */
    public function index(){
//        echo "<pre>";
        //得到前三个月的开始时间和结束时间
        $id        = $_GET['week'];
        $starttime = new \DateTime();
        $starttime->sub(new \DateInterval('P3M'));
        $starttime = $starttime->format("Y-m-d");
        $endtime   = date("Y-m-d");

        //查询该用户所有的周返佣记录
        $wherein = '';
        if($id>0){
            $wherein = " and id='{$id}'";
        }
        $msn = $_SESSION['msn'];
        $sql = "SELECT * from ts_member_commlog WHERE member_msn='{$msn}'";
        $result=M("member_commlog")->where("member_msn='{$msn}' {$wherein}")->limit(0,10)->select();
        $result = $list = \Tweb\Biz\Arrays::setkeys($result,'yearweek');
        //生成前三个月的周列表
        $date = new datefmt();
        $data = $date->get_weeks($starttime,$endtime);
        //交叉对比前三个月有交易产生的周，加星
        foreach($data as &$t){
            //判断改周是否有返佣记录
            $flag = isset($result[$t['yearweek']]) ? '*' : '';
            $default = array(
                'submittime' =>'',
                'id' =>'',
                'member_msn' =>'',
                'amount'     => '0',
            );
            if($flag){
                $default = array_merge($default,$result[$t['yearweek']]);
            }

            $starttime = new \DateTime($t['endtime']);
            $starttime->add(new \DateInterval('P1D'));
            $default['submittime'] = $starttime->format("Y-m-d");

            $t = array_merge($t,$default);
            $t['str'] = str_replace('-','',$t['starttime'] . '~' . $t['endtime'] .' '. $flag);
        }

        if($id!=0){
            $this->assign("list",$result);
        }

        $this->assign('data',$data);
        $this->assign('id',$id);


    }

    /**
     * 提现操作
     * @return [type] [description]
     */
    // public function cashWithdrawal(){
       

        //提现金额
        // $_SESSION['amount'] = $amount;
        // //判断该用户是否有银行卡
        // $bank = M('bank')->where("msn='$msn' and state='0'")->find();
        // if(empty($bank)){
        //     $this->redirect('Award/bank');
        // }else{
        //     $this->redirect('Award/bank_list');
        // }

    // }

    /**
     * 保存提现记录
     * @return [type] [description]
     */
    public function cashWithdrawal(){
        $mid = $_SESSION['mid'];
        $msn = $this->getMsn();

        $amount  = $this->get('amount','float',0.00); //提现金额
        $bank_id = $this->get('id','int',0); //银行卡id
// print_r($bank_id);exit;
        //判断提现金额是否大于该用户可提现金额
        //会员类型：1.众筹股东(金牌) 2.总代理(银牌) 3.VIP会员(铜牌) 4.普通会员(无)
        //acount_sta 账户状态 1未交费，2已交费
        $member = M('member')->field('mid,msn,leave_money,type,acount_sta')->where("msn='$msn'")->find();
        if($member['type']>=4){
            $this->error('提现会员类型受限！');
        }

        if($member['acount_sta']!=2){
            $this->error('您未交费，请先交费！');
        }

        if($amount>$member['leave_money']){
            $this->error('提现金额超限!','',1);
        }

        $member = D('member');
        $res = $member->saveCashWithdrawal($mid,$msn,$amount,$bank_id);
        if($res){
            redirect('/Award/index', 2, '提现申请已提交，请等待审核...');
        }else{
            redirect('/Award/index', 2, '提现失败，跳转中...');

        }
    }

    /**
     * 银行卡列表
     * @return [type] [description]
     */
    public function bank_list(){
        $msn    = $this->getMsn();
        $data = M('bank')->where("msn='$msn' and state='0'")->select();
        $this->assign('data',$data);
    }

    /**
     * 添加银行卡
     * @return [type] [description]
     */
    public function bank(){
        $flag = $this->get('flag','int',0); //是否为提现时添加银行卡
        if(IS_POST){
            $data = array();
            $data['account_name']   = $this->post('account_name','string','');
            $data['card_number']    = $this->post('card_number','string','');
            $data['bank_account']   = $this->post('bank_account','string','');
            $data['branch_account'] = $this->post('branch_account','string','');
            $data['msn']            = $this->getMsn();
            $data['mid']            = $_SESSION['mid'];
            $flag                   = $this->post('flag','int',0);//是否为提现时添加银行卡

            $member = D('member');
            $res = $member->saveBank($data);
            if($res['status']==1 && $flag){
                $this->redirect('Award/cash');
            }else{
                $this->redirect('Award/bank_list');
            }
        }

        $this->flag = $flag;
    }

    /**
     * 删除银行卡信息
     * @return [type] [description]
     */
    public function delBank(){
        $id = $this->get('id','int',0);
        if(!$id){
            $this->redirect('Award/bank_list');
        }else{
            $bank = M("bank");
            // 要修改的数据对象属性赋值
            $data['state'] = 1;
            $bank->where("id='$id'")->save($data); // 根据条件保存修改的数据
            $this->redirect('Award/bank_list');
        }
    }

    /**
     * 提现记录
     * @return [type] [description]
     */
    public function play_money(){
        $pagesize = 10;
        $map['ts_presentation_record.msn'] = $this->getMsn(); //用户编号

        $start_time = $this->post("reg_time_start","string",""); //开始时间
        $end_time   = $this->post("reg_time_end","string",""); //介绍时间
        $order_sn   = trim($this->post("order_sn","string","")); //订单流水号
        $state      = $this->post("level","int",0); //状态

        //时间查询
        if (!empty($start_time) && empty($end_time)) {
            $map['ts_presentation_record.addtime'] = array('egt', $start_time);
        }
        if (!empty($end_time) && empty($start_time)) {
            $map['ts_presentation_record.addtime'] = array('elt', $end_time);
        }
        if (!empty($start_time) && !empty($end_time)) {
            $map['ts_presentation_record.addtime'] = array('between', "{$start_time},{$end_time}");
        }
        //订单号
        if (!empty($order_sn)) {
            $map['order_sn'] = array('like', $order_sn . '%');
        }
        //状态
        if(!empty($state)){
            $map['ts_presentation_record.state'] = $state;
        }

        $model = M('presentation_record');
        $count = $model->where($map)->count();
        $Page = new \Think\Page($count, $pagesize);
        $show = $Page->show();

        $data = $model
            ->where($map)
            ->field('ts_presentation_record.id,order_sn,amount,ts_presentation_record.state,bank_id,remark,ts_presentation_record.addtime,card_number,bank_account')
            ->join('ts_bank on ts_presentation_record.bank_id=ts_bank.id', 'LEFT')->order('ts_presentation_record.id desc')
            ->limit($Page->firstRow . ',' . $Page->listRows)->select();

        $this->data  = $data;
        $this->page  = $show;
    }

    public function index1(){

        $starttime = new \DateTime();
        $starttime->sub(new \DateInterval('P3M'));
        $starttime = $starttime->format("Y-m-d");
        $endtime = date("Y-m-d");
        $msn = $_SESSION['msn'];
        $sql = "select sum(commamont) as amount,member_msn,YEARWEEK(FROM_UNIXTIME(addtime,\"%Y-%m-%d\"),1)as `yearweek` from ts_member_commission where member_msn = '{$msn}' group by YEARWEEK(FROM_UNIXTIME(addtime,\"%Y-%m-%d\"),1)";
        $result = M()->query($sql);
        $result = $list = \Tweb\Biz\Arrays::setkeys($result,'yearweek');

        $date = new datefmt();
        $data = $date->get_weeks($starttime,$endtime);

        foreach($data as &$t){
            $flag = isset($result[$t['yearweek']]) ?'*' : '';

            $default = array(
                'submit' =>'',
                'member_msn' =>'',
                'amount'     => '0',
            );

            $year = intval(substr($t['yearweek'],0,4));
            $week = intval(substr($t['yearweek'],4,2))-1;
            $default = array_merge($default,$date->weekday($year,$week));


            $starttime = new \DateTime($default['end']);
            $starttime->add(new \DateInterval('P1D'));
            $default['submit'] = $starttime->format("Y-m-d");
            if($flag){
                $default = array_merge($default,$result[$t['yearweek']]);
            }

            $t = array_merge($t,$default);
            $t['str'] = str_replace('-','',$t['start'] . '~' . $t['end'] .' '. $flag);
        }
//        echo "<pre>";
//        print_r($data);
//        exit;

        $this->assign('listselect',$data);
    }

    /**
     * 提现
     * @return [type] [description]
     */
    public function cash(){
        $all_amount = 0; //用户可提现金额
        $msn        = session('msn');
        //查询用户资金余额
        $member = M('member')->field('mid,msn,leave_money')->where("msn='$msn'")->find();
        //查询用户银行卡信息
        $bank = M('bank')->where("msn='$msn'")->select();
        //查询提现手续费
        $Fee_data = M('fee_set')->find();
        if(empty($Fee_data)){
            $Fee=0;
        }else{
            $Fee=$Fee_data['fee'];
        }
        //打款状态  1、已提交  2、审核失败 3、审核成功；4、打款失败；5、打款成功
        $amount = M('presentation_record')->where("msn='$msn' and state in(1,3) ")->sum('amount');

        $all_amount = $member['leave_money']-$amount;
        //异常处理
        if($all_amount<0){
            $all_amount = 0;
        }
        $this->leave_money = $all_amount;
        $this->bank      = $bank;
        $this->fee       = $Fee;
    }
}
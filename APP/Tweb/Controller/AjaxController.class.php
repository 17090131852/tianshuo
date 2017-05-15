<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 10:24
 */
namespace Tweb\Controller;
use Think\Controller;
use Tweb\Biz\Member;
use Tweb\Biz\Order;

class AjaxController extends \Tweb\Controller\BaseController {

    /**
     *  下属小组消费信息
     * @return [ type] [description]
     */
    public function getGroupList(){
        $beginThismonth = mktime(0,0,0,date('m'),1,date('Y'));
        $endThismonth  = mktime(23,59,59,date('m'),date('t'),date('Y'));
        $maxscore  = 1000;//小组积分超过指定的则给到奖励
        $recom_msn = $this->getMsn();
        $cond      = array('1=1');

        $page       = $this->request('page','int',1);
        $pagesize   = $this->request('pagesize','int',10);
        $allscore_start = $this->request('allscore_start','int',0);
        $allscore_end   = $this->request('allscore_end','int',0);
//        $period         = $this->request('period','int',0);

        //消费积分区间
        if(!empty($allscore_start) && !empty($allscore_end)){
            $cond[] = "a.sum between $allscore_start and $allscore_end";
        }elseif(!empty($allscore_start)){
            $cond[] = "a.sum >$allscore_start";
        }elseif(!empty($allscore_end)){
            $cond[] = "a.sum >$allscore_end";
        }
        //统计周期 按月
        $cond[] = "ctime between '$beginThismonth' and '$endThismonth'";

        $member = D('member');
        $data = $member->getList($cond,$recom_msn,$maxscore,$page,$pagesize);

        echo json_encode($data);exit;
    }

    /**
     *  下属人员信息
     * @return [ type] [description]
     */
    public function getUnderling(){
        $recom_msn = $this->getMsn();
        $cond      = array('1=1');

        $page           = $this->request('page','int',1);
        $pagesize       = $this->request('pagesize','int',10);
        $msn            = $this->request('msn','string','');
        $name           = $this->request('name','string','');
        $reg_time_start = $this->request('reg_time_start','string','');
        $reg_time_end   = $this->request('reg_time_end','string','');
        $type           = $this->request('type','int',0);

        if(!empty($recom_msn)){
            $cond[] = "recom_msn='$recom_msn'";
        }
        if(!empty($msn)){
            $cond[] = "msn like '$msn%'";
        }
        if(!empty($name)){
            $cond[] = "realname like '$name%'";
        }
        if(!empty($reg_time_start) && !empty($reg_time_end)){
            $s_time = strtotime($reg_time_start.' 0:0:0');
            $e_time = strtotime($reg_time_end.' 23:59:59');
            $cond[] = " reg_time between '$s_time' and '$e_time'";
        }elseif(!empty($reg_time_start)){
            $s_time = strtotime($reg_time_start.' 0:0:0');
            $cond[] = " reg_time >='$s_time'";
        }elseif (!empty($reg_time_end)) {
            $e_time = strtotime($reg_time_end . ' 23:59:59');
            $cond[] = " reg_time <='$e_time'";
        }

        if($type){
            $cond[] = "type = $type";
        }
//        print_r($cond);exit;
        $member = D('member');
        $data = $member->getUnderling($cond,$page,$pagesize);

        echo json_encode($data);exit;
    }

    /**
     * 得到奖励历史
     * @return [type] [description]
     */
    public function getAward(){
        $msn    = $this->getMsn();
        $cond[] =  "c.member_msn='$msn'";
        
        $page     = $this->request('page','int',1);
        $pagesize = $this->request('pagesize','int',10);

        $member = new Member();
        $data   = $member->getAward($cond,$page,$pagesize);

        echo json_encode($data);exit;
    }

    /**
     * 得到历史订单
     * @return [type] [description]
     */
    public function getOrder(){
        $msn    = $this->getMsn();
        $cond[] =  "msn='$msn'";
        
        $page     = $this->request('page','int',1);
        $pagesize = $this->request('pagesize','int',10);
        $type     = $this->request('type','int',1); //订单类型 1 积分商城 2 汽车超市
        $status   = $this->request('status','int',0);//1:待收货、2:待评价、3:已取消、4:未支付、5:已支付
        $order_sn = $this->request('order_sn','string','');
        if($status){
            switch ($status) {
                case '1':
                    $cond[] = "shipping_status=1";
                    break;
                case '2':
                    $cond[] = "shipping_status=2 and is_comm=0";
                    break;  
                case '3':
                    $cond[] = "order_status=2";
                    break;  
                case '4':
                    $cond[] = "order_status=0";
                    break;                                 
                case '5':
                    $cond[] = "order_status=1 and shipping_status=0";
                    break;                        
            }
        }

        if(!empty($order_sn)){
            $cond[] = "order_sn like '$order_sn%'";
        }

        $cond[] =  "type='$type'";
        $order = new Order();
        $data   = $order->getOrder($cond,$page,$pagesize);

        echo json_encode($data);exit;
    }

    public function saveMsg(){
        $res = array();
        // header("Content-type: text/html; charset=utf-8"); 
        // if(IS_POST){
        $nickname = $this->request('nickname','string','');
        $msg      = $this->request('msg','string','');
        // 随机获取一个用户头像
        $Member = new Member();
        $face  = $Member->getFace();

        $wall = M("wechat_wall");
        $data = array(
            'openid'    =>  0,
            'username'  =>  $nickname,
            'face'      =>  $face,
            'msg'       =>  $msg,
            'createtime' => date("Y-m-d H:i:s"),
            'state'      => 1,
            'source'     => 2,
        );

        $res_add = $wall->add($data);
        if($res_add){
            $res['status'] = 1;
            $res['msg'] = '信息提交成功，等待审核上墙...';
        }else{
            $res['status'] = 0;
            $res['msg'] = '信息提交失败，请重新提交';            
        }
        echo json_encode($res);exit;
        // }
    }
}
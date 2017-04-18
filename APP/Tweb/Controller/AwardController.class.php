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
        $id = $_GET['week'];
        $starttime = new \DateTime();
        $starttime->sub(new \DateInterval('P3M'));
        $starttime = $starttime->format("Y-m-d");
        $endtime = date("Y-m-d");

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



//
//        echo "<pre>";
//        print_r($data);
//        exit;

        $this->assign('listselect',$data);
    }
}
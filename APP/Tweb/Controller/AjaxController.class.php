<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 10:24
 */
namespace Tweb\Controller;
use Think\Controller;


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
            $cond[] = "msn like '%$msn'";
        }
        if(!empty($name)){
            $cond[] = "(nickname like '%$name'or realname like '%$name')";
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

}
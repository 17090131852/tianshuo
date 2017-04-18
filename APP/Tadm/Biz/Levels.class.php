<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/9
 * Time: 21:45
 */

namespace Tadm\Biz;


use Think\Exception;

class Levels
{
    private $msn = 0;
    private $member;
    private $point = 0;
    public function __construct($msn=0)
    {
        if(!$msn) throw New Exception("Please input Member ID!");
        $this->msn = $msn;
        if($msn){
            $this->initMember();
        }
    }



    public function initMember(){
        $member = M("member")->where("msn = '{$this->msn}'")->find();
        if(!$member){
            throw new Exception("Member Not Fount");
        }
        $this->member = $member;

    }

    public function getPointByRange(){
        $datetime = new \DateTime();
        $endtime = $datetime->getTimestamp();
        $datetime->sub(new \DateInterval("P6M"));
        $starttime = $datetime->getTimestamp();
        $sql = "select sum(change_point) as point from ts_member_point where msn = '{$this->msn}' and op_type='2' and addtime between {$starttime} and {$endtime}";
//        echo $sql;
        $db = M();
        $rs = $db->query($sql);
        $point = $rs[0]['point'];
        return $point;
    }

    public function check($point = 0){
        if($this->member['type'] < 3) return 0;
        $levels = $this->member['type'];
        if($this->toLevel1($point)) return;
        switch ($levels){

            // 3.汽车VIP会员(铜牌)
            case 3:
                $this->toLevel2();
                break;

            // 4.普通会员(无)
            case 4:
                if(!$this->toLevel2()){
                    $this->toLevel3($point);
                }
                break;
        }
    }

    private function toLevel3($nowpoint=0){
        $point = 1000;
        if($nowpoint>=$point){
            //echo "Level Up 3";
            M("member")->where("msn='{$this->msn}'")->save(array("type"=>3));
        }
    }


    private function toLevel2(){
        $point = 10000;
        $nowpoint = $this->getPointByRange();
        if($nowpoint>=$point){
//            echo "Level Up 2";
           M("member")->where("msn='{$this->msn}'")->save(array("type"=>2));
            return true;
        }
        return false;
    }

    private function toLevel1($nowpoint){
        $point = 50000;

        if($nowpoint>=$point){
            //echo "Level Up 1";
            M("member")->where("msn='{$this->msn}'")->save(array("type"=>1));
            return true;
        }
        return false;
    }


}
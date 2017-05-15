<?php
/**
 * Created by PhpStorm.
 * User: Funky
 * Date: 2017/4/7
 * Time: 上午5:03
 */

namespace Tweb\Biz;


class Crpty
{
    static public function uuid(){

    }

    static public function makeOrderSN(){
        $date = date("Ymd",strtotime("today"));
        $str = array_merge(range('A','Z'));
        shuffle($str);
        $str = implode('',array_slice($str,0,4));
        return 'TS'.$date.$str;
    }

    static public function makeProductSN(){
        $date = rand(10000000,99999999);
        $str = array_merge(range('A','Z'));
        shuffle($str);
        $str = implode('',array_slice($str,0,6));
        return 'TS'.$date.$str;
    }

    static public function makeMSN(){
        $data = M("member")->field('max(msn) as m_msn')->find();
        $msn = intval($data['m_msn'])+1;

        return  sprintf("%06d",$msn);
    }


}
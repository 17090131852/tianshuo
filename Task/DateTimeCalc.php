<?php

/**
 * Created by PhpStorm.
 * User: Funky
 * Date: 2017/4/16
 * Time: 下午8:46
 */
class DateTimeCalc
{
    static public function weekday($year,$week=1){
        $year_start = mktime(0,0,0,1,1,$year);
        $year_end = mktime(0,0,0,12,31,$year);

        // 判断第一天是否为第一周的开始
        if (intval(date('W',$year_start))===1){
            $start = $year_start;//把第一天做为第一周的开始
        }else{
            $week++;
            $start = strtotime('+1 monday',$year_start);//把第一个周一作为开始
        }

        // 第几周的开始时间
        if ($week===1){
            $weekday['start'] = $start;
        }else{
            $weekday['start'] = strtotime('+'.($week-0).' monday',$start);
        }

        // 第几周的结束时间
        $weekday['end'] = strtotime('+1 sunday',$weekday['start']);
        if (date('Y',$weekday['end'])!=$year){
            $weekday['end'] = $year_end;
        }
        $weekday = array(
            'starttime' => date("Y-m-d",$weekday['start']) ,
            'endtime' => date("Y-m-d",$weekday['end']) ,
        );
        return $weekday;
    }
}
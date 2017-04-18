<?php
namespace Tweb\Biz;
class datefmt{
    function __construct() {}
    /**
     * 根据指定日期获取所在周的起始时间和结束时间
     */
    public function get_weekinfo_by_date($date) {
        $idx = strftime("%u", strtotime($date));
        $mon_idx = $idx - 1;
        $sun_idx = $idx - 7;
        return array(
            'week_start_day' => strftime('%Y-%m-%d', strtotime($date) - $mon_idx * 86400),
            'week_end_day' => strftime('%Y-%m-%d', strtotime($date) - $sun_idx * 86400),
        );
    }
    /**
     * 根据指定日期获取所在月的起始时间和结束时间
     */
    public function get_monthinfo_by_date($date){
        $ret = array();
        $timestamp = strtotime($date);
        $mdays = date('t', $timestamp);
        return array(
            'month_start_day' => date('Y-m-1', $timestamp),
            'month_end_day' => date('Y-m-'.$mdays, $timestamp)
        );
    }
    /**
     * 获取指定日期之间的各个周
     */
    public function get_weeks($sdate, $edate) {
        $range_arr = array();
        // 检查日期有效性
        $this->check_date(array($sdate, $edate));
        // 计算各个周的起始时间
        do {

            $weekinfo = $this->get_weekinfo_by_date($sdate);
            $end_day = $weekinfo['week_end_day'];
            $year = date("Y",strtotime($end_day));
//            echo $end_day;exit;
            $start = $this->substr_date($weekinfo['week_start_day']);
            $end = $this->substr_date($weekinfo['week_end_day']);
            $range = array(
              'year' => $year,
              'yearweek' => $year.date("W",strtotime($end_day)),
                'starttime'  => $year."-".$start,
                'endtime'   => $year."-".$end,

            );
            //$range = str_replace("-","","{$year}{$start} ~ {$year}{$end}");
            $range_arr[] = $range;
            $sdate = date('Y-m-d', strtotime($sdate)+7*86400);
        }while($end_day < $edate);

        $range_arr = array_reverse($range_arr);
        array_shift($range_arr);
        return $range_arr;
    }
    /**
     * 获取指定日期之间的各个月
     */
    public function get_months($sdate, $edate) {
        $range_arr = array();
        do {
            $monthinfo = $this->get_monthinfo_by_date($sdate);
            $end_day = $monthinfo['month_end_day'];
            $start = $this->substr_date($monthinfo['month_start_day']);
            $end = $this->substr_date($monthinfo['month_end_day']);
            $range = "{$start} ~ {$end}";
            $range_arr[] = $range;
            $sdate = date('Y-m-d', strtotime($sdate.'+1 month'));
        }while($end_day < $edate);
        return $range_arr;
    }
    /**
     * 截取日期中的月份和日
     * @param string $date
     * @return string $date
     */
    public function substr_date($date) {
        if ( ! $date) return FALSE;
        return date('m-d', strtotime($date));
    }
    /**
     * 检查日期的有效性 YYYY-mm-dd
     * @param array $date_arr
     * @return boolean
     */
    public function check_date($date_arr) {
        $invalid_date_arr = array();
        foreach ($date_arr as $row) {
            $timestamp = strtotime($row);
            $standard = date('Y-m-d', $timestamp);
            if ($standard != $row) $invalid_date_arr[] = $row;
        }
        if ( ! empty($invalid_date_arr)) {
            die("invalid date -> ".print_r($invalid_date_arr, TRUE));
        }
    }



    /**
     * 获取某年第几周的开始日期和结束日期
     * @param int $year
     * @param int $week 第几周;
     */
    public function weekday($year,$week=1){
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

    /**
     * 计算一年有多少周，每周从星期一开始，
     * 如果最后一天在周四后（包括周四）算完整的一周，否则不计入当年的最后一周
     * 如果第一天在周四前（包括周四）算完整的一周，否则不计入当年的第一周
     * @param int $year
     * return int
     */
    public function week($year){
        $year_start = mktime(0,0,0,1,1,$year);
        $year_end = mktime(0,0,0,12,31,$year);
        if (intval(date('W',$year_end))===1){
            return date('W',strtotime('last week',$year_end));
        }else{
            return date('W',$year_end);
        }
    }
}

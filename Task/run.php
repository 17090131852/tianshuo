<?php
/**
 * Created by PhpStorm.
 * User: Funky
 * Date: 2017/4/16
 * Time: 下午8:39
 */
date_default_timezone_set("PRC");
include_once "config.php";
include_once "DateTimeCalc.php";

$runtime = date("Y-m-d H:i:s");

//init db connect
$dsn = sprintf("%s:dbname=%s;host=%s", $config['DB_TYPE'], $config['DB_NAME'], $config['DB_HOST']);
$dbh = new PDO($dsn, $config['DB_USER'], $config['DB_PWD'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//init sql
$dateSql  = "select sum(commamont) as totalamount,member_msn from ts_member_commission where addtime BETWEEN '%s' and '%s' and statistics <'1' group by member_msn";
$countSql = "select count(DISTINCT(member_msn)) as count from ts_member_commission where addtime BETWEEN '%s' and '%s'";
$u_str    = "update ts_member_commission set statistics=1,last_updatetime='%s' where addtime between '%s' and '%s' and member_msn='%s'";
$member_u_str = "update ts_member set all_money=all_money+%s,leave_money=leave_money+%s where msn='%s'";

//datetime
$year     = date("Y");
$lastweek = date("W") - 2;
$yearweek = $year . $lastweek;
$range    = DateTimeCalc::weekday($year, $lastweek);
$starttme = strtotime($range['starttime'] . "00:00:00");
$endtime  = strtotime($range['endtime'] . "23:59:59");
$submittime = date('Y-m-d',$endtime+86400);

$limit   = sprintf($countSql, $starttme, $endtime);
$dateSql = sprintf($dateSql, $starttme, $endtime);

try {
    $count     = $dbh->query($limit)->fetch();
    $total     = $count[0];
    $pageTotal = ceil($total / $pagelimit);
    for ($i = 0; $i < $pageTotal; $i++) {
        $offset_start = $i * $pagelimit;
        $sql          = $dateSql . " limit $offset_start,$pagelimit";

        $rows = $dbh->query($sql)->fetchAll();
        foreach ($rows as $row) {
            //更新可用余额
            $member_u_sql = sprintf($member_u_str,$row['totalamount'],$row['totalamount'],$row['member_msn']);
            $dbh->exec($member_u_sql);
            //更新 佣金提现表
            $dbh->exec("insert into ts_member_commlog (
                        `member_msn`,`yearweek`,`starttime`,`endtime`,`submittime`,`amount`,`createtime`,`lastuptime`) VALUES ('{$row['member_msn']}','{$yearweek}','{$range['starttime']}','{$range['endtime']}','{$submittime}','{$row['totalamount']}','{$runtime}','{$runtime}')");
            //更新 佣金记录表
            $u_sql = sprintf($u_str, time(),$starttme, $endtime,$row['member_msn']);
            $dbh->exec($u_sql);
        }
    }


} catch (Exception $e) {
    $filename = "logs/{$year}/{$lastweek}.log";
    if (!file_exists(dirname($filename))) {

        mkdir(dirname($filename), 0777, true);
    }
    file_put_contents("./logs/{$year}/{$lastweek}.log", $e->getMessage());
}








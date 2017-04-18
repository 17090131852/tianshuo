<?php
/**
 * Created by PhpStorm.
 * User: Funky
 * Date: 2017/4/16
 * Time: 下午8:39
 */
include_once "config.php";
include_once "DateTimeCalc.php";

$runtime = date("Y-m-d H:i:s");


//init db connect
$dsn = sprintf("%s:dbname=%s;host=%s",$config['DB_TYPE'],$config['DB_NAME'],$config['DB_HOST']);
$dbh = new PDO($dsn,$config['DB_USER'],$config['DB_PWD'],array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//init sql
$dateSql = "select sum(commamont) as totalamount,member_msn from ts_member_commission where addtime BETWEEN '%s' and '%s' group by member_msn";
$countSql= "select count(DISTINCT(member_msn)) as count from ts_member_commission where addtime BETWEEN '%s' and '%s'";


//datetime
$year = date("Y");
$lastweek =  date("W")-2;
$yearweek = $year.$lastweek;
$range = DateTimeCalc::weekday($year,$lastweek);
$starttme = strtotime($range['starttime']."00:00:00");
$endtime = strtotime($range['endtime']."23:59:59");

$limit = sprintf($countSql,$starttme,$endtime);
$dateSql = sprintf($dateSql,$starttme,$endtime);


try{
    $count = $dbh->query($limit)->fetch();
    $total  =$count[0];
    $pageTotal =  ceil($total/$pagelimit);
    for ($i=0;$i<$pageTotal;$i++){
        $offset_start = $i*$pagelimit;
        $sql = $dateSql." limit $offset_start,$pagelimit";

        $rows = $dbh->query($sql)->fetchAll();

        foreach ($rows as $row){
            //todo 更新可用余额

            $dbh->exec("insert into ts_member_commlog (
                        `member_msn`,`yearweek`,`starttime`,`endtime`,`amount`,`createtime`) VALUES ('{$row['member_msn']}','{$yearweek}','{$range['starttime']}','{$range['endtime']}','{$row['totalamount']}','{$runtime}')");
        }
    }


}catch (Exception $e){
    $filename = "logs/{$year}/{$lastweek}.log";
    if(!file_exists(dirname($filename))){

        mkdir(dirname($filename),0777,true);
    }
    file_put_contents("./logs/{$year}/{$lastweek}.log",$e->getMessage());
}








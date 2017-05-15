<?php
/**
 * Created by PhpStorm.
 * User: Funky
 * Date: 2017/4/7
 * Time: 上午5:03
 */

namespace Tweb\Biz;


class Member
{

	/**
	 * 得到用户积分
	 * @param  integer $id 积分记录id
	 * @return [type]      [description]
	 */
    static public function getMemberPoint($id=0){
    	if(!$id) return false;

    	//根据id查询积分奖励
      	$data = M('member_point')->where("id='$id'")->find();

      	return $data['change_point'];
    }

    /**
     * 得到奖励历史
     * @param  string  $cond     条件
     * @param  integer $page     当前页
     * @param  integer $pagesize 每页条数
     * @return [array            佣金数据
     */
    static public function getAward($cond='',$page=1,$pagesize=10){
        $whereStr = "";
        $result = array();

        $orderby = 'order by c.addtime desc';

        $start = ($page-1) * $pagesize;
        $limit = " limit {$start},{$pagesize}";
        $whereStr = implode(" AND ", $cond);

        $str = " FROM
					ts_member_commission c
				LEFT JOIN ts_member_point p ON c.point_id = p.id
				LEFT JOIN ts_member m ON p.msn = m.msn
				WHERE %s %s";
        $tplcount = ' SELECT count(*) num '.$str;
        $tpl      = " SELECT c.*, m.realname,
					p.change_point,p.msn,
					CONCAT(FORMAT((c.commamont/p.change_point)*100,0),'%%') as ratio,FROM_UNIXTIME(c.addtime, '%%Y-%%m-%%d %%H:%%i:%%S') as add_date,if(c.source=1,'推荐投资','下级消费') as source_type  ".$str;
        $sqlcount = sprintf($tplcount,$whereStr,$orderby);
        $sql = sprintf($tpl,$whereStr,$orderby);
// echo $sql;exit;
        $model = M();
        $countdata = $model->query($sqlcount);
        $count = $countdata[0]['num'];

        $sql .= $limit;
        $list = $model->query($sql);

        return array(
            'pagetotal' => ceil($count/$pagesize),
            'count' => $count,
            'data' => empty($list) ? [] : $list,
        );
    }


    /**
     * 随机获取用户头像
     * @return [type] [description]
     */
    public function getFace(){
        $index =  rand (1,20);

        if(!$index) $index=1;
        
        $face = array(
            '1'=>'http://ts.jomon.cc/Public/face/1.jpg',
            '2'=>'http://ts.jomon.cc/Public/face/2.jpg',
            '3'=>'http://ts.jomon.cc/Public/face/3.jpg',
            '4'=>'http://ts.jomon.cc/Public/face/4.jpg',
            '5'=>'http://ts.jomon.cc/Public/face/5.jpg',
            '6'=>'http://ts.jomon.cc/Public/face/6.jpg',
            '7'=>'http://ts.jomon.cc/Public/face/7.jpg',
            '8'=>'http://ts.jomon.cc/Public/face/8.jpg',
            '9'=>'http://ts.jomon.cc/Public/face/9.jpg',
            '10'=>'http://ts.jomon.cc/Public/face/10.jpg',
            '11'=>'http://ts.jomon.cc/Public/face/11.jpg',
            '12'=>'http://ts.jomon.cc/Public/face/12.jpg',
            '13'=>'http://ts.jomon.cc/Public/face/13.jpg',
            '14'=>'http://ts.jomon.cc/Public/face/14.jpg',
            '15'=>'http://ts.jomon.cc/Public/face/15.jpg',
            '16'=>'http://ts.jomon.cc/Public/face/16.jpg',
            '17'=>'http://ts.jomon.cc/Public/face/17.jpg',
            '18'=>'http://ts.jomon.cc/Public/face/18.jpg',
            '19'=>'http://ts.jomon.cc/Public/face/19.jpg',
            '20'=>'http://ts.jomon.cc/Public/face/20.jpg',
        );

        return $face[$index];
    }
}
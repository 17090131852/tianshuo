<?php
/**
 * Created by PhpStorm.
 * User: Funky
 * Date: 2017/4/7
 * Time: 上午5:03
 */

namespace Tweb\Biz;


class Goods
{

	
    /**
     * 得到评论信息
     * @param  array   $cond     条件
     * @param  integer $page     当前页
     * @param  integer $pagesize 每页条数
     * @return [type]            [description]
     */
    static public function getComment($cond=array(),$page=1,$pagesize=10){
        $whereStr = "";
        $result = array();

        $orderby = 'order by id desc';

        $start = ($page-1) * $pagesize;
        $limit = " limit {$start},{$pagesize}";
        $whereStr = implode(" AND ", $cond);

        $str = " FROM
                  ts_goods_comment
                WHERE
                 %s %s";
        $tplcount = ' SELECT count(*) num '.$str;
        $tpl      = " SELECT *,FROM_UNIXTIME(createtime, '%%Y-%%m-%%d %%H:%%i:%%S') as createdate  ".$str;
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
     * 获得评论等级统计数量
     * @param array $cond 条件
     */
    static public function CommentLevelCount($cond=array()){
      $whereStr = implode(" AND ", $cond);

      $count['total'] = M('goods_comment')->where($whereStr)->count('id');
      $count['bad'] = M('goods_comment')->where($whereStr.' and star<=2 ')->count('id');
      $count['middle'] = M('goods_comment')->where($whereStr.' and star between 3 and 8 ')->count('id');
      $count['good'] = M('goods_comment')->where($whereStr.' and star>=9')->count('id');

      return $count;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Invincible
 * Date: 2017/4/11
 * Time: 10:49
 */
namespace Tadm\Controller;
use Common\Controller\BaseController;

class CommentController extends Base{

 	public function index()
    {
		$map         = array("1=1"); //条件数组
		$pagesize    = 10;
		$is_pass     = $this->request('is_pass', 'int', 0);    //1,未审核；2审核
		$is_del      = $this->request('is_del', 'int', 0);    
		$start_time  = $this->request('start_time', 'string', '');
		$end_time    = $this->request('end_time', 'string', '');
		$member_name = $this->request('member_name', 'string', '');
		$goods_name  = $this->request('goods_name', 'string', '');

        if ($is_pass) {
            $map['is_pass'] = $is_pass;
        }

        if ($is_del) {
            $map['is_del'] = $is_del - 1; //0,未删除; 1已删除
        }

        if (!empty($start_time) && empty($end_time)) {
            $starttime = strtotime($start_time);
            $map['createtime'] = array('egt', $start_time);
        }
        if (!empty($end_time) && empty($start_time)) {
            $endtime = strtotime($end_time);
            $map['createtime'] = array('elt', $end_time);
        }

        if (!empty($start_time) && !empty($end_time)) {
            $starttime = strtotime($start_time);
            $endtime   = strtotime($end_time);

            $map['createtime'] = array('between', "{$starttime},{$endtime}");
        }

        if (!empty($member_name)) {
            $map['member_name'] = array('like', $member_name . '%');
        }
        if (!empty($goods_name)) {
            $map['goods_name'] = array('like', $goods_name . '%');
        }

        $model = M('goods_comment');
        $count = $model->where($map)->count();

        $Page = new \Think\Page($count, $pagesize);
        $show = $Page->show();

        $data = $model
            ->where($map)
            ->order('id desc')
            ->limit($Page->firstRow . ',' . $Page->listRows)->select();
//        echo $model->getLastSql();

		$this->is_pass     = $is_pass;
		$this->is_del      = $is_del;
		$this->start_time  = $start_time;
		$this->end_time    = $end_time;
		$this->member_name = $member_name;
		$this->goods_name  = $goods_name;
		$this->data        = $data;
		$this->page        = $show;
    }

    /**
     * 审核评论
     * @return [type] [description]
     */
    public function changeStatus(){
    	$id = $this->get('id','int',0);
    	if(!$id){
    		$this->error('缺少参数','/Comment/index');
    	}

    	$goods_comment = M('goods_comment')->where("id='$id'")->find();
    	if(empty($goods_comment)){
    		$this->error('评论不存在','/Comment/index');
    	}

		$data['is_pass']     = 2;
		$data['update_time'] = time();
		$res = M('goods_comment')->where("id='$id'")->save($data);
		if($res){
			$this->success('审核成功','/Comment/index');
		}else{
			$this->error('审核失败','/Comment/index');
		}


    }
}
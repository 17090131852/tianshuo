<?php
namespace Tweb\Controller;

use Think\Controller;

class OrderController extends Base{

	public function _initialize(){
		//返回轮播图资源
		$objCommend = M('commends');
		$objResource = M('resources');
		$commendStatus = $objCommend->where('location = "个人中心"')->find();
		$resourceList = $objResource->where('resource_id="'.$commendStatus['id'].'"')->select();
		$this->resourceList = $resourceList;
	}

	public function index(){
		$type = $this->get('type','int',1);//订单类型 1 积分商城 2 汽车超市

		$this->type=$type;
	}

	public function view(){
		$msn = session('msn');
		$id  = $this->get('id','int',0); //订单id

		$order = M('order')->where("id='$id' and msn='$msn'")->find();
		if(empty($order)){
			$this->error('订单不存在','/Order/index',0);
		}

		$orderGoods = M('order_goods')->where("order_sn='$order[order_sn]'")->select();
		foreach ($orderGoods as $key => $value) {
			$goods = M('goods')->field('goods_id')->where("goods_code='{$value[goods_code]}'")->find();
			$orderGoods[$key]['goods_id'] = $goods['goods_id'];
		}

		$this->type       = $order['type'];
		$this->order      = $order;
		$this->orderGoods = $orderGoods;
	}


	/**
	 * 评论
	 * @return [type] [description]
	 */
	public function comment(){
		header("Content-type: text/html; charset=utf-8"); 
		$msn = session('msn');
		$id         = $this->request('id','int',0); //订单id
		$goods_code = $this->request('goods_code','string',''); //商品编号

		$order = M('order')->where("id='$id' and msn='$msn'")->find();
		if(empty($order)){
			$this->error('订单不存在','/Order/index',0);
		}

		// 查询订单商品信息
		$where = "order_sn='$order[order_sn]' and goods_code='$goods_code'";
		$orderGoods = M('order_goods')->where($where)->find();
		// echo M()->getLastSql();exit;
		if(empty($orderGoods)){
			$this->error('订单商品不存在','/Order/index',0);
		} 

		// 判断该订单该商品是否已评论
		$goods = M('goods')->where("goods_code='$goods_code'")->find();
		$where = "goods_id='$goods[goods_id]' and order_id=$id";
		$commandGoods = M('goods_comment')->where($where)->find();
		if(!empty($commandGoods)){
			$this->assign("type",$order['type']);
			$this->error('订单已评论','/Order/index',0);
		}

		if(IS_POST){
			$data                = array();
			$data['star']        = $this->request('star','int',0);
			$data['content']     = $this->request('content','string','');
			$data['member_id']   = session('mid');
			$data['member_msn']  = $msn;
			$data['member_name'] = session('realname');
			$data['goods_id']    = $goods['goods_id'];
			$data['goods_name']  = $goods['goods_name'];
			$data['order_id']    = $id;
			$data['is_pass']     = 1; //未审核
			$data['is_del']      = 0; //未审核
			$data['createtime']  = time(); 
			$res = M('goods_comment')->data($data)->add();
			if(!$res){
				$this->redirect('Order/index',array('type'=>$order['type']));
			}

			// 更新该订单商品评论状态
			$g_o_data              = array();
			$g_o_data['is_comm']   = 1;
			$g_o_data['update_at'] = date('Y-m-d H:i:s');
			$g_o_res = M('order_goods')->where("order_sn='$order[order_sn]' and goods_code='$goods_code'")->save($g_o_data);
			if(!$g_o_res){
				M('goods_comment')->where("id='$res'")->delete();
				$this->redirect('Order/index',array('type'=>$order['type']));
				
			}
			// 更新该笔订单评论装填
			//判断该商品评论是否为该订单最后一个
			//统计订单商品数量
			$g_count = M('order_goods')->where("order_sn='$order[order_sn]'")->count();
			//统计订单商品评论数量
			$comm_count = M('order_goods')->where("order_sn='$order[order_sn]' and is_comm=1")->count();
			if($g_count==$comm_count){
				$o_data                = array();
				$o_data['is_comm']     = 1;
				$o_data['update_time'] = date('Y-m-d H:i:s');
				$o_res = M('order')->where("id='$id'")->save($o_data);
				if(!$o_res){
					M('goods_comment')->where("id='$res'")->delete();
					$this->redirect('Order/index',array('type'=>$order['type']));
					
				}
			}

			
			$this->redirect('Order/index',array('type'=>$order['type']));
		}

		$this->type       = $order['type'];
		$this->order      = $order;
		$this->orderGoods = $orderGoods;
	}
	/**
	 * 查看评论
	 * @return [type] [description]
	 */
	public function commentView(){
		header("Content-type: text/html; charset=utf-8"); 
		$msn = session('msn');
		$id         = $this->request('id','int',0); //订单id
		$goods_code = $this->request('goods_code','string',''); //商品编号

		$order = M('order')->where("id='$id' and msn='$msn'")->find();
		if(empty($order)){
			$this->error('订单不存在','/Order/index',0);
		}

		// 查询订单商品信息
		$where = "order_sn='$order[order_sn]' and goods_code='$goods_code'";
		$orderGoods = M('order_goods')->where($where)->find();
		// echo M()->getLastSql();exit;
		if(empty($orderGoods)){
			$this->error('订单商品不存在','/Order/index',0);
		} 

		$goods = M('goods')->where("goods_code='$goods_code'")->find();
		$where = "goods_id='$goods[goods_id]' and order_id=$id";
		$commandGoods = M('goods_comment')->where($where)->find();
		if(empty($commandGoods)){
			$this->error('评论已删除','/Order/index',0);
		}

		$this->type       = $order['type'];
		$this->commandGoods = $commandGoods;
		$this->order        = $order;
		$this->orderGoods   = $orderGoods;
	}


	// 确认收货
	public function changeStatus(){
		$msn = session('msn');
		$id = $this->request('id','int',0); //订单id

		$res = M('order')->where("id='$id' and msn='$msn'")->find();
		if(empty($res)){
			$this->error('订单不存在','/Order/index',0);
		}

		//判断订单状态是否为已发货
		if($res['shipping_status']!=1){
			$this->error('订单状态操作有误','/Order/index',0);
		}

		// 更新订单状态
		$data['update_time']     = date('Y-m-d H:i:s');
		$data['shipping_status'] = 2;
		$res = M('order')->where("id='$id' and msn='$msn'")->save($data);
		if($res){
			$this->assign("type",$order['type']);
			$this->success('订单收货成功','/Order/index',0);
		}else{
			$this->assign("type",$order['type']);
			$this->error('订单收货失败','/Order/index',0);
		}
	}
	// 取消订单
	public function cancle(){
		$msn = session('msn');
		$id = $this->request('id','int',0); //订单id

		$res = M('order')->where("id='$id' and msn='$msn'")->find();
		if(empty($res)){
			$this->error('订单不存在','/Order/index',0);
		}

		//判断订单状态是否为已发货
		if($res['order_status']==1){
			$this->assign("type",$res['type']);
			$this->error('订单已付款，不能取消','/Order/index',0);
		}

		// 更新订单状态 为取消
		$data['update_time']  = date('Y-m-d H:i:s');
		$data['order_status'] = 2;
		$res = M('order')->where("id='$id' and msn='$msn'")->save($data);
		// echo M()->getLastSql();exit;
		if($res){
			$this->assign("type",$res['type']);
			$this->success('订单取消成功','/Order/index',0);
		}else{
			$this->assign("type",$res['type']);
			$this->error('订单取消失败','/Order/index',0);
		}
	}
}
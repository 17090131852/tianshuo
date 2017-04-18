<?php
/**
 * Created by PhpStorm.
 * User: Invincible
 * Date: 2017/3/30
 * Time: 10:55
 */
namespace Tweb\Controller;
//use Org\Util\ShopCart;
use Think\Controller;

class CartController extends Controller {

	private $items = array();
	//购物车
	//添加商品
	public function addItem(){
		$msn = session('msn');
		if(!$msn){
			$this->error('用户未登录');
		}
		$items = I('post.');
//		dump($items);die;
		foreach($items as $key => $value){
			if($this->hasItem($value['goods_id'])){
				$this->incNum($value['goods_id'],$value['num']);
			}
			$_SESSION['cart'][$key] = $value;
		}
		dump($_SESSION);die;
		$this->success('添加成功');
	}

	//判断购物车是否有该商品
	public function hasItem($goodsId){
		return array_key_exists($goodsId,$this->items);
	}

	//商品数量增加1

	public function incNum($goodsId,$num=1) {
		if($this->hasItem($goodsId)) {
			$this->items[$goodsId]['num'] += $num;
		}
	}

	public function modNum($goodsId,$num=1) {
		if(!$this->hasItem($goodsId)) {
			return false;
		}
		$this->items[$goodsId]['num'] = $num;
	}
}
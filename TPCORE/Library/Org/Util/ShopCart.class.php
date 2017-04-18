<?php
/**
 * Created by PhpStorm.
 * User: Invincible
 * Date: 2017/3/31
 * Time: 11:01
 */
namespace Org\Util;
class ShopCart{
	private static $ins = null;
	private $items = array();

	final protected function __construct() {
	}

	final protected function __clone() {
	}

	// 获取实例
	protected static function getIns() {
		if(!(self::$ins instanceof self)) {
			self::$ins = new self();
		}

		return self::$ins;
	}


	// 把购物车的单例对象放到session里
	public static function getCart() {
		if(!isset($_SESSION['cart']) || !($_SESSION['cart'] instanceof self)) {
			$_SESSION['cart'] = self::getIns();
		}

		return $_SESSION['cart'];
	}


	/*
	添加商品
	param int $id 商品主键
	param string $name 商品名称
	param float $  商品价格
	param int $num 购物数量
	*/
	public function addItem($goodsId,$goodsName,$goodsScore,$goodsThumb,$num=1) {
		if($this->hasItem($goodsId)) { // 如果该商品已经存在,则直接加其数量
			$this->incNum($goodsId,$num);
			return;
		}

		$item = array();
		$item['goods_id'] = $goodsId;
		$item['goods_name'] = $goodsName;
		$item['goods_score'] = $goodsScore;
//		$item['brand'] = $brand;
		$item['goods_thumb'] = $goodsThumb;
		$item['num'] = $num;
		$this->items[$goodsId] = $item;

		return $this->items[$goodsId];


	}


	/*
	修改购物车中的商品数量
	param int $id 商品主键
	param int $num 某个商品修改后的数量,即直接把某商品的数量改为$num
	*/
	public function modNum($goodsId,$num=1) {
		if(!$this->hasItem($goodsId)) {
			return false;
		}

		$this->items[$goodsId]['num'] = $num;

	}


	/*
	商品数量增加1
	*/
	public function incNum($goodsId,$num=1) {
		if($this->hasItem($goodsId)) {
			$this->items[$goodsId]['num'] += $num;
		}
	}


	/*
	商品数量减少1
	*/
	public function decNum($goodsId,$num=1) {
		if($this->hasItem($goodsId)) {
			$this->items[$goodsId]['num'] -= $num;
		}

		// 如果减少后,数量为0了,则把这个商品从购物车删掉
		if($this->items[$goodsId]['num'] < 1) {
			$this->delItem($goodsId);
		}
	}


	/*
			判断某商品是否存在
	*/
	public function hasItem($goodsId) {
		return array_key_exists($goodsId,$this->items);
	}


	/*
			删除商品
	*/
	public function delItem($goodsId) {
		unset($this->items[$goodsId]);
	}


	/*
			查询购物车中商品的种类
	*/
	public function getCnt() {
		return count($this->items);
	}


	/*
			查询购物车中商品的个数
	*/
	public function getNum() {
		if($this->getCnt() == 0) {
			return 0;
		}

		$sum = 0;

		foreach($this->items as $item) {
			$sum += $item['num'];
		}

		return $sum;
	}


	/*
			查询购物车中商品的总金额
	*/
	public function getPrice() {
		if($this->getCnt() == 0) {
			return 0;
		}

		$price = 0.0;

		foreach($this->items as $item) {
			$price += $item['num'] * $item['price'];
		}

		return $price;
	}



	/*
	返回购物车中的所有商品
	*/

	public function all() {
		return $this->items;
	}

	/*
			清空购物车
	*/
	public function clear() {
		$this->items = array();
	}
}

$obj = \ShopCart::getIns();

<?php
/**
 * Created by PhpStorm.
 * User: Invincible
 * Date: 2017/4/12
 * Time: 17:34
 */
namespace Tadm\Model;
use Think\Model;

class GoodsModel extends Model{
	protected $_validate=array(
		//array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
		array('goods_name','require','商品名称不得为空!',1,3),
		array('goods_price','/^\d+(\.\d+)?$/','商品价格格式错误!','regex',1,3),
		array('goods_score','/^\+?(0|[1-9][0-9]*)$/','商品积分格式错误!','regex',1,3),
		array('goods_num','/^\+?(0|[1-9][0-9]*)$/','商品数量格式错误!','regex',1,3),
		array('goods_sale_num','/^\+?(0|[1-9][0-9]*)$/','可售数量格式错误!','regex',1,3),
		array('cat_id','require','商品分类不得为空!',1,3),
	);
}
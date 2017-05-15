<?php
/**
 * Created by PhpStorm.
 * User: Invincible
 * Date: 2017/3/31
 * Time: 2:26
 */
namespace Tadm\Model;
use Think\Model;

class OrderModel extends Model{

	protected $tableName = 'order';
	protected $_validate = array(
		array('msn','require','用户编号不能为空'),
		array('integral','require','消耗积分不能为空'),
		array('order_sn','require','订单编号不能为空'),
		array('realname','require','真实姓名不能为空'),
		array('province','require','省不能为空'),
		array('city','require','市不能为空'),
		array('county','require','县不能为空'),
		array('address','require','详细地址不能为空'),
		array('order_status','require','订单状态不能为空'),
		array('integral','require','消耗积分不能为空'),
	);

	/**得到个人订单信息，线上，线下
	 * @param array $cond_offline
	 * @param array $cond_order
	 * @param string $recom_msn
	 * @return mixed
	 */
	public function getOrderByMsn($cond_offline=array(),$cond_order=array()){
		$offline_order = D('offline_order');
		$order         = D('order');

		$list['offline_order'] = $offline_order->where($cond_offline)->select();
//       echo  $offline_order->getLastSql();exit;
		$list['order']          = $order->where($cond_order)->select();

		return $list;
	}
}
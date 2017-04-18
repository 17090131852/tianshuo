<?php
/**
 * Created by PhpStorm.
 * User: Invincible
 * Date: 2017/3/31
 * Time: 2:42
 */
namespace Tweb\Model;
use Think\Model;

class AddressModel extends Model{
	protected $_validate=array(
		array('province','require','省份不能为空',1),
		array('city','require','地区不能为空',1),
		array('address','require','详细地址不能为空',1),
		array('tel','require','联系电话不能为空',1),
		array('tel','/^1[34578]{1}\d{9}$/','手机号格式不正确',0,'regex',1),
		array('default_address','require','默认地址不能为空',1),
		array('default_address','/^[01]$/','默认地址状态异常',1,'regex'),
	);

}
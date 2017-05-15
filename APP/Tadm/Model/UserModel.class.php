<?php 
namespace Tadm\Model;
use Think\Model;
class UserModel extends Model{

	//自动验证
	protected $_validate=array(
		//array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
		array('uname','require','用户名不得为空!',0,3),
		array('uname','','该用户已经存在!',0,'unique',3),
		array('pwd','require','密码不得为空!',0,3),
		array('pwd','(6,16)','密码长度6--16位!',0,'length',3),
		array('pwd1','pwd','两次密码不一致',0,'confirm',3),
		);

	//自动完成
	protected $_auto = array(
		array('pwd','pwdProcess',1,'callback'),
		array('regtime','time',1,'function'),
	);

	// //关联模型
	// protected $_link = array(
	// 		'Auth_group' => array(    
	// 		'mapping_type'      =>  self::MANY_TO_MANY,    
	// 		'class_name'        =>  'Auth_group',    
	// 		'mapping_name'      =>  'title',    
	// 		'foreign_key'       =>  'uid',    
	// 		'relation_foreign_key'  =>  'id',    
	// 		'relation_table'    =>  'ts_auth_group_access' //此处应显式定义中间表名称，且不能使用C函数读取表前缀    
	// 	)
	// );

	/*
	* 自定义用户密码规则
	* @param string MD5字符串
	* @return string 处理后的密码
	* @规则：MD5加密后前去4后去3，再Md5加密
	*/
	protected function pwdProcess($pwd){
		$md5Pwd = md5($pwd);
		$pwdTem = substr($md5Pwd,4,25);
		$pwdFinal = md5($pwdTem);
		return $pwdFinal;
	}
}





 ?>
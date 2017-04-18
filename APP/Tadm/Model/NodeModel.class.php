<?php
namespace Tadm\Model;
use Think\Model;
class NodeModel extends Model{

	protected $_validate=array(
		//array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
			array('title','require','节点名称不得为空!',0,3),
			array('model','require','控制器不得为空!',0,3),
			array('action','require','方法不得为空！',0,3),
	);


	//获取全部节点数组，用于生成树形图
	public function getAll($field=''){
		$rs = M('node')->field($field)->order('pid,ord')->select();
		return $rs;
	}
	//根据ID获取一行数据
	public function getOne($id,$field=''){
		if((int)$id <=0 || (int)$id ==''){
			return false;
		}else{
			$rs = M('node')->field($field)->where('id='.$id)->find();
			return $rs;
		}

	}
}
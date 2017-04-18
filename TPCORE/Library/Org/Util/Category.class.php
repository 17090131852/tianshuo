<?php
namespace Org\Util;
class Category{
	private $arr = array();
	//构造方法，初始化数组
	public function __construct($arr = array()){
		$this->arr = $arr;
	}
	//获取全部分类
	function getTree($array,$pid=0){
		$result = array();
		foreach($array as $key => $val){
			if($val['pid'] == $pid) {
				$tmp = $array[$key];
				unset($array[$key]);
				count($this->getTree($array,$val['id'])) > 0 && $tmp['child'] = $this->getTree($array,$val['id']);
				$result[] = $tmp;
			}
		}
		return $result;
	}
	
	//获取当前位置
	public function getPos($id,&$newarr){
		$a = array();
		if(!isset($this->arr[$id])) return false;
        $newarr[] = $this->arr[$id];
		$pid = $this->arr[$id]['pid'];
		if(isset($this->arr[$pid])){
		    $this->getPos($pid,$newarr);
		}
		if(is_array($newarr)){
			krsort($newarr);
			foreach($newarr as $v){
				$a[$v['id']] = $v;
			}
		}
		return $a;
	}
	//获取父级
	public function getParent($pid){
		foreach($this->arr as $v){
			if($v['id'] == $pid){
				$rs = $v;
			}
		}
		
		if($rs != ''){
			return $rs;
		}else{
			return false;
		}
	}
	//获取子级
	public function getChild($id){
		foreach($this->arr as $v){
			if($v['pid'] == $id){
				$rs[] = $v;
			}
		}
		return $rs;
	}
}
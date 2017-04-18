<?php
namespace Tweb\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function index(){
		//Web项目首页
		//返回入口状态、轮播图资源
		$objEntry = M('entry');
		$objCommend = M('commends');
		$objResource = M('resources');
		$entryStatus = $objEntry->select();
		$commendStatus = $objCommend->where('location = "首页"')->find();
		$resourceList = $objResource->where('resource_id="'.$commendStatus['id'].'"')->select();
		$this->resourceList = $resourceList;
		$this->entryStatus = $entryStatus;
		$this->display(C('DEFAULT_TPL').'/IndexIndex');
	}
}
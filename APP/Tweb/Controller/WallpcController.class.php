<?php
namespace Tweb\Controller;
use Think\Controller;

class WallpcController extends Base{
	public function index(){
		
	}
	
	public function interaction(){
		$list= M("wechat_signin")->limit(100)->select();
		$this->list = $list;
	}



	public function wishes(){

	}
}
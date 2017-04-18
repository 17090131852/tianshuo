<?php
namespace Common\Controller;
use Think\Controller;

class LogchkController extends Controller{
	protected function _initialize(){
		$sess_user = session('msn');
		//非法访问，直接跳转
		if(!$sess_user){
			$this->redirect('Tweb/Public/login');
		}
	}
}
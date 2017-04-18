<?php
namespace Common\Controller;
use Think\Controller;
use Think\Auth;

class BaseController extends Controller{
	protected function _initialize(){
		$sess_auth = session('admUid');
		//非法访问，直接跳转
		if(!$sess_auth){
			$this->redirect('Tadm/Public/login');
		}
		//超级管理员，拥有所有权限
		if($sess_auth == C('SUPER_ADM')){
			return true;
		}
		//权限控制
		$auth = new Auth();
		if(!$auth->check(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME,$sess_auth['admUid'])){
			$this->error('抱歉!您所在的用户组无权访问此页面!',U('Fdadm/Public/login'),2);
		}
	}
}
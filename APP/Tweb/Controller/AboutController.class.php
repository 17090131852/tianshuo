<?php
namespace Tweb\Controller;
use Think\Controller;
class AboutController extends Controller {
	public function index(){
		$this->display(C('DEFAULT_TPL').'/AboutIndex');
	}
	//关于-荣誉
	public function honor(){
		$this->display(C('DEFAULT_TPL').'/AboutHonor');
	}
	//关于-文化
	public function culture(){
		$this->display(C('DEFAULT_TPL').'/AboutCulture');
	}
	//关于-发展
	public function develop(){
		$this->mienList = M('develop')->where('sta=1')->select();
		$this->display(C('DEFAULT_TPL').'/AboutDevelop');
	}
	//关于-发展-详情
	public function devDetail(){
		$newId = I('get.id');
		if($newId<1 || $newId==''){
			$this->error('资讯不存在!','',1);
		}
		$this->newInfo = M('develop')->where('id='.$newId)->find();
		$this->display(C('DEFAULT_TPL').'/devDetail');
	}
	//关于-风采
	public function mien(){
		$this->display(C('DEFAULT_TPL').'/AboutMien');
	}
	
	//售后服务-服务理念
	public function afterService(){
		$this->display(C('DEFAULT_TPL').'/AboutAfterService');
	}
	//售后服务-三包服务
	public function threeGuarantees(){
		$this->display(C('DEFAULT_TPL').'/AboutThreeGuarantees');
	}
}
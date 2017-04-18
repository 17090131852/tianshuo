<?php
namespace Tweb\Controller;
use Think\Controller;
class MotoTypeController extends Controller {
	public function index(){
		//车型总览首页
		$this->carList = M('cars')->order('ord desc')->limit(8)->select();
		$this->display(C('DEFAULT_TPL').'/MotoTypeIndex');
	}
	
	//具体车型展示
	public function carType(){
		$cate = I('get.cate');
		$existCate = M('category')->where('pid=9 AND id='.$cate)->count();//dump($existCate);exit;
		if($existCate){
			$this->carList = M('cars')->where('cate='.$cate)->select();
		}else{
			$this->carList = array();
		}
		//dump($this->carList);
		$this->display(C('DEFAULT_TPL').'/MotoTypeIndex');
	}
	
	//F车型单品详情
	public function carDetail(){
		$carId = I('get.id');
		if($carId<1 || $carId==''){
			$this->error('车型信息不存在!','',1);
		}
		$this->carInfo = M('cars')->where('id='.$carId)->find();
		$this->display(C('DEFAULT_TPL').'/MotoTypeCarDetail');
	}
	
	//预约试驾
	//注：存表逻辑未实现，实现完后，删除此条注释
	public function testDrive(){
		if(!IS_POST){
			$this->display(C('DEFAULT_TPL').'/MotoTypeTestDrive');
		}else{
			$this->success('您的预约信息已提交！','',1);
		}
	}
}
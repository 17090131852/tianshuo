<?php
namespace Tweb\Controller;
use Think\Controller;
class NewsController extends Controller {
	public function index(){
		if(I('get.cate')){
			$cate = I('get.cate');
			if($cate<1 || $cate==''){
				$this->error('分类不存在!','',1);
			}
			$this->newList = M('news')->where('sta = 1 AND cate='.$cate)->order('ord desc')->limit(5)->select();
		}else{
			$this->newList = M('news')->where('sta = 1 AND cate = 6')->order('ord desc')->limit(5)->select();
		}
		$this->display(C('DEFAULT_TPL').'/NewIndex');
	}
	//
	public function detail(){
		$newId = I('get.id');
		if($newId<1 || $newId==''){
			$this->error('资讯不存在!','',1);
		}
		$this->newInfo = M('news')->where('id='.$newId)->find();
		$this->display(C('DEFAULT_TPL').'/NewDetail');
	}
}
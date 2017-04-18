<?php
/**
 * Created by PhpStorm.
 * User: Invincible
 * Date: 2017/4/11
 * Time: 10:49
 */
namespace Tadm\Controller;
use Common\Controller\BaseController;

class CommendController extends BaseController{
	public function index(){
		$objCommend = M('commends');
		$commentList = $objCommend->select();
		$this->commentList = $commentList;
		$this->display(C('DEFAULT_TPL').'/CommendIndex');
	}

	public function updateCommend(){
		$post = I('post.');
		$getId = I('get.id');
		$objResources = M('resources');
		$objCommend = M('commends');
		$commendInfo = $objCommend->where('id='.$getId)->order('create_at desc')->find();
		$resourcesList = $objResources->where('resource_id= "'.$getId.'"')->select();
		$this->commendInfo = $commendInfo;
		$this->resourceList = $resourcesList;
		if(!$post){
			$this->display(C('DEFAULT_TPL').'/CommendEdit');
		}
	}

	public function modifyCommend(){
		$getId = I('get.id');
		$getStatus = I('get.status');
		$data['status'] = $getStatus;
		$objCommend = M('commends');
		$result = $objCommend->where('id='.$getId)->setField($data);
		if($result !== false) {
			$this->redirect("/Tadm/Commend/index");
		}
	}

	public function addCommend(){
		if(IS_POST){
			$postData = I('post.');
			$postData['create_at'] = date('Y-m-d H:i:s',time());
			$postData['update_at'] = date('Y-m-d H:i:s',time());
			$objCommend = M('commends');
			$result = $objCommend->add($postData);
			if($result){
				$this->redirect("/Tadm/Commend/index");
			}
		}else{
			$this->display(C('DEFAULT_TPL').'/CommendAdd');
		}
	}

	public function uploadImg(){
		$resourcesId = I('post.id');
		$count = count($_FILES);
		$objResources = M('resources');
		if ($count >= 50) {
			$this->error('超出单次上传数量');
		}
		$upload           = new \Think\Upload();// 实例化上传类
		$upload->exts     = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->subName  = array('date', 'Y-m-d');
		$upload->rootPath = './Upload/Commends/'; // 设置附件上传根目录
		$upload->savePath = ''; // 设置附件上传（子）目录
		$now              = $_SERVER['REQUEST_TIME'];
		$upload->saveName = array('uniqid', $now);//上传文件的保存规则
		//上传文件
		$info = $upload->upload();
		$rootPath = '/Upload/Commends/';
		$desc = I('post.');
		unset($desc['id']);
		foreach($info as $key => $value){
			$imgData[$key]['resource_id'] = $resourcesId;
			$imgData[$key]['url'] = $rootPath.$value['savepath'].$value['savename'];
			$imgData[$key]['type'] = 'commend';
			$imgData[$key]['create_at'] = date('Y-m-d H:i:s',time());
			$imgData[$key]['resource_desc'] = $resourcesId;
			if($desc[$key] == ''){
				$imgData[$key]['resource_desc'] = '未说明';
			}else{
				$imgData[$key]['resource_desc'] = $desc[$key];
			}
			$result = $objResources->add($imgData[$key]);
			if(!$result){
				$this->error('图片上传失败','',1);
			}
		}
		$this->redirect("/Tadm/Commend/updateCommend/id/".$resourcesId);
	}

	public function destroyImg(){
		$getId = I('get.id');
		$objImg = M('resources');
		$result = $objImg->where('id='.$getId)->delete();
		if($result){
			$this->success('删除成功','',0);
		}
	}
}
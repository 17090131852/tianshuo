<?php
/**
 * Created by PhpStorm.
 * User: Invincible
 * Date: 2017/4/7
 * Time: 17:14
 */
namespace Tadm\Controller;
use Common\Controller\BaseController;

class EntryController extends BaseController{
	public function index(){
		$objEntry = M('entry');
		$entryList = $objEntry->order('"create_at ASC","update DESC"')->select();
		$this->entryList = $entryList;
		$this->display(C('DEFAULT_TPL').'/EntryIndex');
	}

	public function addEntry(){
		$this->display(C('DEFAULT_TPL').'/EntryAdd');
	}

	public function createEntry(){
		$objEntry = M('entry');
		$entryData = I('post.');
		if(!$entryData['en_name'] || $entryData['status'] == null){
			$this->error('数据提交不完全','',1);
		}
		$entryData['update_at'] = date('Y-m-d H:i:s',time());
		$result = $objEntry->add($entryData);
		if($result){
			$this->success('添加成功',U('Entry/index'),1);
		}
	}

	public function editEntry(){
		$objEntry = M('entry');
		$getId = I('get.id');
		$entryInfo = $objEntry->where('id='.$getId)->find();
		$this->entryInfo = $entryInfo;
		$this->display(C('DEFAULT_TPL').'/EntryEdit');
	}

	public function updateEntry(){
		$getId = I('get.id');
		$postId = I('post.id');
		$objEntry = M('entry');
		$getStatus = I('get.status');
		if($getStatus != null){
			$data['status'] = $getStatus;
		}else {
			$data = I('post.');
			unset($data['id']);
		}
		$map['id']=array(array('eq',$getId),array('eq',$postId),'OR');
		$result = $objEntry->where($map)->setField($data);
		if($result !== false) {
			$this->success('操作成功',U('Entry/index'),1);
		}
	}

	public function destroyEntry(){
		$getId = I('get.id');
		$getStatus['status'] = I('get.status');
		if($getStatus['status'] == 1){
			$this->error('已开放入口不允许删除',U('Entry/index'),1);
		}
		$objEntry = M('entry');
		$result = $objEntry->where('id='.$getId)->delete();
		if($result) {
			$this->success('删除成功',U('Entry/index'),1);
		}
	}
}
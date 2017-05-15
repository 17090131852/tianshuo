<?php 
namespace Tadm\Controller;
use Common\Controller\BaseController;
/**
* 权限控制
*/
class AuthorityController extends BaseController
{
	
	//角色列表
	public function groupIndex(){
		$this->roles = M('auth_group')->select();
		$this->display(C('DEFAULT_TPL').'/groupIndex');
	}


	//添加一个用户组
	public function groupAdd(){
		if(!IS_POST){
			$this->display(C('DEFAULT_TPL').'/groupAdd');
		}else{
			$data['title'] = I('post.title');
			$data['status'] = I('post.status');
			if(empty($data['title'])){
				$this->error('分组名称不能为空!','',1);
			}
			$is_add = M('auth_group')->add($data);
			if($is_add){
				$this->success('分组添加成功!',U('Authority/groupIndex'),1);
			}else{
				$this->error('分组添加失败!','',1);				
			}
		}
	}

	//修改一个分组
	public function groupEdit(){
		if(!IS_POST){
			$this->group = M('auth_group')->where(['id'=>I('get.group_id')])->find();
			$this->display(C('DEFAULT_TPL').'/groupEdit');
		}else{
			$data['title'] = I('post.title');
			$data['status'] = I('post.status');
			if(empty($data['title'])){
				$this->error('分组名称不能为空!','',1);
			}
			$is_add = M('auth_group')->where(['id'=>I('post.group_id')])->save($data);
			if($is_add){
				$this->success('分组修改成功!',U('Authority/groupIndex'),1);
			}else{
				$this->error('分组修改失败!','',1);				
			}
		}
	}

	//移除一个组员
	public function removeCrew(){
		$is_remove = M('auth_group_access')->where(['uid'=>I('get.uid'),'group_id'=>I('get.group_id')])->delete();
		if($is_remove){
			$this->success('组员移除成功！',U('Authority/userIndex',['group_id'=>I('get.group_id')]),1);
		}
	}

	//管理员列表
	public function userIndex(){
		$group_id = I('get.group_id');
		if($group_id){
			$arr = M('auth_group_access')->field('uid')->where("group_id=$group_id")->select();
			foreach ($arr as $v) {
				$data[] = M('user')->where(['uid'=>$v['uid']])->find();
			}
			$this->group_id = $group_id;
			$this->users = $data;
		}else{
			$this->users = M('user')->select();
		}
		$this->display(C('DEFAULT_TPL').'/userIndex');
	}

	//添加一个管理员
	public function userAdd(){
		if(!IS_POST){
			// $this->groups = M('auth_group')->where("id!=1")->select();
			$this->groups = M('auth_group')->where("status=1")->select();
			$this->display(C('DEFAULT_TPL').'/userAdd');
		}else{
			$model = D('user');
			if($model->create()){
				if(count($_POST['group_id']) == 0){
					$this->error('请最少选择一个分组','',1);
				}
			// print_r($_POST);exit;

				$last_id = $model->add();
				if($last_id){
					//将用户ID和组ID加入auth_group_access表
					foreach ($_POST['group_id'] as $value) {
						$data['uid'] = $last_id;
						$data['group_id'] = $value;
						M('auth_group_access')->add($data);
					}				
					$this->success('用户添加成功！',U('Authority/userIndex'),1);
				}else{
					$this->error('用户添加失败！','',1);
				}
			}else{
				$this->error($model->getError(),'',1);
			}
		}
	}

	//修改管理员
	public function userEdit(){
		$user_model = D('user');
		$access_model = M('auth_group_access');
		if(!IS_POST){		
			$this->user = $user_model->where(['uid'=>I('get.uid')])->find();
			$this->groups = M('auth_group')->where("id!=1")->select();
			$item = $access_model->where(['uid'=>I('get.uid')])->field('group_id')->select();
			foreach ($item as $val) {
				$checked[] = $val['group_id'];
			}
			$this->checkeds = $checked;
			$this->display(C('DEFAULT_TPL').'/userEdit');
		}else{
			if(count($_POST['group_id']) == 0){
				$this->error('请最少选择一个分组','',1);
			}
			$data_user['uname'] = I('post.uname');
			$data_user['mobile'] = I('post.mobile');
			$data_user['sta'] = I('post.sta');
			$is_add = $user_model->where(['uid'=>I('post.uid')])->save($data_user);
			if($is_add !== false){
				$access_model->where(['uid'=>I('post.uid')])->delete();
				foreach ($_POST['group_id'] as $v) {
					$access_model->add(['uid'=>I('post.uid'),'group_id'=>$v]);
				}
				$this->success('管理员修改成功!',U('Authority/userIndex'),1);
			}else{
				$this->error('管理员修改失败！','',1);
			}
		}
	}

	//删除一个管理员
	public function userDel(){
		$uid = I('get.uid');
		if($uid == 1){
			$this->error('超级管理不能被删除!','',1);
		}

		$id_del = M('user')->where("uid=$uid")->delete();
		$access_del = M('auth_group_access')->where("uid=$uid")->delete();
		if($id_del){
			$this->success('管理员删除成功！',U('Authority/userIndex'),1);
		}else{
			$this->success('管理员删除失败！',U('Authority/userIndex'),1);
		}
	}

}







 ?>
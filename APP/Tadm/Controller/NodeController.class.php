<?php 
namespace Tadm\Controller;
use Common\Controller\BaseController;
/**
* 节点控制器
*/
class NodeController extends BaseController
{
	
	//节点列表
	public function index(){
		$nodeArr = D('Node')->getAll(); //获取全部节点
    $cateObj = new \Org\Util\Category($nodeArr);  //实例化
    $this->treeArr = $cateObj->getTree($nodeArr,1); //树形数组
		$this->display(C('DEFAULT_TPL').'/nodeIndex');
	}

	//增加节点
	public function add(){
		$model = D('node');
		if(!IS_POST){
			$this->nodes = $model->field('id,title')->where("pid=1")->select();
			$this->display(C('DEFAULT_TPL').'/nodeAdd');
		}else{
			if($model->create()){
				if($model->add()){
					$this->success('添加成功',U('Node/index'),2);
				}else{
					$this->error('添加失败!','',2);
				}
			}else{
				// $this->success('成立了','',3);
				$this->error('岑石发的his就','',3);
				// $this->error($model->getError(),'',100);
			}
		}

	}


	//编辑节点
	public function edit(){
		$model = D('node');
		if(!IS_POST){
			if(I('get.id')<=0 || I('get.id')==''){
				$this->error('非法ID','',1);
			}else{
				$this->nodes = $model->field('id,title')->where("pid=1")->select();
				$this->nodeInfo = $model->getOne(I('get.id'));
				$this->display(C('DEFAULT_TPL').'/nodeEdit');
			}
		}else{
			if(I('post.id')<=0 || I('post.id')==''){
				$this->error('非法ID','',1);
			}else{
				if($model->create()){
					if($model->where('id='.I('post.id'))->save()){
						$this->success('保存成功',U('Node/index'),1);
					}else{
						$this->error('保存失败','',1);
					}
				}else{
					$this->error('数据对象创建失败','',1);
				}
			}
		}		
	}
	
	//删除节点
	public function del(){
		if(I('get.id')<=0 || I('get.id')==''){
			$this->error('非法ID','',1);
		}else{
			$this->error('暂不提供删除功能','',1);
		}
	}
	



}












 ?>
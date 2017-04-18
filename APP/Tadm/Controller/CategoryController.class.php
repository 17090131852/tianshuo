<?php 
namespace Tadm\Controller;
use Common\Controller\BaseController;
/**
* 分类管理
*/
class CategoryController extends BaseController
{
	//分类列表
	public function index(){
		$cates = M('category')->order('ord asc')->select();
		$cateObj = new \Org\Util\Category($cates);  //实例化
    $this->treeArr = $cateObj->getTree($cates,1); //树形数组
		$this->display(C('DEFAULT_TPL').'/cateIndex');
	}

	//增加一个分类
	public function add(){
		$model = M('category');
		if(!IS_POST){
			$this->cates = getTree($model->select(),0);
			$this->display(C('DEFAULT_TPL').'/cateAdd');
		}else{
			$data['title'] = I('post.title');
			$data['pid'] = I('post.pid');
			$data['sta'] = I('post.sta');
			$data['intr'] = I('post.intr');
			$data['ord'] = I('post.ord');

			if(empty($data['title'])){
				$this->error('分类名称不能为空！','',1);
			}
			$is_add = $model->add($data);
			if($is_add){
				$this->success('分类添加成功！',U('Category/index'),1);
			}else{
				$this->error('分类添加失败！','',1);
			}
			
		}
	}

	//修改一个分类
	public function edit(){
		$model = M('category');
		if(!IS_POST){
			$this->cates = getTree($model->select(),0);
			$this->cateinfo = $model->where("id=".I('get.id'))->find();
			$this->display(C('DEFAULT_TPL').'/cateEdit');
		}else{
			$data['title'] = I('post.title');
			$data['intr'] = I('post.intr');
			$data['sta'] = I('post.sta');
			$data['ord'] = I('post.ord');
			$data['pid'] = I('post.pid');

			if(empty($data['title'])){
				$this->error('分类标题不能为空！','',1);
			}

			$is_save = $model->where("id=".I('post.id'))->save($data);
			if($is_save !== false){
				$this->success('分类修改成功！',U('Category/index'),1);
			}else{
				$this->error('分类修改失败!','',1);
			}
		}
	}	

	//删除一个分类
	public function del(){
		$item = M('category')->where("pid=".I('get.id'))->select();
		if(count($item) != 0){
			$this->error('请先删除该分类的子分类！',U('category/index'),1);
		}
		// $is_del = M('category')->where("id=".I('get.id'))->delete();
		// if($is_del){
		// 	$this->success('分类删除成功！',U('category/index'),1);
		// }else{
		// 	$this->error('分类删除失败！',U('category/index'),1);
		// }
		
	}

}




















 ?>
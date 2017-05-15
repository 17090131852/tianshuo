<?php
/**
 * Created by PhpStorm.
 * User: Funky
 * Date: 2017/5/7
 * Time: 21:23
 */

namespace Tadm\Controller;

use Common\Controller\BaseController;
class ServicesController extends BaseController
{
    public function index(){
        $where = [];
        if(IS_POST){
            $data = array_filter($_POST);
            isset($data['province']) ? $where['private_id'] = $data['province'] : null;
            isset($data['city']) ? $where['city_id'] = $data['city'] : null;
            isset($data['name']) ? $where['name'] = $data['name'] : null;
            $where['_logic'] = 'OR';
        }
        $model = M('map');
        $count = $model->where($where)->count();
        $Page = new \Think\Page($count, 10);
        $this->name = $data['name'];
        $this->page = $Page->show();
        $this->data = $model->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

        $this->display();
    }
    public function appointment(){
        $where = [];
        if(IS_POST){
            $data = array_filter($_POST);
            isset($data['province']) ? $where['province_id'] = $data['province'] : null;
            isset($data['city']) ? $where['city_id'] = $data['city'] : null;
            isset($data['name']) ? $where['name'] = $data['name'] : null;
            $where['_logic'] = 'OR';
        }
        $model = M('services');
        $count = $model->where($where)->count();
        $Page = new \Think\Page($count, 10);
        $this->name = $data['name'];
        $this->page = $Page->show();
        $this->data = $model->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

        $this->display();
    }
    public function edit(){
        $id = intval($_GET['id']);
        $data = array();
        if($id){
            $data = M('map')->where(array('id'=>$id))->find();
            $data['points'] = $data['x'] . " , " .$data['y'];
        }

        $this->id = $id;
        $this->data = $data;

        $this->display();
    }

    public function save(){
        $id = $_POST['id'];
        $data = $_POST['data'];
        if($id){
            M('map')->where(array('id'=>$id))->save($data);
            $msg = '6S店信息更新成功';
        }else{
            M('map')->data($data)->add();
            $msg = '6S店信息添加成功';
        }
        $this->success($msg);
    }


}
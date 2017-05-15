<?php
/**
 * Created by PhpStorm.
 * User: Funky
 * Date: 2017/5/7
 * Time: 19:40
 */

namespace Tweb\Controller;


use Think\Controller;

class ServicesController extends Controller
{
    public function index(){
        $id = $_GET['id'];
        $data = M('goods')->where(array('goods_id'=>$id))->find();
        $this->data =$data;
        $this->display();
    }

    public function save(){
        //Array ( [name] => 1 [tel] => 1 [car] => 1 [Wdate] => 2017-05-08 22:56:46 [province_name] => 北京市 [tiy] => 1 [city_name] => 北京市 [tiy1] => 2 [s6_name] => 顺电北京颐堤港店 [s6] => 179 )
        $post = $_POST;
        $data['name'] = $post['name'];
        $data['mobile'] = $post['tel'];
        $data['type'] = $post['car'];
        $data['usertime'] = $post['Wdate'];
        $data['province_id'] = $post['tiy'];
        $data['province_name'] = $post['province_name'];
        $data['city_id'] = $post['tiy1'];
        $data['city_name'] = $post['city_name'];
        $data['services'] = $post['s6'];
        $data['services_name'] = $post['s6_name'];
        $data['createtime'] = date("Y-m-d H:i:s");

        M("services")->data($data)->add();
        $this->data = $data;
        $this->display();
    }
    public function successs(){
        $sid = $_GET['id'];
        $this->display();
    }
    public function getAreas(){
        $parent_id = intval($_GET['pid']);
        $areas = M("areas")->where("pid = '{$parent_id}'")->select();
        echo json_encode($areas);
        exit;
    }

    public function getServices(){
        $id = $_GET['id'];
        $services = M("map")->where("city_id = '{$id}'")->select();
        echo json_encode($services);
        exit;
    }

}
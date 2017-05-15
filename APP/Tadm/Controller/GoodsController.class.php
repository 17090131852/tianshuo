<?php
namespace Tadm\Controller;

use Tadm\Biz\Commission;
use Tadm\Biz\Levels;
use Tadm\Biz\Goods;

class GoodsController extends Base
{
    public function index()
    {

        $goodsbiz = new Goods();
        $cat_id   = $goodsbiz->getCatidByPidTitle('积分商城');
        
        $map        = array("cat_id in($cat_id)"); //条件数组
        $pagesize   = 10;
        $is_show    = $this->request('is_show', 'int', 0);    //是否在售：1是，0下架
        $start_time = $this->request('start_time', 'string', '');
        $end_time   = $this->request('end_time', 'string', '');
        $goods_code = $this->request('goods_code', 'string', '');
        $goods_name = $this->request('goods_name', 'string', '');

        if ($is_show) {
            $map['is_show'] = $is_show - 1;
        }
        if (!empty($start_time) && empty($end_time)) {
            $map['add_time'] = array('egt', $start_time);
        }
        if (!empty($end_time) && empty($start_time)) {
            $map['add_time'] = array('elt', $end_time);
        }

        if (!empty($start_time) && !empty($end_time)) {
            $map['add_time'] = array('between', "{$start_time},{$end_time}");
        }
        if (!empty($goods_code)) {
            $map['goods_code'] = array('like', $goods_code . '%');
        }
        if (!empty($goods_name)) {
            $map['goods_name'] = array('like', $goods_name . '%');
        }

        $model = M('goods');
        $count = $model->where($map)->count();

        $Page = new \Think\Page($count, $pagesize);
        $show = $Page->show();

        $data = $model
            ->where($map)
            ->order('goods_id desc')
            ->limit($Page->firstRow . ',' . $Page->listRows)->select();
//        echo $model->getLastSql();

        $this->is_show    = $is_show;
        $this->start_time = $start_time;
        $this->end_time   = $end_time;
        $this->goods_code = $goods_code;
        $this->goods_name = $goods_name;
        $this->data       = $data;
        $this->page       = $show;
    }

    /**
     * 商品详情
     */
    public function view()
    {
        $id = $this->request('id', 'int', 0);

        //商品信息
        $model = M('goods');
        $data  = $model->where("goods_id='{$id}'")->find();
        if (empty($data)) {
            $this->error('商品信息有误', '/Tadm/goods/index');
        }
        // 查询该商品组图
        $goods_images = M('goods_images')->where("goods_id='{$id}'")->select();

        $this->goods_images = $goods_images;
        $this->data         = $data;
    }

    public function add()
    {
        $goods_images = array();
        $cat          = array();
        $cat_two      = array();
        $data         = array();
        $pid          = 0;
        $id   = $this->get('id', 'int', 0);
        if ($id) {
            //商品信息
            $model = M('goods');
            $data  = $model->where("goods_id='{$id}'")->find();
            if (empty($data)) {
                $this->error('商品信息有误', '/Tadm/goods/index');
            }
            // 查询该商品组图
            $goods_images = M('goods_images')->where("goods_id='{$id}'")->select();

            //查询该商品父类
            $pid = M('category')->field('pid')->where("id='{$data[cat_id]}'")->find();
            //查询该父类下的所有子类
            $cat_two = M('category')->where("pid='{$pid[pid]}'")->select();
        }
        //查询所有的一级分类
        $catobj = M('category');
        $cat    = $catobj->where("id>='17' and pid=1")->select(); //一级分类

        $this->goods_images = $goods_images; //组图
        $this->cat          = $cat;
        $this->cat_two      = $cat_two;
        $this->pid          = $pid;
        $this->data         = $data;
        $this->id           = $id;
    }



    public function save()
    {
        $data     = array();
        $data['goods_name']         = $this->request('goods_name', 'string', '');
        $data['goods_price']        = $this->request('goods_price', 'float', 0.00);
        $data['goods_market_price'] = $this->request('goods_market_price', 'float', 0.00);
        $data['goods_num']          = $this->request('goods_num', 'int', 0);
        $data['goods_sale_num']     = $this->request('goods_sale_num', 'int', 0);
        $data['is_show']            = $this->request('is_show', 'int', 0);
        $data['cat_one']            = $this->request('cat_one', 'int', 0);
        $data['cat_two']            = $this->request('cat_two', 'int', 0);
        // $data['goods_desc']      = $this->request('editorValue');
        $data['is_real']            = $this->request('is_real', 'int', 0);
        $data['is_hot']             = $this->request('is_hot', 'int', 0);
        $data['is_new']             = $this->request('is_new', 'int', 0);
        $data['give_score']         = $this->request('give_score', 'int', 0);
        $data['goods_brief']        = $this->request('goods_brief', 'string', '');
        $data['goods_desc']     = $_REQUEST['goods_desc'];

        $id                 = $this->request("id", "int", 0);
        $data['cat_id']     = $data['cat_two'] ?: $data['cat_one'];
        // 组图
        $goods_img    = $this->request('goods_img','array');
        $goodsimg_old = $this->request('goods_img_old','array');
        // 新上传图片，并且是修改状态下
        if(!empty($goods_img) && $id){
            // 删除原有组图
            M('goods_images')->where("goods_id='{$id}'")->delete(); 
            $data['goods_thumb'] = $goods_img[0];
            $data['goods_img']   = $goods_img[0];
        }else{
            $data['goods_thumb'] = $goodsimg_old[0];
            $data['goods_img']   = $goodsimg_old[0];
        }

        if ($id) {
            $data['update_time']   = date("Y-m-d H:i:s");
            M("goods")->where("goods_id='{$id}'")->save($data);
        } else {
            $data['goods_code']  = \Tweb\Biz\Crpty::makeProductSN();
            $data['add_time']    = date("Y-m-d H:i:s");
            $data['update_time'] = date("Y-m-d H:i:s");
            $data['goods_sort']  = 50;
            $id = M("goods")->add($data);
        }


        if(!empty($goods_img)){
            foreach ($goods_img as $key => $value) {
                $goods_images = M("goods_images"); 
                $data['goods_id']  = $id;
                $data['image_url'] = $value;
                $goods_images->add($data);
            }
        }

        $this->redirect("/Tadm/Goods/index");
        exit;

        // 上传封面图片
        // $upload           = new \Think\Upload();// 实例化上传类
        // $upload->maxSize  = C('UPLOAD_MAX_SIZE');
        // $upload->rootPath = './Upload/Goods/';
        // $upload->savePath = '';
        // $upload->saveName = array('uniqid', '');
        // $upload->exts     = array('jpg', 'gif', 'png', 'jpeg');
        // $upload->autoSub  = true;
        // $upload->subName  = array('date', 'Ymd');

// 		if(!$_FILES){
// 			$this->error('请上传图片');
// 		}else {
// 			// 上传文件
// 			$info = $upload->upload();
// //					dump($info);die;
// 			if (!$info) {// 上传错误提示错误信息
// 				$this->error($upload->getError());
// 			} else {// 上传成功
// 				$rootPath = '/Upload/Goods/';
//                 $data['goods_thumb'] = $rootPath.$info['goods_img']['savepath'].$info['goods_img']['savename'];
//                 $data['goods_img']   = $rootPath.$info['goods_img']['savepath'].$info['goods_img']['savename'];
// 			}

// 			//$data['goods_img'] = $info['goods_img']['savepath'].$info['goods_img']['savename'];
// //        print_r($data);
			
// 		}
    }

    /**
     * 更新商品上下架状态
     */
    public function changeStatus()
    {
        $id     = $this->get('id', 'int', 0);
        $isshow = $this->get('isshow', 'int', 0);
        if (!$id) {
            $this->error('商品信息有误！', '/Tadm/Goods/index');
        }

        //更新订单状态
        $goods           = M("goods");
        $data['is_show'] = $isshow;
        $res             = $goods->where("goods_id='{$id}'")->save($data);
        if (!$res) {
            $this->error('商品状态修改失败', '/Tadm/Goods/index');
            exit;
        }

        $this->success('商品状态操作成功！', '/Tadm/Goods/index', 10);
        exit;

    }

    public function test()
    {
        $price = 10000;
        //返还佣金和积分
        $comm = new Commission(10);
        $comm->Debug();
        $comm->setPrice($price);
        $comm->setOrderSN("123");
        print_r($comm->process());

        //更新等级
        $level = new Levels("TS42819788755786");
        $rs    = $level->check($price);

        echo \Tweb\Biz\Crpty::makeMSN();
    }


}
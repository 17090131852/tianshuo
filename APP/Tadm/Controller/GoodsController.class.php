<?php
namespace Tadm\Controller;

use Tadm\Biz\Commission;
use Tadm\Biz\Levels;

class GoodsController extends Base
{
    public function index()
    {
        $map        = array('1=1'); //条件数组
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
        $this->data = $data;
    }

    public function add()
    {
        $data = array();
        $id   = $this->get('id', 'int', 0);
        if ($id) {
            //商品信息
            $model = M('goods');
            $data  = $model->where("goods_id='{$id}'")->find();
            if (empty($data)) {
                $this->error('商品信息有误', '/Tadm/goods/index');
            }
        }

        //查询分类
        $catobj = M('category');
        $cat    = $catobj->where("id>='17' and pid=1")->select(); //一级分类

        $this->cat  = $cat;
        $this->data = $data;
        $this->id   = $id;
    }

    public function save()
    {

        $data                   = array();
        $data['goods_name']     = $this->request('goods_name', 'string', '');
        $data['goods_price']    = $this->request('goods_price', 'float', 0.00);
        $data['goods_score']    = $this->request('goods_score', 'float', 0.00);
        $data['goods_num']      = $this->request('goods_num', 'int', 0);
        $data['goods_sale_num'] = $this->request('goods_sale_num', 'int', 0);
        $data['is_show']        = $this->request('is_show', 'int', 0);
        $data['cat_one']        = $this->request('cat_one', 'int', 0);
        $data['cat_two']        = $this->request('cat_two', 'int', 0);
        $data['goods_desc']     = $this->request('editorValue');
        $data['is_real']        = $this->request('is_real', 'int', 0);
        $data['is_hot']         = $this->request('is_hot', 'int', 0);
        $data['is_new']         = $this->request('is_new', 'int', 0);
        $data['give_score']     = $this->request('give_score', 'int', 0);

        $data['cat_id'] = $data['cat_two'] ?: $data['cat_one'];
        $id             = $this->request("id", "int", 0);

        $upload           = new \Think\Upload();// 实例化上传类
        $upload->maxSize  = C('UPLOAD_MAX_SIZE');
        $upload->rootPath = './Upload/Goods/';
        $upload->savePath = '';
        $upload->saveName = array('uniqid', '');
        $upload->exts     = array('jpg', 'gif', 'png', 'jpeg');
        $upload->autoSub  = true;
        $upload->subName  = array('date', 'Ymd');

				if(!$_FILES){
					$this->error('请上传图片');
				}else {
					// 上传文件
					$info = $upload->upload();
//					dump($info);die;
					if (!$info) {// 上传错误提示错误信息
						$this->error($upload->getError());
					} else {// 上传成功
						$rootPath = '/Upload/Goods/';
						$data['goods_thumb'] = $rootPath.$info['goods_img']['savepath'].$info['goods_img']['savename'];
						$data['goods_img'] = $rootPath.$info['goods_img']['savepath'].$info['goods_img']['savename'];
					}

					//$data['goods_img'] = $info['goods_img']['savepath'].$info['goods_img']['savename'];
//        print_r($data);
					$data['goods_code'] = \Tweb\Biz\Crpty::makeProductSN();
					$data['add_time'] = date("Y-m-d H:i:s");
					$data['goods_sort'] = 50;
					$goods = M("goods");
					if ($id) {
						$goods->where("goods_id='{$id}'")->save($data);
					} else {
						$goods->add($data);
					}

					$this->redirect("/Tadm/Goods/index");
					exit;
				}
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
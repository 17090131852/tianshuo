<?php
/**
 * Created by PhpStorm.
 * User: Invincible
 * Date: 2017/3/30
 * Time: 10:55
 */
namespace Tweb\Controller;

//use Org\Util\ShopCart;
use Think\Controller;
use Tadm\Biz\Commission;
use Tadm\Biz\Levels;
use Tweb\Biz\Goods;
use Tweb\Biz\Order;

class CarSupeController extends Base
{

	public function _initialize(){
        header("Content-type: text/html; charset=utf-8");
		//返回轮播图资源
		$objCommend = M('commends');
		$objResource = M('resources');
		$commendStatus = $objCommend->where('location = "汽车超市"')->find();
		$resourceList = $objResource->where('resource_id="'.$commendStatus['id'].'"')->select();
		$this->resourceList = $resourceList;
	}

    //汽车超市列表
    public function index()
    {
		$pid = M('category')->field('id')->where("title='车型总览'")->find();
        $categoryList = M('category')->where("pid='{$pid['id']}'")->select();
		foreach ($categoryList as $key => $value) {
			$where['cat_id'] = $value['id'];
			$where['is_show'] = 1;
			$goodsList = M('goods')->where($where)->select();

			if ($goodsList) {
				$result[$key]['title'] = $value['title'];
				$result[$key]['goods'] = $goodsList;
			}
		}
// print_r($result);exit;
        $this->goods        = $result;
    }
    //立即购买
    public function buyNow()
    {

        $addResult['code'] = 1;
        $addResult['msg']  = '成功';
        //判断用户是否登录
        $msn = session('msn');
        if (!$msn) {
            $addResult['code'] = 1002;
            $addResult['msg']  = '用户未登录';
            echo json_encode($addResult);
            exit;
        }

        $objGoods = M('goods');
        $postCart = $_POST; //接收前台数据
        $goodsInfo = $objGoods->where('goods_id=' . $postCart['id'])->find();

        if($postCart['num'] == '' || $postCart['num'] < 0 || empty($goodsInfo)){
            $addResult['code'] = 1004;
            $addResult['msg']  = '无效的商品数量';
            echo json_encode($addResult);
            exit;
        }

        if ($postCart['num'] > $goodsInfo['goods_num']) {
            $addResult['code'] = 1003;
            $addResult['msg']  = '添加数量超出限制';
            echo json_encode($addResult);
            exit;
        } 
        echo json_encode($addResult);
    }

    //生成提交前的订单页面
    public function confirm()
    {
        $msn        = session('msn');
        $mid        = session('mid');
        $goods_code = $this->get('goods_code','string','');
        $gNum       = $this->get('gNum','int',0);

        if (!$msn) {
            $this->error('用户未登录');
        }

        $goods = M('goods')->where("goods_code='{$goods_code}'")->find();
        if (!$goods) {
            $this->error('商品信息有误', '/CarSupe/index',0);
        }

        if ($goods['is_show']==0) {
            redirect('/CarSupe/index',2, '商品已下架,跳转中...');
        }       
        //购买信息存入session
        $objAddress  = M('address');
        $addressList = $objAddress->where('msn="' . $msn . '"')->select();

        // 订单总金额
        $orderobj = new Order();
        $sum = $orderobj->getOrderSumByid($goods,$mid,$gNum);

        $this->addressList = $addressList;
        $this->goods       = $goods;
        $this->goods_code  = $goods_code;
        $this->gNum        = $gNum;
        $this->sum         = $sum;
    }

    //创建、支付订单
    public function createOrder()
    {
        $msn        = session('msn');
        $mid        = session('mid');
        $goods_code = $this->post('goods_code','string','');
        $gNum       = $this->post('gNum','int',0);

        if (!$msn) {
            $this->error('用户未登录');
        }

        //获取商品信息
        $goods = M('goods')->where("goods_code='{$goods_code}'")->find();
        if(empty($goods)){
            $this->error('商品信息有误');
        }

        //订单总金额
        // $total_amount = $goods['goods_price']*$gNum;
        // 订单总金额
        $orderobj = new Order();
        $total_amount = $orderobj->getOrderSumByid($goods,$mid,$gNum);


        //获取用户信息
        $memInfo = M('member')->where("msn='{$msn}'")->find();
        if(empty($memInfo)){
             $this->error('用户未登录');
        }

        $address_id = I('post.address_id');
        if (!$address_id) {
            $this->error('请选择收货地址！');
        }

        //获取地址信息
        $addressInfo = M('address')->where('id=' . $address_id)->find();
        if (empty($addressInfo)) {
            $this->error('请选择收货地址！');
        }

        //填充订单表数据
        $orderData['order_sn']        = $this->getOrderSn();
        $orderData['msn']             = $msn;
        $orderData['order_status']    = 0;
        $orderData['is_audit']        = 1; //默认已审核
        $orderData['realname']        = $memInfo['realname'];
        $orderData['province']        = $addressInfo['province'];
        $orderData['city']            = $addressInfo['city'];
        $orderData['county']          = $addressInfo['county'];
        $orderData['address']         = $addressInfo['address'];
        $orderData['zipcode']         = $addressInfo['zipcode'];
        $orderData['tel']             = $addressInfo['tel'];
        $orderData['integral']        = $total_amount;
        $orderData['type']            =2; //汽车超市
        $orderData['create_time']     = date("Y-m-d H:i:s");
        $orderData['update_time']     = date("Y-m-d H:i:s");
        //保存订单表数据
        $orderobj = D('order');
        $res = $orderobj->create($orderData);
        if (!$res) {
            $this->error($orderobj->getError());
        }
        $order_id   = $orderobj->add($orderData);
        //获取新插入订单数据
        $newOrder = $orderobj->where('id=' . $order_id)->find();

        $relation['msn']          = $msn;
        $relation['goods_code']   = $goods['goods_code'];
        $relation['order_sn']     = $newOrder['order_sn'];
        $relation['order_status'] = $newOrder['order_status'];
        $relation['goods_name']   = $goods['goods_name'];
        $relation['goods_thumb']  = $goods['goods_thumb'];
        $relation['goods_num']    = $gNum;
        $relation['total_score']  = $total_amount;
        $relation['create_at']    = date("Y-m-d H:i:s");
        $relation['update_at']    = date("Y-m-d H:i:s");

        $res = D('order_goods')->add($relation);
        if (!$res) {
            $this->error('数据提交不完全');
        }

        $this->redirect('/Order/index',array('type'=>2), 2, '订单提交成功,跳转中...');
    }

    //添加地址
    public function addAddress()
    {
        $goods_code = $this->get('goods_code','string','');
        $gNum       = $this->get('gNum','int',0);
        $msn = session('msn');
        if (!$msn) {
            $this->error('用户未登录');
        }
        session('carorder.goods_code',$goods_code);
        session('carorder.gNum',$gNum);
    }

    public function createAddress()
    {
        $msn = session('msn');
        if (!$msn) {
            $this->error('用户未登录');
        }
        $postAddress = I('post.');
        $objAddress  = D('address');
        $addressList = $objAddress->where('msn="' . $msn . '"')->select();
        if ($postAddress['default_address'] == 1) {
            foreach ($addressList as $value) {
                if ($value['default_address'] == 1) {
                    $array  = array('default_address' => 0, 'utime' => time());
                    $return = $objAddress->where('id="' . $value['id'] . '"')->setField($array);
                    if (!$return) {
                        $this->error('默认地址异常');
                    }
                }
            }
        }
        $postAddress['msn']   = $msn;
        $postAddress['ctime'] = time();
        $postAddress['utime'] = time();
        if (!$objAddress->create($postAddress)) {
            $this->error($objAddress->getError());
        }
        if (count($addressList) == 0) {
            $postAddress['default_address'] = 1;
        }
        $result = $objAddress->add($postAddress);
        if ($result) {
            $goods_code = session('carorder.goods_code');
            $gNum       = session('carorder.gNum');
            $this->redirect('CarSupe/confirm', array('goods_code' => $goods_code,'gNum'=>$gNum), 1, '成功添加地址,跳转中...');
        }
    }

    //修改地址

    public function editAddress()
    {
        $goods_code = $this->get('goods_code','string','');
        $gNum       = $this->get('gNum','int',0);
        session('carorder.goods_code',$goods_code);
        session('carorder.gNum',$gNum);

        $msn = session('msn');
        if (!$msn) {
            $this->error('用户未登录');
        }
        $id                = I('get.id');
        $this->id          = $id;
        $objAddress        = M('address');
        $addressInfo       = $objAddress->where('id=' . $id)->find();
        $this->addressInfo = $addressInfo;
    }

    public function modifyAddress()
    {
        $goods_code = session('carorder.goods_code');
        $gNum       = session('carorder.gNum');

        $msn = session('msn');
        if (!$msn) {
            $this->error('用户未登录');
        }
        $id            = I('get.id');
        $objAddress    = D('address');
        $data          = I('post.');
        $data['utime'] = time();
        if ($objAddress->create($data)) {
            $result = $objAddress->where('id="' . $id . '"')->save($data);
            if ($result !== false) {
                $this->redirect('CarSupe/confirm', array('goods_code' => $goods_code,'gNum'=>$gNum), 2, '地址编辑成功,跳转中...');
            }else{
                $this->redirect('CarSupe/confirm', array('goods_code' => $goods_code,'gNum'=>$gNum), 2, '地址编辑失败,跳转中...');

            }
        } else {
            // $this->error($objAddress->getError());
            $this->redirect('CarSupe/confirm', array('goods_code' => $goods_code,'gNum'=>$gNum), 2, '地址编辑失败,跳转中...');
            
        }
    }

    //设置默认地址
    public function setDefaultAddress()
    {   
        $msn = session('msn');
        if (!$msn) {
            $this->error('用户未登录');
        }
        $id          = I('get.id');
        $objAddress  = M('address');
        $addressInfo = $objAddress->where('msn="' . $msn . '"')->select();
        foreach ($addressInfo as $value) {
            $array  = array('default_address' => 0, 'utime' => time());
            $return = $objAddress->where('id="' . $value['id'] . '"')->setField($array);
            if (!$return) {
                $this->error('默认地址异常');
            }
        }
        $newArray = array('default_address' => 1, 'utime' => time());
        $result   = $objAddress->where('id=' . $id)->setField($newArray);
        if ($result) {
            $this->success('设置成功');
        }
    }

    //删除地址
    public function destroyAddress()
    {
        $msn = session('msn');
        if (!$msn) {
            $this->error('用户未登录');
        }
        $id         = I('get.id');
        $objAddress = M('address');
        $result     = $objAddress->where('id="' . $id . '"')->delete();
        if ($result !== false) {
            $this->success('地址删除成功');
        }
    }
    /**
     * 生成订单编号
     * @return [type] [description]
     */
    public function getOrderSn(){
        $date = date("Ymd");
        $str  = array_merge(range('A', 'Z'));
        shuffle($str);
        $str  = implode('', array_slice($str, 0, 4));

        return 'TS' . $date . $str;
    }
    //商品详情
    public function Info()
    {
        $images  = array();
        $selling = array();
        $id     = $_GET['goods_id'];
        if (!$id) {
            $this->error('商品不存在');
        }
        $goods     = M('goods');
        $goodsInfo = $goods->where('goods_id=' . $id)->find();
        if (empty($goodsInfo)) {
            $this->error('商品不存在');
        }
        if($goodsInfo['is_show']==0){
            $this->error('商品已下架');
        }
        // 得到商品组图
        $images = M('goods_images')->where('goods_id='.$id)->select();
        // 得到商品卖点
        $selling = M('goods_selling')->where('goods_id='.$id)->select();
        $this->data          = $goodsInfo;
        $this->images        = $images;
        $this->selling       = $selling;
    }

    Public function getSalesCount(){
        $code = $_GET['code'];
        $month = date('Y-m');
        $sales = M('order_goods as g')->join('ts_order as o on o.order_sn = g.order_sn')
            ->where("g.goods_code = '{$code}' and date_format(create_time,'%Y-%m') ='$month' and o.order_status = '3' ")
            ->field('sum(g.goods_num) as total')->find();
        //echo M()->getLastSql();
        $sales['total'] = $sales['total'] ?:0;
        echo "document.writeln(\"{$sales['total']}\");";
        exit;
    }

}
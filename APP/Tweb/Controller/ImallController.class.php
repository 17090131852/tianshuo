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

class ImallController extends Controller
{

	public function _initialize(){
		//返回轮播图资源
		$objCommend = M('commends');
		$objResource = M('resources');
		$commendStatus = $objCommend->where('location = "积分商城"')->find();
		$resourceList = $objResource->where('resource_id="'.$commendStatus['id'].'"')->select();
		$this->resourceList = $resourceList;
	}

    /**
     * @apiGroup ImallController
     *
     * @api {get} /tweb/imall/index 商品列表
     * @apiVersion 0.1.0
     * @apiHeader {String} msn  用户编号
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * {
     *    array(2) {
     *    [14] => array(2) {
     *      ["title"] => string(12) "实体商品"
     *      ["goods"] => array(3) {
     *        [0] => array(18) {
     *          ["goods_id"] => string(1) "1"
     *          ["goods_code"] => string(16) "TS56894235UJHNFP"
     *          ["goods_name"] => string(18) "天朔小型汽车"
     *          ["goods_price"] => string(8) "35000.00"
     *          ["goods_score"] => string(4) "1000"
     *          ["goods_img"] => string(24) "Upload/Goods/car_ex1.png"
     *          ["goods_thumb"] => string(24) "Upload/Goods/car_ex1.png"
     *          ["goods_desc"] => string(111) "这是天朔小型汽车的描述内容，填充内容只为展示使用，请替换详细的真实图文描述"
     *          ["goods_num"] => string(5) "15000"
     *          ["goods_sale_num"] => string(3) "192"
     *          ["is_hot"] => string(1) "0"
     *          ["is_new"] => string(1) "1"
     *          ["add_time"] => string(19) "2017-03-31 14:44:05"
     *          ["is_show"] => string(1) "1"
     *          ["cat_id"] => string(2) "18"
     *          ["goods_sort"] => string(1) "1"
     *          ["is_real"] => string(1) "1"
     *          ["give_score"] => string(1) "0"
     *        }
     *        [1] => array(18) {
     *          ["goods_id"] => string(1) "2"
     *          ["goods_code"] => string(16) "TS55983635JIULNB"
     *          ["goods_name"] => string(18) "天朔大型汽车"
     *          ["goods_price"] => string(8) "50000.00"
     *          ["goods_score"] => string(4) "1500"
     *          ["goods_img"] => string(21) "Upload/Test/news5.jpg"
     *          ["goods_thumb"] => string(21) "Upload/Test/news5.jpg"
     *          ["goods_desc"] => string(111) "这是天朔小型汽车的描述内容，填充内容只为展示使用，请替换详细的真实图文描述"
     *          ["goods_num"] => string(5) "10000"
     *          ["goods_sale_num"] => string(3) "100"
     *          ["is_hot"] => string(1) "1"
     *          ["is_new"] => string(1) "0"
     *          ["add_time"] => string(19) "2017-04-01 17:33:02"
     *          ["is_show"] => string(1) "1"
     *          ["cat_id"] => string(2) "18"
     *          ["goods_sort"] => string(1) "1"
     *          ["is_real"] => string(1) "1"
     *          ["give_score"] => string(1) "0"
     *        }
     *        [2] => array(18) {
     *          ["goods_id"] => string(1) "3"
     *          ["goods_code"] => string(16) "TS55983386JIULXX"
     *          ["goods_name"] => string(18) "天朔微型汽车"
     *          ["goods_price"] => string(8) "42000.00"
     *          ["goods_score"] => string(4) "1200"
     *          ["goods_img"] => string(18) "Upload/Test/p2.png"
     *          ["goods_thumb"] => string(18) "Upload/Test/p2.png"
     *          ["goods_desc"] => string(111) "这是天朔小型汽车的描述内容，填充内容只为展示使用，请替换详细的真实图文描述"
     *          ["goods_num"] => string(5) "20000"
     *          ["goods_sale_num"] => string(2) "80"
     *          ["is_hot"] => string(1) "0"
     *          ["is_new"] => string(1) "1"
     *          ["add_time"] => string(19) "2017-03-31 14:44:21"
     *          ["is_show"] => string(1) "1"
     *          ["cat_id"] => string(2) "18"
     *          ["goods_sort"] => string(1) "1"
     *          ["is_real"] => string(1) "1"
     *          ["give_score"] => string(1) "0"
     *        }
     *      }
     *    }
     *    [15] => array(2) {
     *      ["title"] => string(12) "虚拟商品"
     *      ["goods"] => array(2) {
     *        [0] => array(18) {
     *          ["goods_id"] => string(1) "4"
     *          ["goods_code"] => string(16) "TS56233386JIUAEC"
     *          ["goods_name"] => string(21) "100元手机充值卡"
     *          ["goods_price"] => string(5) "80.00"
     *          ["goods_score"] => string(2) "20"
     *          ["goods_img"] => string(25) "Upload/Test/cellphone.png"
     *          ["goods_thumb"] => string(25) "Upload/Test/cellphone.png"
     *          ["goods_desc"] => string(15) "手机充值卡"
     *          ["goods_num"] => string(4) "5000"
     *          ["goods_sale_num"] => string(4) "1000"
     *          ["is_hot"] => string(1) "1"
     *          ["is_new"] => string(1) "0"
     *          ["add_time"] => string(19) "2017-03-31 14:44:25"
     *          ["is_show"] => string(1) "1"
     *          ["cat_id"] => string(2) "19"
     *          ["goods_sort"] => string(1) "1"
     *          ["is_real"] => string(1) "1"
     *          ["give_score"] => string(1) "0"
     *        }
     *        [1] => array(18) {
     *          ["goods_id"] => string(1) "5"
     *          ["goods_code"] => string(16) "TS37959759DTYAEI"
     *          ["goods_name"] => string(15) "全年健身卡"
     *          ["goods_price"] => string(7) "3000.00"
     *          ["goods_score"] => string(3) "150"
     *          ["goods_img"] => string(25) "Upload/Test/sportcard.png"
     *          ["goods_thumb"] => string(25) "Upload/Test/sportcard.png"
     *          ["goods_desc"] => string(9) "健身卡"
     *          ["goods_num"] => string(4) "2000"
     *          ["goods_sale_num"] => string(3) "500"
     *          ["is_hot"] => string(1) "0"
     *          ["is_new"] => string(1) "1"
     *          ["add_time"] => string(19) "2017-03-31 14:44:30"
     *          ["is_show"] => string(1) "1"
     *          ["cat_id"] => string(2) "19"
     *          ["goods_sort"] => string(1) "1"
     *          ["is_real"] => string(1) "1"
     *          ["give_score"] => NULL
     *        }
     *      }
     *    }
     *   }
     * }
     * @apiErrorExample {json} 需要登录:
     * HTTP/1.1 401 Unauthorized
     * @apiErrorExample {json} 数据未找到:
     * HTTP/1.1 404 Not Found
     */

    //积分商城列表
    public function index()
    {
			$objGoods     = M('goods');
			$objCategory  = M('category');
			$categoryList = $objCategory->select();
			foreach ($categoryList as $key => $value) {
				$where['cat_id'] = $value['id'];
				$where['is_show'] = 1;
				$goodsList = $objGoods->where($where)->select();
				if ($goodsList) {
					$result[$key]['title'] = $value['title'];
					$result[$key]['goods'] = $goodsList;
				}
			}
			//返回轮播图资源
			$objCommend = M('commends');
			$objResource = M('resources');
			$commendStatus = $objCommend->where('location = "积分商城"')->find();
			$resourceList = $objResource->where('resource_id="'.$commendStatus['id'].'"')->select();
			$this->resourceList = $resourceList;
			$this->goods = $result;
			$this->display(C('DEFAULT_TPL') . '/ImallIndex');
    }

    /**
     * @apiGroup ImallController
     *
     * @api {get} /Tweb/imall/info 商品详情
     * @apiVersion 0.1.0
     * @apiHeader {String} msn  用户编号
     * @apiHeader {String} id   商品id
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * {
     *   array(18) {
     *     ["goods_id"] => string(1) "5"
     *     ["goods_code"] => string(16) "TS37959759DTYAEI"
     *     ["goods_name"] => string(15) "全年健身卡"
     *     ["goods_price"] => string(7) "3000.00"
     *     ["goods_score"] => string(3) "150"
     *     ["goods_img"] => string(25) "Upload/Test/sportcard.png"
     *     ["goods_thumb"] => string(25) "Upload/Test/sportcard.png"
     *     ["goods_desc"] => string(9) "健身卡"
     *     ["goods_num"] => string(4) "2000"
     *     ["goods_sale_num"] => string(3) "500"
     *     ["is_hot"] => string(1) "0"
     *     ["is_new"] => string(1) "1"
     *     ["add_time"] => string(19) "2017-03-31 14:44:30"
     *     ["is_show"] => string(1) "1"
     *     ["cat_id"] => string(2) "19"
     *     ["goods_sort"] => string(1) "1"
     *     ["is_real"] => string(1) "1"
     *     ["give_score"] => NULL
     *   }
     * }
     * @apiErrorExample {json} 需要登录:
     * HTTP/1.1 401 Unauthorized
     * @apiErrorExample {json} 数据未找到:
     * HTTP/1.1 404 Not Found
     */

    //商品详情
    public function info()
    {
        $id = $_GET['goods_id'];
        if (!$id) {
            $this->error('商品不存在');
        }
        $goods      = M('goods');
        $goodsInfo  = $goods->where('goods_id=' . $id)->find();
        $this->data = $goodsInfo;
        $this->display(C('DEFAULT_TPL') . '/ImallInfo');
    }

    /**
     * @apiGroup ImallController
     *
     * @api {get} /Tweb/Imall/addressList 地址列表
     * @apiVersion 0.1.0
     * @apiHeader {String} msn  用户编号
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * {
     *   array(6) {
     *     [0] => array(12) {
     *       ["id"] => string(2) "13"
     *       ["msn"] => string(12) "TS9975668522"
     *       ["province"] => string(6) "四川"
     *       ["city"] => string(6) "成都"
     *       ["county"] => string(9) "金牛区"
     *       ["address"] => string(20) "武侯北路126号12"
     *       ["ctime"] => string(10) "1490925224"
     *       ["utime"] => string(10) "1491037062"
     *       ["tel"] => string(11) "18382408729"
     *       ["realname"] => string(6) "谢超"
     *       ["zipcode"] => string(6) "611624"
     *       ["default_address"] => string(1) "0"
     *     }
     *     [1] => array(12) {
     *       ["id"] => string(2) "14"
     *       ["msn"] => string(12) "TS9975668522"
     *       ["province"] => string(6) "四川"
     *       ["city"] => string(6) "成都"
     *       ["county"] => string(9) "金牛区"
     *       ["address"] => string(18) "武侯北路126号"
     *       ["ctime"] => string(10) "1490925297"
     *       ["utime"] => string(10) "1490926003"
     *       ["tel"] => string(11) "18382408729"
     *       ["realname"] => string(6) "谢超"
     *       ["zipcode"] => string(6) "611624"
     *       ["default_address"] => string(1) "0"
     *     }
     *     [2] => array(12) {
     *       ["id"] => string(2) "15"
     *       ["msn"] => string(12) "TS9975668522"
     *       ["province"] => string(6) "四川"
     *       ["city"] => string(6) "成都"
     *       ["county"] => string(9) "金牛区"
     *       ["address"] => string(18) "武侯北路126号"
     *       ["ctime"] => string(10) "1490926003"
     *       ["utime"] => string(10) "1490926149"
     *       ["tel"] => string(11) "18382408729"
     *       ["realname"] => string(6) "谢超"
     *       ["zipcode"] => string(6) "611624"
     *       ["default_address"] => string(1) "0"
     *     }
     *   }
     * }
     * @apiErrorExample {json} 需要登录:
     * HTTP/1.1 401 Unauthorized
     * @apiErrorExample {json} 数据未找到:
     * HTTP/1.1 404 Not Found
     */
    //地址管理
    //地址列表
    public function addressList()
    {
        $msn = session('msn');
        if (!$msn) {
            $this->error('用户未登录');
        }
        $objAddress  = M('address');
        $addressList = $objAddress->where('msn="' . $msn . '"')->select();
        $this->list  = $addressList;
        $this->display(C('DEFAULT_TPL') . '/ImallAddressList');
    }

    //添加地址

    public function addAddress()
    {
        $msn = session('msn');
        if (!$msn) {
            $this->error('用户未登录');
        }
        $this->display(C('DEFAULT_TPL') . '/ImallAddAddress');
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
            $this->success('添加地址成功', '/Imall/balanceCart', 1);
        }
    }

    //修改地址

    public function editAddress()
    {
        $msn = session('msn');
        if (!$msn) {
            $this->error('用户未登录');
        }
        $id                = I('get.id');
        $this->id          = $id;
        $objAddress        = M('address');
        $addressInfo       = $objAddress->where('id=' . $id)->find();
        $this->addressInfo = $addressInfo;
        $this->display(C('DEFAULT_TPL') . '/ImallEditAddress');
    }

    public function modifyAddress()
    {
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
                $this->success('地址修改成功', '/Imall/balanceCart', 1);
            }
        } else {
            $this->error($objAddress->getError());
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

    //购物车
    //添加商品
    public function addCart()
    {

        $msn = session('msn');
        if (!$msn) {
            $addResult['code'] = 1002;
            $addResult['msg']  = '用户未登录';
            echo json_encode($addResult);
            exit;
        }
        $objCart  = M('cart');
        $objGoods = M('goods');
        $postCart = $_POST;
        if ($postCart['num'] > 50) {
            $addResult['code'] = 1003;
            $addResult['msg']  = '添加数量超出限制';
            echo json_encode($addResult);
            exit;
        } else if ($postCart['num'] == '' || $postCart['num'] < 0) {
            $addResult['code'] = 1004;
            $addResult['msg']  = '无效的商品数量';
            echo json_encode($addResult);
            exit;
        }
        $goodsInfo          = $objGoods->where('goods_id=' . $postCart['id'])->find();
        $postCart['msn']    = $msn;
        $count              = $postCart['num'];
        $sum                = $goodsInfo['goods_score'] * $count;
        $rule['msn']        = $msn;
        $rule['goods_code'] = $goodsInfo['goods_code'];
        $cartInfo           = $objCart->where($rule)->find();
        if ($cartInfo) {
            $newItem                = [];
            $newItem['num']         = $cartInfo['num'] + $postCart['num'];
            $newItem['total_price'] = $cartInfo['total_price'] + $sum;
            $newItem['utime']       = time();
            $result                 = $objCart->where('id="' . $cartInfo['id'] . '"')->setField($newItem);
            if ($result !== false) {
                $addResult['code'] = 1001;
                $addResult['msg']  = '添加成功';
            } else {
                $addResult['code'] = 1000;
                $addResult['msg']  = '添加失败';
            }
        } else {
            $newItem['msn']         = $msn;
            $newItem['num']         = $postCart['num'];
            $newItem['ctime']       = time();
            $newItem['utime']       = time();
            $newItem['total_price'] = $sum;
            $newItem['goods_code']  = $goodsInfo['goods_code'];
            $newItem['goods_name']  = $goodsInfo['goods_name'];
            $newItem['price']       = $goodsInfo['goods_price'];
            $result                 = $objCart->add($newItem);
            if ($result) {
                $addResult['code'] = 1001;
                $addResult['msg']  = '添加成功';
            } else {
                $addResult['code'] = 1000;
                $addResult['msg']  = '添加失败';
            }
        }
        echo json_encode($addResult);
    }


    /**
     * @apiGroup ImallController
     *
     * @api {get} /Tweb/Imall/cartList 购物车列表
     * @apiVersion 0.1.0
     * @apiHeader {String} msn  用户编号
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * {
     *   array(3) {
     *     ["items"] => array(2) {
     *       [0] => array(9) {
     *         ["id"] => string(2) "93"
     *         ["msn"] => string(12) "TS9975668522"
     *         ["goods_code"] => string(16) "TS55983635JIULNB"
     *         ["total_price"] => string(5) "76500"
     *         ["price"] => string(1) "0"
     *         ["goods_name"] => string(18) "天朔大型汽车"
     *         ["num"] => string(2) "51"
     *         ["ctime"] => string(10) "1490960519"
     *         ["utime"] => string(10) "1490966949"
     *       }
     *       [1] => array(9) {
     *         ["id"] => string(2) "95"
     *         ["msn"] => string(12) "TS9975668522"
     *         ["goods_code"] => string(16) "TS56233386JIUAEC"
     *         ["total_price"] => string(4) "8000"
     *         ["price"] => string(1) "0"
     *         ["goods_name"] => string(21) "100元手机充值卡"
     *         ["num"] => string(3) "100"
     *         ["ctime"] => string(10) "1490967017"
     *         ["utime"] => string(10) "1490967024"
     *       }
     *       ["sum"] => string(5) "84500"
     *     }
     *   }
     * }
     * @apiErrorExample {json} 需要登录:
     * HTTP/1.1 401 Unauthorized
     * @apiErrorExample {json} 数据未找到:
     * HTTP/1.1 404 Not Found
     */

    //购物车列表
    public function cartList()
    {
        $msn = session('msn');
        if (!$msn) {
            $this->error('用户未登录');
        }
        $objCart            = M('cart');
        $result['items']    = $objCart->where('msn="' . $msn . '"')->select();
        $sum                = $objCart->where('msn="' . $msn . '"')->sum('total_price');
        $result['sum']      = $sum;
        $this->cartList     = $result;
        $this->cartListJson = json_encode($result);
        $this->display(C('DEFAULT_TPL') . '/ImallCartList');
    }

    //编辑购物车商品
    public function modifyCart($postCart)
    {
        $msn = session('msn');
        if (!$msn) {
            $this->error('用户未登录');
        }
        $objCart  = M('cart');
        $id       = I('post.id');
        $cartInfo = $objCart->where('id=' . $id)->find();
        //根据商品数量更改消耗积分
        if ($postCart['num'] == 0) {
            $result = $objCart->where('id=' . $id)->delete();
            if ($result) {
                $this->success('删除成功');
            }
        }
        if ($postCart['num'] < $cartInfo['num']) {
            $data['total_price'] = $cartInfo['total_price'] - $postCart['goods_score'] * $postCart['num'];
        }
        if ($postCart['num'] > $cartInfo['num']) {
            $step1               = $postCart['num'] - $cartInfo['num'];
            $step2               = $step1 * $postCart['goods_score'];
            $data['total_price'] = $step2 + $cartInfo['total_price'];
        }
        $data['num'] = $postCart['num'];
        $result      = $objCart->where('id="' . $id . '"')->save($data);
        if ($result) {
            $this->success('修改成功');
        }
    }

    //删除购物车商品
    public function deleteCart()
    {
        $msn = session('msn');
        if (!$msn) {
            $this->error('用户未登录');
        }
        $id      = I('get.id');
        $objCart = M('cart');
        $result  = $objCart->where('id=' . $id)->delete();
        if ($result) {
            $this->success('删除成功');
        }
    }

    //清空购物车
    public function cleanCart()
    {
        $msn = session('msn');
        if (!$msn) {
            $this->error('用户未登录');
        }
        $objCart = M('cart');
        $result  = $objCart->where('msn="' . $msn . '"')->delete();
        if ($result) {
            $this->success('购物车已清空');
        }
    }

    //订单管理
    //订单列表
    public function orderList()
    {
        $msn = session('msn');
        if (!$msn) {
            $this->error('用户未登录');
        }
        $perpage         = 15;
        $objList         = M('order');
        $arrList         = $objList->where('msn="' . $msn . '"')->page(I('p'), $perpage)->order('update_time DESC')->select();
        $count           = $objList->count();
        $Page            = new \Think\Page($count, $perpage);
        $paginate        = $Page->show();
        $this->page      = $paginate;
        $this->orderList = $arrList;
        $this->display(C('DEFAULT_TPL') . '/ImallOrderList');
    }

    //创建、支付订单
    public function createOrder()
    {
        $address_id = I('post.address_id');
        if (!$address_id) {
            $this->error('请选择收货地址！');
        }
        $msn = session('msn');
        if (!$msn) {
            $this->error('用户未登录');
        }
        $objOrder         = D('order');
        $objAddress       = M('address');
        $objMember        = M('member');
        $objOrderRelation = D('order_goods');
        $cart             = M("cart")->where("msn='{$msn}'")->select();
        $orderInfo        = [];
        foreach ($cart as $c) {
            $orderInfo['integral'] += $c['total_price'];
        }
        //取得购物车数据
        $memInfo     = $objMember->where('msn="' . $msn . '"')->find();
        $addressInfo = $objAddress->where('id=' . $address_id)->find();
        //填充订单信息
        if ($orderInfo['integral'] > $memInfo['leave_score']) {
            $this->error('积分余额不足');
        } else {
            //扣除用户积分
            $memData['leave_score'] = $memInfo['leave_score'] - $orderInfo['integral'];
            $memResult              = $objMember->where('msn="' . $msn . '"')->setField($memData);
            if (!$memResult) {
                $this->error('积分扣除失败');
            }
            $date = date("Ymd", strtotime("today"));
            $str  = array_merge(range('A', 'Z'));
            shuffle($str);
            $str = implode('', array_slice($str, 0, 4));
            //填充订单表数据
            $orderData['order_sn']     = 'TS' . $date . $str;
            $orderData['msn']          = $msn;
            $orderData['order_status'] = 1;
            $orderData['realname']     = $memInfo['realname'];
            $orderData['province']     = $addressInfo['province'];
            $orderData['city']         = $addressInfo['city'];
            $orderData['county']       = $addressInfo['county'];
            $orderData['address']      = $addressInfo['address'];
            $orderData['zipcode']      = $addressInfo['zipcode'];
            $orderData['tel']          = $addressInfo['tel'];
            $orderData['integral']     = $orderInfo['integral'];
            $orderData['create_time']  = date("Y-m-d H:i:s", strtotime("now"));
            $orderData['update_time']  = date("Y-m-d H:i:s", strtotime("now"));
            //保存订单表数据
            if (!$objOrder->create($orderData)) {
                $this->error($objOrder->getError());
            }else{
                //更新等级
                $level = new Levels($msn);
                $rs    = $level->check($orderInfo['integral']);
            }
            $result   = $objOrder->add($orderData);
            $newOrder = $objOrder->where('id=' . $result)->find();
            //构造关系表数据
            foreach ($cart as $value) {
                $goodInfo = M("goods")->where('goods_code="' . $value['goods_code'] . '"')->find();
                //填充关系表数据
                $relation['msn']          = $msn;
                $relation['goods_code']   = $goodInfo['goods_code'];
                $relation['order_sn']     = $newOrder['order_sn'];
                $relation['order_status'] = $newOrder['order_status'];
                $relation['goods_name']   = $goodInfo['goods_name'];
                $relation['goods_thumb']  = $goodInfo['goods_thumb'];
                $relation['goods_num']    = $value['num'];
                $relation['total_score']  = $value['num'] * $goodInfo['goods_score'];
                $relation['create_at']    = date("Y-m-d H:i:s", strtotime("now"));
                $relation['update_at']    = date("Y-m-d H:i:s", strtotime("now"));
                $newRelation              = $objOrderRelation->add($relation);
                //清空购物车
                M("cart")->where('goods_code="' . $value['goods_code'] . '"')->delete();
                if (!$newRelation) {
                    $this->error('数据提交不完全');
                }
            }
        }
        $this->success('订单支付成功', '/Imall/index');
    }


    //生成提交前的订单页面
    public function balanceCart()
    {
        $msn = session('msn');
        if (!$msn) {
            $this->error('用户未登录');
        }
        $arrCartList = m("cart")->where("msn='{$msn}'")->select();
        if (!$arrCartList) {
            $this->error('购物车为空，请添加商品', '/Imall/index', 1);
        }
        $arrCartList = array("sum" => 1, 'items' => $arrCartList);

        $objAddress  = M('address');
        $addressList = $objAddress->where('msn="' . $msn . '"')->select();
        //生成订单号
        $this->addressList = $addressList;
        $this->cartList    = $arrCartList;
        $this->display(C('DEFAULT_TPL') . '/ImallBalanceCart');
    }

    //取消订单
    public function cancelOrder()
    {
        $msn = session('msn');
        if (!$msn) {
            $this->error('用户未登录');
        }
        $id               = I('post.id');
        $objOrder         = M('order');
        $objOrderRelation = M('order_goods');
        $ordInfo          = $objOrder->where('id=' . $id)->find();
        if ($ordInfo['order_status'] != 0) {
            $this->error('订单状态异常');
        } else {
            $result            = $objOrder->where('id=' . $id)->setField('order_status', 4);
            $ordRelationResult = $objOrderRelation->where('order_sn="' . $ordInfo['order_sn'] . '"')->setField('order_status', 4);
            if ($result !== false && $ordRelationResult !== false) {
                $this->success('订单已关闭');
            }
        }
    }

    //确认收货
    public function confirmOrder()
    {
        $msn = session('msn');
        if (!$msn) {
            $this->error('用户未登录');
        }
        $id               = I('post.id');
        $objOrder         = M('order');
        $objOrderRelation = M('order_goods');
        $ordInfo          = $objOrder->where('id=' . $id)->find();
        if ($ordInfo['order_status'] == 2) {
            $result            = $objOrder->where('id=' . $id)->setField('order_status', 3);
            $ordRelationResult = $objOrderRelation->where('order_sn="' . $ordInfo['order_sn'] . '"')->setField('order_status', 4);
            if ($result !== false && $ordRelationResult !== false) {
                $this->success('订单已确认收货');
            }
        } else {
            $this->error('订单状态异常');
        }
    }
}
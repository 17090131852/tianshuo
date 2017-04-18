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

class CarsuperController extends Base
{
    //汽车超市列表
    public function index(){
        $cat_id = 21; //汽车超市
        $goods = M('goods')->where("cat_id='{$cat_id}'")->select();
//print_r($goods);exit;
        $this->assign('goods',$goods);
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 10:24
 */
namespace Tweb\Controller;
use Tweb\Biz\datefmt;



class WalletController extends Base
{

	public function _initialize(){
		//返回轮播图资源
		$objCommend = M('commends');
		$objResource = M('resources');
		$commendStatus = $objCommend->where('location = "个人中心"')->find();
		$resourceList = $objResource->where('resource_id="'.$commendStatus['id'].'"')->select();
		$this->resourceList = $resourceList;
	}

    /**
     * 查询电子钱包
     */
    public function index(){
        // $msn = $_SESSION['msn'];
        // $data = M('member_commission')->order('id desc')->where("member_msn='{$msn}'")->select();


        // $this->assign('data',$data);
    }

}
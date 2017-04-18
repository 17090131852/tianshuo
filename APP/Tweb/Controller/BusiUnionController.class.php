<?php
namespace Tweb\Controller;
use Think\Controller;
class BusiUnionController extends Controller {
	//招商加盟
	public function index(){
		$this->display(C('DEFAULT_TPL').'/BusiUnionIndex');
	}
	//经销商风采
	public function dealer(){
		$this->display(C('DEFAULT_TPL').'/BusiUnionDealer');
	}
	//经销商风采-详情
	public function dealerDetail(){
		$this->display(C('DEFAULT_TPL').'/BusiUnionDealerDetail');
	}
}
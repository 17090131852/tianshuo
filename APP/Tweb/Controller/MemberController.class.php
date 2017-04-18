<?php
namespace Tweb\Controller;
use Common\Controller\LogchkController;
class MemberController extends LogchkController {
/**
 * @佛主保佑，永无BUG
 **********************************************
 
										_oo0oo_
									 088888880
									 88" . "88
									 (| -_- |)
										0\ = /0
								 ___/'---'\___
							 .' \\|     |// '.
						  / \\\\|  :  |//// \
						 / _ |||| -:- |||| _ \
						|   | \\\  -  /// |   |
						| \_|  ''\---/''  |_/ |
						\  .-\__  '-'  __/-.  /
					___'. .'  /--.--\  '. .'___
			 ."" '<  '.___\_<|>_/___.' >'  "".
			| | : '-  \'.;'\ _ /';.'/ - ' : | |
			\  \ '_.   \_ __\ /__ _/   .-' /  /
	====='-.____'.___ \_____/___.-'____.-'=====
										'=---='
										
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
					佛祖保佑    !!!    永无BUG
 *
**/

	public function _initialize(){
		//返回轮播图资源
		$objCommend = M('commends');
		$objResource = M('resources');
		$commendStatus = $objCommend->where('location = "个人中心"')->find();
		$resourceList = $objResource->where('resource_id="'.$commendStatus['id'].'"')->select();
		$this->resourceList = $resourceList;
	}

	public function index(){
		$msn = session('msn');
		$objMem = M('member');
		$objFund = M('member_commlog');
		$memInfo = $objMem->where('msn="'.$msn.'"')->find();
		$array = array('member_msn'=>$msn,'state'=>0);
		$fund = $objFund->where($array)->sum('amount');

		//获取该用户的第一代的下属
		$oone = $objMem->where("recom_msn='" . $msn . "'")->select();
		// 获取该用户的第二代下属
		foreach ($oone as $o) {
			$recom_ids[] = $o['msn'];
		}

		if (!empty($recom_ids)) {
			$recom_id = implode(',', $recom_ids);
			$ttwo = $objMem->where(array('recom_msn' => array('in', $recom_id)))->select();
		}

		// 获取该用户的第三代下属
		foreach ($ttwo as $t) {
			$recom_ids_two[] = $t['msn'];
		}

		if (!empty($recom_ids_two)) {
			$recom_id_two = implode(',', $recom_ids_two);
			$tthree = $objMem->where(array('recom_msn' => array('in', $recom_id_two)))->select();
		}

		$memData = [];
		switch($memInfo['type']){
			case 1:$memData['type'] = "众筹股东";
						 $memData['imgPath'] = '/Public/Images/Tweb/goldenMedalIcon.jpg';
				break;
			case 2:$memData['type'] = "总代理";
						 $memData['imgPath'] = '/Public/Images/Tweb/silverMedal.jpg';
				break;
			case 3:$memData['type'] = "VIP会员";
						 $memData['imgPath'] = '/Public/Images/Tweb/copperMedal.jpg';
				break;
			case 4:$memData['type'] = "普通会员";
						 $memData['imgPath'] = '/Public/Images/Tweb/ironMedal.jpg';
				break;
		}
		$memData['reg_time'] = date('Y-m-d H:i:s',$memInfo['reg_time']);
		$memData['one'] = count($oone);
		$memData['two'] = count($ttwo);
		$memData['three'] = count($tthree);
		if($fund){
			$memData['leave_money'] = $fund;
		}else{
			$memData['leave_money'] = "0.00";
		}
		$memData['leave_score'] = $memInfo['leave_score'];
		$memData['leave_orient_score'] = $memInfo['leave_orient_score'];
		$this->memData = $memData;
		$this->display(C('DEFAULT_TPL').'/MemberIndex');
	}


	/**
	 * @apiGroup MemberController
	 *
	 * @api {get} /Tweb/Member/view 查看用户资料
	 * @apiVersion 0.1.0
	 * @apiHeader {String} msn  用户编号
	 * @apiHeader {String} id   商品编号
	 * @apiSuccessExample {json} Success-Response:
	 * HTTP/1.1 200 OK
	 * {
	 *   array(32) {
	 *     ["mid"] => string(1) "1"
	 *     ["msn"] => string(12) "TS9975668522"
	 *     ["nickname"] => string(9) "金镯子"
	 *     ["group"] => string(1) "0"
	 *     ["sex"] => string(1) "1"
	 *     ["realname"] => NULL
	 *     ["pwd"] => string(32) "3b10119f5896aa2afdb38d0c47a8cb7c"
	 *     ["headimg"] => string(26) "Upload/Members/default.jpg"
	 *     ["mobile_phone"] => string(11) "15510687091"
	 *     ["email"] => string(11) "15510687091"
	 *     ["all_money"] => NULL
	 *     ["all_score"] => string(6) "100000"
	 *     ["leave_score"] => string(4) "4870"
	 *     ["prov"] => string(0) ""
	 *     ["city"] => string(9) "秦皇岛"
	 *     ["dist"] => NULL
	 *     ["address"] => string(10) "郭村2号"
	 *     ["recom_id"] => NULL
	 *     ["recom_msn"] => string(0) ""
	 *     ["recom_mobile"] => string(11) "13456545655"
	 *     ["birthday"] => string(9) "1992/8/10"
	 *     ["sec_question"] => NULL
	 *     ["sec_answer"] => NULL
	 *     ["pay_pwd"] => NULL
	 *     ["ident_num"] => NULL
	 *     ["reg_time"] => string(10) "1489725322"
	 *     ["type"] => string(1) "1"
	 *     ["leave_money"] => NULL
	 *     ["sta"] => NULL
	 *     ["ident_img"] => NULL
	 *     ["acount_sta"] => string(1) "2"
	 *     ["is_seed"] => string(1) "1"
	 *    }
	 *   }
	 * @apiErrorExample {json} 需要登录:
	 * HTTP/1.1 401 Unauthorized
	 * @apiErrorExample {json} 数据未找到:
	 * HTTP/1.1 404 Not Found
	 * @apiErrorExample {json} 服务器错误
	 * HTTP/1.1 500 Bad Request
	 */

	//个人资料
	public function view(){
		$msn = session('msn');
		$getMsn = I('get.msn');
		$model = M('member');
		if (!$msn) {
			$this->error('用户未登录');
		}
		if(!$getMsn){
			$memInfo = $model->where('msn="'.$msn.'"')->find();
		}else{
		$memInfo = $model->where('msn="'.$getMsn.'"')->find();
		}
		$createTime = date("Y-m-d H:i:s",$memInfo['reg_time']);
		$memInfo['reg_time'] = $createTime;
		switch($memInfo['origin']){
			case 0: $memInfo['origin'] = "自行注册";break;
			case 1: $memInfo['origin'] = "升级";break;
			case 2: $memInfo['origin'] = "推荐";break;
		}
		$this->memInfo = $memInfo;
		$this->display(C('DEFAULT_TPL').'/MemberView');
	}
	//编辑个人信息
	public function viewEdit() {
		if(!IS_POST){
			$msn = session('msn');
			$model = M('member');
			$memInfo = $model->where('msn="'.$msn.'"')->find();
			$this->memInfo = $memInfo;
			$this->display(C('DEFAULT_TPL').'/MemberViewEdit');
		}else{
			$data['realname'] = I('post.realname');
			$data['nickname'] = I('post.nickname');
			$data['prov'] = I('post.prov');
			$data['city'] = I('post.city');
			$data['dist'] = I('post.dist');
			$data['address'] = I('post.address');
			$data['birthday'] = I('post.birthday');
			$data['sex'] = I('post.sex');
			$data['email'] = I('post.email');

			$msn = session('msn');
			$model = M('member');
			$res = $model->where('msn="'.$msn.'"')->save($data);

			$this->success('修改成功',U('Member/view'),1);
		}
	}

	//添加下级用户
	public function add(){

		if(!IS_POST){
			$this->display(C('DEFAULT_TPL').'/MemberAdd');
		}else{
			$defaultPwd = 'ts123456';
			$nickname     = I('post.nickname');//用户昵称
			$mobile_phone = I('post.mobile_phone');; //用户手机号
			$type         = 4; //用户类型
			$password     = $defaultPwd;; //用户密码
			$repassword   = $defaultPwd; //用户重复密码

			$objmember = D('member');
			$objmember->realname = $nickname;
//			dump($objmember);die;
			$res = $objmember->saveMember($nickname,$mobile_phone,$type,$password);
			if($res['status']==1){
				$this->success('添加成功！',U('Member/index'),1);
			}else{
				$this->error($res['msg'],'',1);
			}
		}
	}

	//收货地址
	public function postAddr(){
		$msn = session('msn');
		$model = M('address');
		$this->address = $model->where("msn='$msn'")->select();
		$this->display(C('DEFAULT_TPL').'/MemberPostAddr');
	}
	//编辑收藏地址
	public function addPostAddr(){

		if(I('get.id')){
			$addId = I('get.id');
			if($addId == '' || $addId < 1){
				$this->error('无效地址!','',1);
			}

			$id =$addId;
			$model = M('address');
			$address = $model->where("id=$id")->find();
			$this->address = $address;
			$this->display(C('DEFAULT_TPL').'/MemberAddPostAddr');
		}else{
			$this->display(C('DEFAULT_TPL').'/MemberAddPostAddr');
		}
	}

	/**
	 * @保存地址修改
	 *
	 * @apiGroup MemberController
	 *
	 * @api {post} /Tweb/Member/savePostAddr 保存收货地址
	 * @apiVersion 0.1.0
	 * @apiParam {String} [realName]  真实姓名
	 * @apiParam {String} tel 手机号
	 * @apiParam {Array} addr 地址数组
	 * @apiParam {String} addr.prov 省份
	 * @apiParam {String} addr.city 市
	 * @apiParam {String} addr.dist 县
	 * @apiParam {String} address 详细地址
	 *
	 * @apiSuccessExample {json} Success-Response:
	 * HTTP/1.1 204 Updated
	 * {
	 *   
	 * }
	 * @apiErrorExample {json} 需要登录:
	 * HTTP/1.1 401 Unauthorized
	 * @apiErrorExample {json} 数据未找到:
	 * HTTP/1.1 404 Not Found
	 */
	public function savePostAddr(){
		if (IS_POST) {
			$id = (int)$_POST['id'];
			$data['tel'] = I('post.tel');
			$data['realname'] = I('post.realname');
			$data['province'] = I('post.province');
			$data['city'] = I('post.city');
			$data['county'] = I('post.county');
			$data['address'] = I('post.address');
			$data['default_address'] = 1;

			$model = M('address');
			if ($id > 0) {
				$data['utime'] = time();
				$model->where("id=$id")->save($data);
			} else {
				$data['ctime'] = time();
				$data['msn'] = session('msn');
				$data['mid'] = session('mid');
				$data['msn'] = session('msn');
				$data['default_address'] = 0;

                $result = $model->add($data);

			}
			$this->success('保存成功','/Member/PostAddr',2);
		}
	}
	//删除地址
	public function delPostAddr(){
		$id = (int)I('get.id');
		if ($id > 0) {
			$msn = session('msn');
			$model = M('address');
			$res = $model->where("id=$id and msn='$msn'")->delete();

			$res ? $this->success('删除成功', '', 1) : $this->error('删除失败', '', 1);

		}
	}

	//积分历史
	public function pointList(){
		$msn = session('msn');
		$objPoint = M('member_point');
		$objMember = M('member');
		$userMemInfo = $objMember->where("msn='$msn'")->find();

		//获取当前用户积分列表
		//todo 优化点：添加分页
//		$perpage = 5;
		$currentPointList = $objPoint->where('msn="'.$msn.'"')->select();
//		$count = count($currentPointList);
//		$currentPage = new \Think\Page($count,$perpage);
//		$paginate = $currentPage->show();
		foreach($currentPointList as $key => $value){
			$userPointList[$key] = $value;
			$userPointList[$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
			if($value['change_type'] == 1){
				$changeType = "定向消费积分";
			}else{
				$changeType = "积分";
			}
			if($value['op_type'] == 1){
				$opType = "+";
			}else{
				$opType = "-";
			}
			$userPointList[$key]['change_type'] = $changeType;
			$userPointList[$key]['op_type'] = $opType;
		}
		$this->currentPointList = $userPointList;

		$post = array_filter($_POST);
		if ($post) {
			$count = count($post);
			if ($count > 0) {
				$array = $this->selectUser($msn);
				$selectArray = array();
				foreach ($array as $v) {
					$res = array_intersect_assoc($v, $post);
					if (count($res) == $count) {
						$selectArray[] = $v;
					}
				}
				$this->mid = I('post.mid');
				$this->nickname = I("post.nickname");
				$this->level = I("post.level");
				$this->selectArray = $selectArray;
				$this->display(C('DEFAULT_TPL') . '/MemberPointList');
			}
		}else {
			//获取该用户的第一代的下属
			$oone = $objMember->where("recom_msn='" . $userMemInfo['msn'] . "'")->select();
			foreach ($oone as $k => $value) {
				$oone[$k]['family'] = 1;
			}
			// 获取该用户的第二代下属
			foreach ($oone as $o) {
				$recom_ids[] = $o['msn'];
			}

			if (!empty($recom_ids)) {
				$recom_id = implode(',', $recom_ids);
				$ttwo = $objMember->where(array('recom_msn' => array('in', $recom_id)))->select();
			}
			foreach ($ttwo as $i => $val) {
				$ttwo[$i]['family'] = 2;
			}

			// 获取该用户的第三代下属
			foreach ($ttwo as $t) {
				$recom_ids_two[] = $t['msn'];
			}

			if (!empty($recom_ids_two)) {
				$recom_id_two = implode(',', $recom_ids_two);
				$tthree = $objMember->where(array('recom_msn' => array('in', $recom_id_two)))->select();
			}
			foreach ($tthree as $g => $val) {
				$tthree[$g]['family'] = 3;
			}

			//todo 优化点：不使用数组分页
			if ($ttwo || $tthree) {
				$arrayData = array_merge($oone, $ttwo, $tthree);
			} else {
				$arrayData = $oone;
			}
			$arrCount = count($arrayData);//得到数组元素个数
			$Page = new \Think\Page($arrCount, 20);// 实例化分页类 传入总记录数和每页显示的记录数
			$arrayData = array_slice($arrayData, $Page->firstRow, $Page->listRows);
			$show = $Page->show();// 分页显示输出﻿
//		$this->paginate = $paginate;
			$this->page = $show;
			$this->arrayData = $arrayData;
			$this->display(C('DEFAULT_TPL') . '/MemberPointList');
		}
	}

	public function pointInfo(){
		$getMsn = I('get.msn');
		$objPoint = M('member_point');
		//获取当前用户积分列表
		$aimPointList = $objPoint->where('msn="'.$getMsn.'"')->select();
		foreach($aimPointList as $key => $val) {
			$goalPointList[$key] = $val;
			$goalPointList[$key]['addtime'] = date('Y-m-d H:i:s', $val['addtime']);
			if ($val['change_type'] == 1) {
				$changeType = "定向消费积分";
			} else {
				$changeType = "积分";
			}
			if ($val['op_type'] == 1) {
				$opType = "+";
			} else {
				$opType = "-";
			}
			$goalPointList[$key]['change_type'] = $changeType;
			$goalPointList[$key]['op_type'] = $opType;
		}
		$this->goalPointList = $goalPointList;
		$this->display(C('DEFAULT_TPL').'/MemberPointInfo');
	}

	private function selectUser($memMsn){
		$model = M('member');
		$memModel = M('member');
		$mem = $memModel->where("msn='$memMsn'")->find();
		$oone = $model->where("recom_msn='" . $mem['msn'] . "'")->select();

		// 获取该用户的第二代下属
		foreach ($oone as $o) {
			$recom_ids[] = $o['msn'];
		}

		if (!empty($recom_ids)) {
			$recom_id = implode(',', $recom_ids);
			$ttwo = $model->where(array('recom_msn' => array('in', $recom_id)))->select();
		}
		//recom_msn
		// 获取该用户的第三代下属
		foreach ($ttwo as $t) {
			$recom_ids_two[] = $t['msn'];
		}

		if (!empty($recom_ids_two)) {
			$recom_id_two = implode(',', $recom_ids_two);
			$tthree = $model->where(array('recom_msn' => array('in', $recom_id_two)))->select();
		}
		$select = array();
		foreach ($oone as $v) {
			$v['level'] = 1;
			$select[] = $v;
		}
		foreach ($ttwo as $v) {
			$v['level'] = 2;
			$select[] = $v;
		}
		foreach ($tthree as $v) {
			$v['level'] = 3;
			$select[] = $v;
		}

		return $select;
	}

	//修改密码
	public function changePwd(){
		if(!IS_POST){
			$this->display(C('DEFAULT_TPL') . '/MemberChangePwd');
		}else{
			$objMem = D('member');
			$msn = session('msn');
			if(!$msn){
				$this->error('用户编号异常',U('Public/login'),1);
			}
			$memInfo = $objMem->where('msn="'.$msn.'"')->find();
			if(!$memInfo){
				$this->error('用户未找到');
			}
			$oldPwd = pwdProcess(I('post.oldPwd'));
			$pwd = I('post.pwd');
			$rePwd = I('post.rePwd');
			if($oldPwd != $memInfo['pwd']){
				$this->error('原密码不正确');
			}
			if($pwd != $rePwd){
				$this->error('两次密码输入不一致');
			}else{
				$data['pwd'] = pwdProcess($pwd);
				$result = $objMem->where('msn="'.$msn.'"')->setField($data);
				if($result !== false){
					session(null);
					$this->success('密码修改成功',U('Public/login'),1);
				}
			}
		}
	}

}
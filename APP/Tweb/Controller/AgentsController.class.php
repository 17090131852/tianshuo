<?php
namespace Tweb\Controller;

use Think\Controller;

class AgentsController extends BaseController{

	public function _initialize(){
		//返回轮播图资源
		$objCommend = M('commends');
		$objResource = M('resources');
		$commendStatus = $objCommend->where('location = "个人中心"')->find();
		$resourceList = $objResource->where('resource_id="'.$commendStatus['id'].'"')->select();
		$this->resourceList = $resourceList;
	}

	public function index(){
		$this->display(C('DEFAULT_TPL') . '/AgentsIndex');
	}

	//家谱树
	public function family(){
		$memMsn = session('msn');
		$model = M('member');
		$memInfo = $model->where("msn='$memMsn'")->find();
		$post = array_filter($_POST);
		if ($post) {
			$count = count($post);
			if ($count > 0) {
				$array = $this->selectUser($memMsn);
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
				$this->display(C('DEFAULT_TPL') . '/AgentFamily');
			}
		}else {
			//获取该用户的第一代的下属
			$oone = $model->field('mid,mobile_phone,recom_id,nickname,reg_time,recom_msn,msn')->where("recom_msn='" . $memInfo['msn'] . "'")->select();

			// 获取该用户的第二代下属
			foreach ($oone as $o) {
				$recom_ids[] = $o['msn'];
			}

			if (!empty($recom_ids)) {
				$recom_id = implode(',', $recom_ids);
				$ttwo = $model->field('mid,mobile_phone,recom_id,nickname,reg_time,recom_msn,msn')->where(array('recom_msn' => array('in', $recom_id)))->select();
			}

			// 获取该用户的第三代下属
			foreach ($ttwo as $t) {
				$recom_ids_two[] = $t['msn'];
			}

			if (!empty($recom_ids_two)) {
				$recom_id_two = implode(',', $recom_ids_two);
				$tthree = $model->field('mid,mobile_phone,recom_id,nickname,reg_time,recom_msn,msn')->where(array('recom_msn' => array('in', $recom_id_two)))->select();
			}

			$this->memInfo = $memInfo;
			$this->oone = $oone;
			$this->ttwo = $ttwo;
			$this->tthree = $tthree;
			$this->display(C('DEFAULT_TPL') . '/AgentFamily');
		}
	}

	private function selectUser($memMsn){
		$model = M('member');
		$memModel = M('member');
		$mem = $memModel->where("msn='$memMsn'")->find();
		$oone = $model->field('mid,mobile_phone,recom_id,nickname,reg_time,recom_msn,msn')->where("recom_msn='" . $mem['msn'] . "'")->select();

		// 获取该用户的第二代下属
		foreach ($oone as $o) {
			$recom_ids[] = $o['msn'];
		}

		if (!empty($recom_ids)) {
			$recom_id = implode(',', $recom_ids);
			$ttwo = $model->field('mid,mobile_phone,recom_id,nickname,reg_time,recom_msn,msn')->where(array('recom_msn' => array('in', $recom_id)))->select();
		}
		//recom_msn
		// 获取该用户的第三代下属
		foreach ($ttwo as $t) {
			$recom_ids_two[] = $t['msn'];
		}

		if (!empty($recom_ids_two)) {
			$recom_id_two = implode(',', $recom_ids_two);
			$tthree = $model->field('mid,mobile_phone,recom_id,nickname,reg_time,recom_msn,msn')->where(array('recom_msn' => array('in', $recom_id_two)))->select();
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


	public function editAddress()
	{
		if (I('get.id')) {
			$id = I('get.id');
			$model = M('address');
			$address = $model->where("id=$id")->find();
			$this->address = $address;
			$this->display('Tpl/Member/editAddress');
		} else {
			$this->display('Tpl/Member/editAddress');
		}

	}

	public function addressSave()
	{
		if (IS_POST) {
			$id = (int)$_POST['id'];
			$data['tel'] = I('post.tel');
			$data['realname'] = I('post.realname');
			$data['province'] = I('post.province');
			$data['city'] = I('post.city');
			$data['county'] = I('post.county');
			$data['address'] = I('post.address');
			$model = M('address');
			if ($id > 0) {
				$data['utime'] = time();
				$model->where("id=$id")->save($data);
			} else {
				$data['ctime'] = time();
				$data['mid'] = session('mid');
				$model->add($data);
			}
			$this->redirect('Agents/address', '保存成功', 2);  //跳转方法
		}
	}

	public function deleteAddress()
	{
		$id = (int)$_GET['id'];
		if ($id > 0) {
			$mid = session('mid');
			$model = M('address');
			$res = $model->where("id=$id and mid=$mid")->delete();
			if ($res) {
				$this->success('删除成功', '', 1);  //跳转方法
			} else {
				$this->error('删除失败', '', 1);  //跳转方法
			}
		}
	}
	//历史订单-针对线下传数据的订单
	public function order()
	{
		$memMsn = session('msn');
		$addressModel = M('member');
		$mem = $addressModel->where("msn='$memMsn'")->find();
		$model = M('offline_order');
		if (IS_POST) {
			$sql = " msn='" . $mem['msn'] . "'";
			if (($order_sn = I('post.order_sn'))) {
				$sql .= " and order_sn='$order_sn'";
				$this->order_sn = $order_sn;
			}
			if (($sta = I('post.sta'))) {
				$sql .= " and sta=$sta";
				$this->sta = $sta;
			}

			$orderList = $model->where($sql)->select();
			$this->orderList = $orderList;
			$this->display(C('DEFAULT_TPL') . '/AgentOrder');
		} else {
			$orderList = $model->where(" msn='" . $mem['msn'] . "'")->select();
			$this->orderList = $orderList;
			//$this->display("Tpl/Member/order");
			$this->display(C('DEFAULT_TPL') . '/AgentOrder');
		}

	}

	public function downOrder()
	{

		$res = $this->downWeek();

		foreach ($res as $k => $v) {
			$overtime = explode('-', $v['time']);
			if (strtotime($overtime[0]) < strtotime("2017/3/1")) {

				unset($res[$k]);
			}
		}
		$this->orderList = $res;
		$this->display("Tpl/Member/downOrder");
	}

	public function downOrderDay()
	{
		$time = I('get.time');
		$time = explode('-', $time);
		$begintime = strtotime($time[0]);
		$overtime = strtotime($time[1]) + 24 * 60 * 60 - 20;

		$mid = session('mid');
		$addressModel = M('member');
		$mem = $addressModel->where("mid=$mid")->find();//查询自己的msn

		$model = M('offline_order');
		//第一代
		$oone = $model->where(array('recom' => array('eq', $mem['msn']), 'ctime' => array('between', "$begintime,$overtime")))->order("id desc")->select();
		// 获取该用户的第二代下属
		foreach ($oone as $o) {
			$recom_ids[] = $o['msn'];
		}
		if (!empty($recom_ids)) {
			$recom_id = implode(',', $recom_ids);
			$ttwo = $model->where(array('recom' => array('in', $recom_id), 'ctime' => array('between', "$begintime,$overtime")))->order("id desc")->select();
		}

		// 获取该用户的第三代下属
		foreach ($ttwo as $t) {
			$recom_ids_two[] = $t['msn'];
		}
		if (!empty($recom_ids_two)) {
			$recom_id_two = implode(',', $recom_ids_two);
			$tthree = $model->where(array('recom' => array('in', $recom_id_two), 'ctime' => array('between', "$begintime,$overtime")))->order("id desc")->select();
		}
		$list = array();
		foreach ($oone as $v) {
			$v['level'] = '第一代';
			$list[] = $v;
		}
		foreach ($ttwo as $v) {
			$v['level'] = '第二代';
			$list[] = $v;
		}
		foreach ($tthree as $v) {
			$v['level'] = '第三代';
			$list[] = $v;
		}
		$this->list = $list;
		$this->display("Tpl/Member/downOrderDay");
	}

	private function downWeek($p = 1, $page = 10)
	{ //$p第一页         $page一页为10条数据
		$mid = session('mid');
		$addressModel = M('member');
		$mem = $addressModel->where("mid=$mid")->find();//查询自己的msn

		$model = M('offline_order');
		$begintime = time();
		$page *= 7;
		$overtime = strtotime("-$page day");
		//第一代
		$oone = $model->where(array('recom' => array('eq', $mem['msn']), 'ctime' => array('between', "$overtime,$begintime")))->order("id desc")->select();

		// 获取该用户的第二代下属
		foreach ($oone as $o) {
			$recom_ids[] = $o['msn'];
		}
		if (!empty($recom_ids)) {
			$recom_id = implode(',', $recom_ids);
			$ttwo = $model->where(array('recom' => array('in', $recom_id), 'ctime' => array('between', "$overtime,$begintime")))->order("id desc")->select();
		}

		// 获取该用户的第三代下属
		foreach ($ttwo as $t) {
			$recom_ids_two[] = $t['msn'];
		}
		if (!empty($recom_ids_two)) {
			$recom_id_two = implode(',', $recom_ids_two);
			$tthree = $model->where(array('recom' => array('in', $recom_id_two), 'ctime' => array('between', "$overtime,$begintime")))->order("id desc")->select();
		}

		$orderList = array();

		$begintime = time();
		$overtime = strtotime("-7 day");
		$o = 1;
		while ($o <= 7) {
			$onesum = 0;
			foreach ($oone as $v) {
				if ($v['ctime'] > $overtime && $v['ctime'] < $begintime) {
					$onesum += $v['total'];
				}
			}
			$twosum = 0;
			foreach ($ttwo as $v) {
				if ($v['ctime'] > $overtime && $v['ctime'] < $begintime) {
					$twosum += $v['total'];
				}
			}
			$tthreesum = 0;
			foreach ($tthree as $v) {
				if ($v['ctime'] > $overtime && $v['ctime'] < $begintime) {
					$tthreesum += $v['total'];
				}
			}
			$orderList[$o] = array('time' => date('Y/m/d', $overtime) . '-' . date('Y/m/d', $begintime), 'onesum' => $onesum, 'twosum' => $twosum, 'threesum' => $tthreesum);
			$o++;
			$begintime = $overtime;
			$overtime -= 7 * 24 * 60 * 60;
		}
		return $orderList;


	}

	/**
	 * 数据统计
	 */
	public function report()
	{
		$msn = $this->getMsn();

		$this->assign('recom_msn ', $msn);
		//$this->display('Tpl/Agents/report');
		$this->display(C('DEFAULT_TPL') . '/AgentReport');
	}

	/**
	 * 查询本月小组消费情况 已超过规定奖励积分的小组
	 */
	public function consumedView()
	{
		$beginThismonth = mktime(0, 0, 0, date('m'), 1, date('Y'));
		$endThismonth = mktime(23, 59, 59, date('m'), date('t'), date('Y'));
		$recom_msn = $this->getMsn();
		$cond = array('1=1');

		$group_id = $this->request('group_id', 'int', 0);
		if ($group_id) {
			$cond[] = "`group`='$group_id'";
		}
		//统计周期 按月
		$cond[] = "ctime between '$beginThismonth' and '$endThismonth'";

		$member = D('member');
		$data = $member->consumedDetial($cond, $recom_msn);

		$this->assign('data', $data);
		$this->display('Tpl/AgentsConsumedView');

	}

	/**
	 * 订单详情 下属人员
	 */
	public function orderview()
	{
		$cond_offline = $cond_order = array('1=1');
		$msn = $this->request('msn', 'string', '');
		$mid = $this->request('mid', 'int', 0);

		if (!empty($msn)) {
			$cond_offline[] = "msn = '$msn'";
		}

		if ($mid) {
			$cond_order[] = "msn = '$msn'";
		}

		$order = D('order');
		$data = $order->getOrderByMsn($cond_offline, $cond_order);

		$this->assign('data', $data);
		$this->display('Tpl/AgentsOrderview');
	}

	/**
	 * 人员详情 下属人员
	 */
	public function memberview()
	{
		$cond = array('1=1');
		$msn = $this->request('msn', 'string', '');

		if (!empty($msn)) {
			$cond[] = "msn = '$msn'";
		}


		$member = D('member');
		$data = $member->getMemberBymsn($cond);
//print_r($data);exit;
		$this->assign('data', $data);
		$this->display('Tpl/AgentsMemberview');
	}

	/*积分消费历史订单
	public function orderList()
	{  // no  page
		$memMsn = session('msn');
		$Model = M('order');
		if (IS_POST) {
			$pay_status = I("post.pay_status");
			$this->pay_status = $pay_status;
			if ($pay_status == 3) {
				$orderList = $Model->where("msn='$memMsn'")->select();//查询自己的msn
				$this->orderList = $orderList;
				$this->display(C('DEFAULT_TPL') . '/AgentOrderList');
			} else {
				$orderList = $Model->where("msn='$memMsn' and pay_status=$pay_status")->select();//查询自己的msn
				$this->orderList = $orderList;
				$this->display(C('DEFAULT_TPL') . '/AgentOrderList');
			}
		} else {
			$orderList = $Model->where("msn='$memMsn'")->select();//查询自己的msn
			$this->orderList = $orderList;
			$this->display(C('DEFAULT_TPL') . '/AgentOrderList');
		}


	}
	*/

	//下属个人详情
	public function familyInfo(){
		$msn = session('msn');
		$getMsn = I('get.msn');
		$model = M('member');
		if(!$getMsn){
			$memInfo = $model->where('msn="'.$msn.'"')->find();
		}else{
			$memInfo = $model->where('msn="'.$getMsn.'"')->find();
		}
		$createTime = date("Y-m-d H:i:s",strtotime($memInfo['reg_time']));
		$memInfo['reg_time'] = $createTime;
		switch($memInfo['origin']){
			case 0: $memInfo['origin'] = "自行注册";break;
			case 1: $memInfo['origin'] = "升级";break;
			case 2: $memInfo['origin'] = "推荐";break;
		}
		$this->memInfo = $memInfo;
		$this->display(C('DEFAULT_TPL').'/AgentFamilyInfo');
	}

	//线下订单详情
	public function orderInfo(){
		$msn = session('msn');
		$getOrder_sn = I('get.orderSn');
		$objOrder = M('offline_order');
		$orderInfo = $objOrder->where('order_sn="'.$getOrder_sn.'"')->find();
		$orderInfo['ctime'] = date('Y-m-d H:i:s',$orderInfo['ctime']);
		$this->orderInfo = $orderInfo;
		$this->display(C('DEFAULT_TPL').'/AgentOrderInfo');
	}
}
<?php 
/*
* 自定义用户密码规则
* @param string MD5字符串
* @return string 处理后的密码
* @规则：MD5加密后前去4后去3，再Md5加密
*/
function pwdProcess($pwd){
	$md5Pwd = md5($pwd);
	$pwdTem = substr($md5Pwd,4,25);
	$pwdFinal = md5($pwdTem);
	return $pwdFinal;
}

//获取树状结构
function getTree($list, $parent_id, $level=0){
	static $tree = array();//保存找到的分类的数组
	//遍历所有分类，通过parent_id判断，哪些是我们正在查找parent_id的
	foreach($list as $row) {
		//判断当前所遍历的分类$row, 是否是当前需要查找的子分类
		if($row['pid'] == $parent_id) {
			//找到了一个分类
			//存起来，存哪?
			$row['level'] = $level;
			$tree[] = $row;
			//继续查找当前$row所代表的分类的子分类
			getTree($list, $row['id'], $level+1);
		}
	}
	return $tree;
}
//1、充值；2、线上订单；3、线下订单
function getPointType($sta){
	switch($sta){
		case 1:
			return '充值';
			break;
		case 2:
			return '积分商城订单';
			break;
		case 3:
			return '汽车超市订单';
			break;
	}
}
//后台:转换状态值
function getSta($sta){
	switch($sta){
		case 1:
			return '<span style="color:green">正常</span>';
			break;
		case 2:
			return '<span style="color:orange">异常</span>';
			break;
		case 3:
			return '<span style="color:red">封禁</span>';
			break;
		default:
			return '<span style="color:black">未知</span>';
			break;
	}
}

//删除状态
function getDel($status){
    switch($status){
        case 0:
            return '未删除';
            break;
        case 1:
            return '已删除';
            break;
    }
}

//提现状态  1、已提交  2、审核失败 3、审核成功；4、打款失败；5、打款成功
function getPlayState($sta){
	switch($sta){
		case 1:
			return '已提交';
			break;
		case 2:
			return '审核失败';
			break;
		case 3:
			return '审核成功';
			break;
		case 4:
			return '打款失败';
			break;
		case 5:
			return '打款成功';
			break;
	}
}
//个人中心:转换会员类型值
function getMemType($type){
	switch($type){
		case 1:
			return '众筹股东';
			break;
		case 2:
			return '总代理';
			break;
		case 3:
			return 'VIP会员';
			break;
		case 4:
			return '普通会员';
			break;
		default:
			return '未知';
			break;
	}
}

//订单状态
function getOrderStatus($status){
    switch($status){
        case 0:
            return '未付款';
            break;
        case 1:
            return '已付款';
            break;
        case 2:
            return '已关闭';
            break;
    }
}

//订单配送状态
function getOrderShippingStatus($status){
    switch($status){
        case 0:
            return '未发货';
            break;
        case 1:
            return '已发货';
            break;
        case 2:
            return '已确认收货';
            break;
    }
}

/**佣金提现状态 状态 0、未申请 1、已提交  2、已审核 3、已支付
 * @param $state
 * @return string
 */
function getCommState($state){
    switch($state){
        case 0:
            return '未申请';
            break;
        case 1:
            return '已提交';
            break;
        case 2:
            return '已审核';
            break;
        case 3:
            return '已支付';
            break;
    }
}
/**得到商品积分 根据商品编号
 * @param $goods_code
 * @return int
 */
function getGoodsScore($goods_code){
    if(empty($goods_code)) return 0;
    $model = M('goods');
    $data = $model->field('goods_price')->where("goods_code='{$goods_code}'")->find();

    return empty($data) ? 0 : $data['goods_price'];
}

/**得到分类名称，根据分类id
 * @param $id
 * @return string
 */
function getCategoryName($id){
    if(!$id) return '未设置分类';
    $model = M('category');
    $data = $model->field('title')->where("id='{$id}'")->find();

    return empty($data) ? '未设置分类':$data['title'];
}
//获取一个用户所属组
function getUserGroups($uid){
	$arr_groups = M('auth_group_access')->field('group_id')->where(['uid'=>$uid])->select();
		foreach ($arr_groups as $k => $val) {
			$temp = M('auth_group')->field('title')->where(['id'=>$val['group_id']])->find();
			$group_title[$k] = $temp['title'];
		}
	$str_titles = implode($group_title, ' | ');
	return $str_titles;
}

//根据组ID返回组名
function getGroupTitle($group_id){
	$item = M('auth_group')->field('title')->where(['id'=>$group_id])->find();
	return $item['title'];
}

//根据组mid返回昵称
function getNickname($mid){
	$item = M('member')->field('nickname')->where(['mid'=>$mid])->find();
	return $item['nickname'];
}
//根据msn返回用户类型
function getMemberType($msn){
	$item = M('member')->field('msn,type')->where(['msn'=>$msn])->find();
	return $item['type'];
}

//
function getLevel($level) {
	$array = array(1=>'第一代',2=>'第二代',3=>'第三代');
	return $array[$level];
}

function getSex($sex) {
	$arr = array(1=>'男',2=>'女');
	return $arr[$sex];
}

//随机字符串
function randStr($len=25, $format=1) {
	switch ($format) {
		case 1:		//所有字符
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			break;
		case 2:		//大小写字母
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
			break;
		case 3:		//数字
			$chars = '0123456789';
			break;
		default :
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			break;
	}
	$rsStr = "";
	$count=strlen($chars);
	for($i=1;$i<=$len;$i++){
		$rsStr.=substr($chars,rand(0,$count-1),1);
	}
	return $rsStr;
}
//生成线下订单号
function createOfflineOrder(){
	$orderNum = 'OFL'.randStr(7,2).randStr(6,3);
	return $orderNum;
}
//获取线下订单状态
function getOfflineOrderSta($sta) {
	$arr = array(1=>'正常',2=>'封禁',3=>'异常');
	return $arr[$sta];
}

//截取字符串
function msubstr($str, $start=0, $length, $suffix=true, $charset="utf-8") {
	if(function_exists("mb_substr"))
		$slice = mb_substr($str, $start, $length, $charset);
	elseif(function_exists('iconv_substr')) {
		$slice = iconv_substr($str,$start,$length,$charset);
		if(false === $slice) {
			$slice = '';
		}
	}else{
		$re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		preg_match_all($re[$charset], $str, $match);
		$slice = join("",array_slice($match[0], $start, $length));
	}
	return $suffix ? $slice.'...' : $slice;
}

// 获取订单编号
function getOrderSnById($id=0){
	if(!$id) return '无';

	$order = M('order')->field('order_sn')->where("id='$id'")->find();
	if(empty($order)){
		return '无';
	}

	return $order['order_sn'];
}
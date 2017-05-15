<?php
namespace Tweb\Biz;

class Wechatwalls{
	/**
	 *  发布到微信墙
	 * @return [type] [description]
	 */
	static public function publish($id){
		M("wechat_wall")->where("id='{$id}'")->save(array('state'=>1,'createtime'	=>	date("Y-m-d H:i:s")));
	}

	static public function sendmsg($user,$msg){
		$wall = M("wechat_wall");
		$data = array(
			'openid'	=>	$user['openid'],
			'face'		=>	$user['headimgurl'],
			'username'	=>	$user['nickname'],
			'msg'		=>	$msg,
			'createtime'	=>	date("Y-m-d H:i:s"),
			'state'			=> 0,
		);
		$wall->add($data);
	}

	static public function get($datetime){
		$result = M("wechat_wall")->where("createtime > '{$datetime}' and state = 1")->order("createtime asc")->limit(5)->select();
		if(!$result) $result = array();
		return $result;
	}

	static public function signin($user=array()){
		$map['openid']   = $user['openid'];
		$map['act_type'] = 1;
		//判断该用户是否已签到
		$sign_user = M('wechat_signin')->where($map)->find();
		if($sign_user){
			return false;
		}

		$wall = M("wechat_signin");
		$data = array(
			'openid'     =>	$user['openid'],
			'username'   =>	$user['nickname'],
			'face'       =>	$user['headimgurl'],
			'act_type'   =>	1,
			'is_win'     => 0,
			'createtime' =>	date("Y-m-d H:i:s"),
		);
		$wall->add($data);
	}

}
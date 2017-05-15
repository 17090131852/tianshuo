<?php
namespace Tweb\Controller;
use Think\Controller;
use Tweb\Biz\Member;
//引入配置文件
include_once ROOT_PATH.'/Public/LaneWeChat/config.php';
//引入自动载入函数
include_once ROOT_PATH.'/Public/LaneWeChat/autoloader.php';

//调用自动载入函数
\LaneWeChat\AutoLoader::register();

class WxController extends Base{

	public function index(){
		$member              = M("member"); // 实例化MEMBER对象
        $member->all_score   = $score;
        $member->leave_score = $score;
        $member->acount_sta  = 2;
        $member->where("mid='{$mid}'")->save(); // 根据条件更新记录
        echo $member->getLastSQL();
        exit;
		exit;
	}

	public function login(){
		$openId = $_GET['id'];
		$REDIRECT_URI='http://ts.jomon.cc/wx/wall?id='.$openId;
		$scope='snsapi_base';
		//$scope='snsapi_userinfo';//需要授权
		$url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.WECHAT_APPID.'&redirect_uri='.urlencode($REDIRECT_URI).'&response_type=code&scope='.$scope.'&state='.$state.'#wechat_redirect';
		header("Location:".$url);
	}

	public function wall(){
		$openId = $_GET['id'];
		if(!isset($_SESSION['wechat'])){
			$accessToken = \LaneWeChat\Core\AccessToken::getAccessToken();
			file_put_contents(ROOT_PATH."token.log", $accessToken."\r\n",FILE_APPEND);
			$openId = $_GET['id'];
			$userinfo = \LaneWeChat\Core\UserManage::getUserInfo($openId);
			echo "<!--",$accessToken;
			print_r($userinfo);
			echo "-->";
			$_SESSION['wechat'] = $userinfo;
		}
		 
		if(!empty($openId)){
			$map['openid']   = $openId;
			$map['act_type'] = 1;
			//判断该用户是否已签到
			$sign_user = M('wechat_signin')->where($map)->find();
			if($sign_user){
				$this->redirect('/Wx/news');
			}
		}
		$userinfo = $_SESSION['wechat'];
		$this->assign('user',$userinfo);
	}

	public function news(){

	}

	public function getMsgs(){

		$msg = new \Tweb\Biz\Wechatwalls();
		$time = $_GET['datetime'];
		$time = $time ?:date("Y-m-d"." 00:00:00");
		$rs = $msg->get($time);
		echo json_encode($rs);
	}

	public function sendmsg(){
		if(!$_SESSION['wechat']) {
			echo "请使用微信登录";
			exit;
		}

		$msg = new \Tweb\Biz\Wechatwalls();
		$user = $_SESSION['wechat'];
		$msgs = $_GET['msg'];
		$msg->sendmsg($user,$msgs);
	}

	public function timetable(){

	}

	public function signin(){
		$openid = $_SESSION['wechat']['openid'];
		if(empty($openid)){
			json_encode('请用微信登录');
		}
		//插入签到表
		$signin = new \Tweb\Biz\Wechatwalls();
		$user = $_SESSION['wechat'];
		$signin->signin($user);
		json_encode(1);
	}

	public function MsgSend(){
		
	}
}
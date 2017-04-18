<?php
namespace Tweb\Controller;
use Think\Controller;
class PublicController extends Controller {
	//登录方法
	public function login(){
		$objEntry = M('entry');
		$entryStatus = $objEntry->select();
		$this->entryStatus = $entryStatus;
		if(session('msn')){
			$this->redirect('/Tweb/Member/index');
		}
		
		if(!IS_POST){
			$this->display(C('DEFAULT_TPL').'/PublicLogin');
		}else{
			$login_number = I('post.login_number');
			$pwd = pwdProcess(I('post.pwd'));
			$tcode = I('post.tcode');

			$verify = new \Think\Verify();
			$isCheck = $verify->check($tcode);
//
			if(!$isCheck){
				$this->error('图形验证码错误!','',1);
			}

//			if(!preg_match('/^1[34578]{1}\d{9}$/',$login_number)){
//				$this->error('手机号格式错误!','',1);
//			}

			$rule['mobile_phone'] = $login_number;
			$rule['msn'] = $login_number;
			$rule['_logic'] = 'OR';
			$item = M('member')->field('mid,pwd,nickname,msn')->where($rule)->find();
			if(empty($item)){
				$this->error('用户不存在！','',1);
			}

			if($pwd === $item['pwd']){
				session('mid',$item['mid']);
				session('nickname',$item['nickname']);
				session('msn',$item['msn']);
				$this->redirect(__APP__.'/../Member/index');
			}else{
				$this->error('密码错误！','',1);
			}
		}
	}
	
	//图片验证码
	public function webVerify(){
		$Verify = new \Think\Verify();
		
		$Verify->imageW = 80;
		$Verify->imageH = 32;
		$Verify->fontSize = 12;
		$Verify->length = 4;
		$Verify->useNoise = false;
		$Verify->fontttf = '4.ttf';
		$Verify->entry();
	}
	
	//注册
	public function register(){
		if(!IS_POST){
			$this->recomMobile = cookie('recom_mobile');
			$this->display(C('DEFAULT_TPL').'/PublicRegister');
		}else{
			$recom_mobile = I('post.recom_mobile');
			$model = M('member');
			//手机号格式检测
			if(!preg_match('/^1[34578]{1}\d{9}$/',I('post.mobile_phone'))){
				$this->error('注册手机格式错误！','',1);
			}
			//用户存在检测
			$exsistMember = $model->where('mobile_phone = "'.I('post.mobile_phone').'"')->count('mid');
			if($exsistMember){
				$this->error('用户已存在！','',1);
			}
			//空密码检测
			if(strlen(I('post.pwd')) < 6){
				$this->error('密码至少6位！','',1);
			}
			//两次密码相同检测
			if(I('post.pwd') != I('post.pwd1')){
				$this->error('两次输入密码不一致！','',1);
			}
			//自我推荐检测
			if(I('post.recom_mobile') == I('post.mobile_phone')){
				$this->error('不允许推荐自己！','',1);
			}
			//推荐人手机格式检测
			if(!preg_match('/^1[34578]{1}\d{9}$/',$recom_mobile)){
				$this->error('推荐人手机格式错误！','',1);
			}
			
			$where['mobile_phone'] = $recom_mobile;
			$recoms = $model->field('mid,msn,mobile_phone')->where($where)->find();
			
			if(empty($recoms)){
				$this->error('推荐人不存在！','',1);
			}else{
				//todo 临时过滤之前的测试字段，上线前修改
				$objMem = D('member');
//				$maxMsn = $objMem->field("max(msn)")->find();
				$maxMsn = $objMem->order('mid DESC')->find();
				if(!preg_match('/^\d{6,}$/',$maxMsn['msn'])){
					$data['msn'] = '000001';
				}else {
					$data['msn'] = str_pad($maxMsn['msn']+1,6,0,STR_PAD_LEFT);
				}
				$data['mobile_phone'] = I('post.mobile_phone');
				$data['pwd'] = pwdProcess(I('post.pwd'));
				$data['realname'] = "未设置";
				$data['recom_id'] = $recoms['mid'];
				$data['origin'] = 0;
				$data['recom_msn'] = $recoms['msn'];
				$data['recom_mobile'] = $recoms['mobile_phone'];

				$group = $objMem->getRegGroupId($recoms['mobile_phone'],$recoms['msn']);

				$data['group'] = $group;
				$data['reg_time'] = time();
				$data['type'] = 4;
			}
			if($model->create()){
				if($model->add($data)){
					@setcookie('recom_mobile',$recoms['mobile_phone'],time()+10*365*24*60*60,'/');
					$this->success('注册成功！',U('Public/login'),1);
				}
			}else{
				$this->error($model->getError(),'',1);
			}
		}
	}
	
	//退出
	public function logout(){
		session('mid',null);
		session('msn',null);
		session('nickname',null);
		$this->redirect(__APP__.'/Public/Login');
	}

	//添加种子用户
	public function addSeed(){
		if(!IS_POST){
			$this->display(C('DEFAULT_TPL').'/PublicAddSeed');
		} else{
			//种子用户权限检测
			$objSeed = M('entry');
			$isSeed = $objSeed->where("en_name = 'seed'")->find();
			if($isSeed['status'] == 0){
				$this->error('当前阶段不允许注册为种子用户','',1);
			}
			$model = M('member');
			//手机号格式检测
			if(!preg_match('/^1[34578]{1}\d{9}$/',I('post.mobile_phone'))){
				$this->error('注册手机格式错误！','',1);
			}
			//用户存在检测
			$exsistMember = $model->where('mobile_phone = "'.I('post.mobile_phone').'"')->count('mid');
			if($exsistMember){
				$this->error('用户已存在！','',1);
			}
			//空密码检测
			if(strlen(I('post.pwd')) < 6){
				$this->error('密码至少6位！','',1);
			}
			//两次密码相同检测
			if(I('post.pwd') != I('post.pwd1')){
				$this->error('两次输入密码不一致！','',1);
			}
			//todo 临时过滤之前的测试字段，上线前修改
			$objMem = D('member');
//				$maxMsn = $objMem->field("max(msn)")->find();
			$maxMsn = $objMem->order('mid DESC')->find();
			if(!preg_match('/^\d{6,}$/',$maxMsn['msn'])){
				$data['msn'] = '000001';
			}else {
				$data['msn'] = str_pad($maxMsn['msn']+1,6,0,STR_PAD_LEFT);
			}
			$data['mobile_phone'] = I('post.mobile_phone');
			$data['pwd'] = pwdProcess(I('post.pwd'));
			$data['origin'] = 0;
			$data['type'] = I('post.type');
			$data['nickname'] = I('post.nickname');
			$data['realname'] = "未设置";
			$data['is_seed'] = 1;
			$data['acount_sta'] = 1;
			$data['reg_time'] = time();

			if($model->create()){
				if($model->add($data)){
					$this->success('注册成功！',U('Public/login'),1);
				}
			}else{
				$this->error($model->getError(),'',1);
			}
		}
	}

	//todo 没有短信验证，暂时不开放
	//忘记密码
	public function forgot(){
		if(!IS_POST){
			$this->error('功能暂未开放',U('Public/login'),1);
			$this->display(C('DEFAULT_TPL') . '/PublicForgot');
		}else{
			$objMem = D('member');
			$loginNum = I('post.loginNum');
			if(!$loginNum){
				$this->error('用户编号异常',U('Public/login'),1);
			}
			$rule['mobile_phone'] = $loginNum;
			$rule['msn'] = $loginNum;
			$rule['_logic'] = 'OR';
			$memInfo = $objMem->where($rule)->find();
			if(!$memInfo){
				$this->error('用户未找到');
			}
			$pwd = I('post.pwd');
			$rePwd = I('post.rePwd');
			if($pwd != $rePwd){
				$this->error('两次密码输入不一致');
			}else{
				$data['pwd'] = pwdProcess($pwd);
				$result = $objMem->where($rule)->setField($data);
				if($result !== false){
					session(null);
					$this->success('密码修改成功',U('Public/login'),1);
				}
			}
		}
	}
}
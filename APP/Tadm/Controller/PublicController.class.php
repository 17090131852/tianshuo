<?php
namespace Tadm\Controller;
use Think\Controller;
/**
* 公用控制器，登录，验证码之类的
*/
class PublicController extends Controller
{

	//管理员登录
	public function login(){
		if(!IS_POST){
			$this->display(C('DEFAULT_TPL').'/login');
		}else{
			if(!$this->check_verify(I('post.admVer'))){
				$this->error('验证码错误!','',1);
			}else{
				$uInfo = M('User')->where('uname="'.I('post.uname').'"')->find();	//获取用户数据
				//dump($uInfo);exit;
				if(!is_array($uInfo)){
					$this->error('用户不存在!',U('Public/login'),1);
				}else{
					if($uInfo['pwd'] === pwdProcess(I('post.pwd'))){

						//更新登录信息
						$data['lastlogin'] = time();
						$data['lastip'] = get_client_ip();
						M('User')->where(['uid'=>$uInfo['uid']])->save($data);
						//记录SESSION
						session('admUid',$uInfo['uid']);
						session('admUname',$uInfo['uname']);
						session('stopTime',time());
						//跳回管理首页
						redirect(U('Index/Index'));
					}else{
						$this->error('密码错误!',U('Public/login'),1);
					}
				}
			}
		}
	}

    //检测验证码
	function check_verify($code, $id = ''){
		$verify = new \Think\Verify();
		return $verify->check($code, $id);
	}

	//后台登陆验证码
	public function admVerify(){
		$Verify = new \Think\Verify();

		//$Verify->useImgBg = true;
		$Verify->imageW = 120;
		$Verify->imageH = 35;
		$Verify->fontSize = 15;
		$Verify->length = 4;
		$Verify->useNoise = false;
		$Verify->useCurve = false;
		$Verify->fontttf = '4.ttf';
		$Verify->entry();
	}

//管理员登出
	public function logout(){
		//清理SESSION
		session('veryfi',null);
		session('admUid',null);
		session('admUname',null);
		//跳转登陆页
		redirect('/Tadm/Public/login');
	}
//管理员修改密码
	public function Editpwd(){
        if (!IS_POST) {
            $this->display(C('DEFAULT_TPL') . '/editpwd');
        } else {
            $user = D("user");
            $admUid = session('admUid');
            $admInfo = $user->where('uid="'.$admUid.'"')->find();
            if(!admInfo){
                $this->error('用户未找到');
            }
            $oldPwd = pwdProcess(I('post.oldPwd'));//旧密码
//            var_dump($oldPwd);
            $pwd = I('post.pwd'); //新密码
//            var_dump($pwd);die;
            $rePwd = I('post.rePwd'); //确认密码
            if($oldPwd != $admInfo['pwd']){
                $this->error('原密码不正确',"",1);
            }
            if($oldPwd == pwdProcess(I('post.pwd'))){
                $this->error('不能和原密码相同',"",1);
            }
            if($pwd != $rePwd){
                $this->error('两次密码输入不一致',"",1);
            }else{
                $data['pwd'] = pwdProcess($pwd);
                $res = $user->where('uid="'.$admUid.'"')->setField($data);
                if($res !== false){
                    $this->success('密码修改成功',U('Public/editpwd'),1);
                }
            }
        }
    }
}
 ?>
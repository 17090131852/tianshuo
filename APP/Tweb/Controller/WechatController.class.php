<?php
namespace Tweb\Controller;
use Think\Controller;
use Tweb\Biz\datefmt;
class WechatController extends Controller {
    //签到
    public function add(){
        if(!$_POST){
//            $this->display(C('DEFAULT_TPL').'/WechatAdd');
            $this->display(C('DEFAULT_TPL').'/Wechat/add');
        }else{
            $data['name'] = I('post.name');
            $data['tel'] = I('post.tel');
            $data['tel'] = substr_replace($data['tel'],'****',3,4);
            $data['sign_time'] = date("Y-m-d H:i:s",time());
//            var_dump($data);die;
            //手机号格式检测
            if(!preg_match('/^1[34578]{1}\d{9}$/',I('post.tel'))){
                $this->error('注册手机格式错误！','',1);
            }
            if($lastInsId = M("wechat")->add($data)){
                session("wx_id",$lastInsId);
                $this->success('签到成功！',U('Wechat/index'),1);
            }
        }
    }

    //添加用户输入的消息
    public function addUser(){
        $data['wx_id'] = $_SESSION['wx_id'];
        $data['contron'] = I("post.contron"); //发送的内容
        $data['add_time'] = date("Y-m-d H:i:s",time());
        M("wechat_add")->add($data);
        echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }


    //显示聊天信息
    public function index(){
        $data = M("wechat")->select();
        $res = M("wechat_add")->select();
        $this->data = $data;
        $this->res = $res;
        $this->display(C('DEFAULT_TPL').'/Wechat/index');
    }

    //开始抽奖
    public function cj(){
        $array = M("wechat")->field("wx_id")->where("ld_state = 0")->select();
//        var_dump($array);
        foreach ($array as $v) {
            $arr[$v['wx_id']] = $v['wx_id'];
        };
        $a = implode(",",array_rand($arr,10)); //随机取出10个
        $this->assign("a",$a);
    }

    //结束抽奖/查看中奖名单/并修改状态
    public function jscj(){
        $arr = I("post.data");
        $arr = implode(",",$arr);
        $sql = "select * from ts_wechat  where examine=1 and wx_id in ($arr)";
        $result = M()->query($sql);
        $this->assign("result",$result);
        $sql1 = "update ts_wechat set ld_state='1' where wx_id in ($arr)";
        $result = M()->query($sql1);
    }

}
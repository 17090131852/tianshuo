<?php
namespace Tadm\Controller;
class WallController extends Base
{
    /**
     * 消息列表
     */
    public function index()
    {
        $map             = array('1=1'); //条件数组
        $pagesize        = 10;
        $state    = $this->request('state', 'int', 0);    //审核状态 0未审核 1已审核
       
        if ($state) {
            $map['state'] = $state - 1;
        }
        

        $model = M('wechat_wall');
        $count = $model->where($map)->count();

        $Page = new \Think\Page($count, $pagesize);
        $show = $Page->show();

        $data = $model
            ->where($map)
            ->order('id asc')
            ->limit($Page->firstRow . ',' . $Page->listRows)->select();
//        echo $model->getLastSql();

        $this->state    = $state;
        $this->data            = $data;
        $this->page            = $show;
    }
    /**
     * 消息列表
     */
    public function winners()
    {
        $map['is_win']   = 1; //条件数组
        $map['is_win']   = 1; //条件数组
        $pagesize        = 10;
        $username    = $this->request('username', 'string', '');    //审核状态 0未审核 1已审核
       
        if ($username) {
            $map['username'] = array('like', $username . '%');
        }
        

        $model = M('wechat_signin');
        $count = $model->where($map)->count();

        $Page = new \Think\Page($count, $pagesize);
        $show = $Page->show();

        $data = $model
            ->where($map)
            ->order('id desc')
            ->limit($Page->firstRow . ',' . $Page->listRows)->select();
//        echo $model->getLastSql();

        $this->username = $username;
        $this->data     = $data;
        $this->page     = $show;
    }

    public function state(){
        $id = $this->get('id','int',0);

        $res = M("wechat_wall")->where("id='{$id}'")->save(array('state'=>1));
        if($res){
            $this->success('审核成功！', '/Tadm/Wall/index');
        }else{
            $this->error('审核失败！', '/Tadm/Wall/index');
        }

    }

}
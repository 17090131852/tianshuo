<?php
namespace Tadm\Controller;
use Common\Controller\BaseController;

class Ajaxcontroller extends Base
{

    /**
     * 得到分类
     */
    public function getCat()
    {
        $pid = $this->request('pid','int',0);

        $catobj = M('category');
        $cat = $catobj->field('id,pid,title')->where("pid='{$pid}'")->select();
        array_unshift($cat,array('id'=>0,'pid'=>0,'title'=>'请选择'));
        $this->ajaxReturn($cat,'JSON');
//        echo json_encode($cat);die;
    }
}
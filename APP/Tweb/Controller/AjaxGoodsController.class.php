<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 10:24
 */
namespace Tweb\Controller;
use Think\Controller;
use Tweb\Biz\Goods;

class AjaxGoodsController extends \Tweb\Controller\BaseController {
    /**
     * 得到不同等级的评论
     * @return [type] [description]
     */
    public function getCommentByLevel(){
        $cond[] = "is_pass='2'";
        $cond[] = "is_del='0'";
        
        $id       = $this->request('goods_id','int',0);
        $page     = $this->request('page','int',1);
        $pagesize = $this->request('pagesize','int',10);
        $type     = $this->request('type','int',0); //0 全部 1 好评 2 中评 3差评

        $cond[] = "goods_id='{$id}'";
        if($type){
            switch ($type) {
                case '1':
                    $cond[] = 'star>=9';
                    break;
                case '2':
                    $cond[] = 'star between 3 and 8';
                    break;
                case '3':
                    $cond[] = 'star<=2';
                    break;             
            } 
        }
        $Goods = new Goods();
        $data  = $Goods->getComment($cond,$page,$pagesize);

        echo json_encode($data);exit;
    }
}
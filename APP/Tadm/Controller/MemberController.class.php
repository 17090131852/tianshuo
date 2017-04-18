<?php
namespace Tadm\Controller;

use Common\Controller\BaseController;
use Tadm\Biz\Commission;
use Tadm\Biz\Member;
use Tadm\Biz\Levels;
use Tadm\Biz\MemberRechage;


/**
 *
 */
class MemberController extends BaseController
{

    //用户列表
    public function index()
    {
			$post = array_filter($_POST);
			if ($post) {
				$objMem = M('member');
				$where['msn'] = $post['msn'];
				$where['nickname'] = $post['nickname'];
				$where['mobile_phone'] = $post['mobile_phone'];
				$where['recom_mobile'] = $post['recom_mobile'];
				$where['type'] = $post['type'];
				$where['sta'] = $post['sta'];
				$where['_logic'] = 'OR';
				$memberList = $objMem->where($where)->select();
				$this->memberList = $memberList;
				$this->display(C('DEFAULT_TPL') . '/MemberIndex');
			}else {
				$model = M('member');
				$count = $model->count();
				$Page = new \Think\Page($count, 10);
				$show = $Page->show();
				$this->memberList = $model->field('mid,msn,mobile_phone,recom_id,recom_mobile,nickname,type,sta,acount_sta,reg_time')->order('mid desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
				$this->page = $show;
				$this->display(C('DEFAULT_TPL') . '/MemberIndex');
			}
    }

    //预约记录
    public function driveList()
    {

    }

    //待审核用户列表
    public function authstr()
    {
        $model          = M('member');
        $count          = $model->where("acount_sta=1")->count();
        $Page           = new \Think\Page($count, 3);
        $show           = $Page->show();
        $this->authstrs = $model->field('mid,mobile_phone,recom_id,recom_mobile,nickname,reg_time')->where("acount_sta=1")->order('mid desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->page     = $show;
        $this->display(C('DEFAULT_TPL') . '/authstr');
    }

    //待审核用户详细信息
    public function authstrDetail()
    {
        $mid           = I('get.mid');
        $this->memInfo = M('member')->where("mid=$mid")->find();
        $this->display(C('DEFAULT_TPL') . '/authstrDetail');
    }

    //通过一个用户的注册审核
//	public function pass(){
//		$mid = I('get.mid');
//		$is_ok = M('member')->where("mid=$mid")->save(array('acount_sta' => 2));
//		if($is_ok !== false){
//			$this->success('审核成功！',U('Member/authstr'),1);
//		}
//	}
    /**
     * 批量为用户充值
     */
    public function batchRecharge()
    {
        if (IS_POST) {
            $count = count($_FILES);
            if ($count >= 50) {
                $this->error('超出单次上传数量');
            }

            $upload           = new \Think\Upload();// 实例化上传类
            $upload->exts     = array('xls', 'xlsx');// 设置附件上传类型
            $upload->subName  = array('date', 'Y-m-d');
            $upload->rootPath = './Upload/Baobiao/'; // 设置附件上传根目录
            $upload->savePath = ''; // 设置附件上传（子）目录
            $now              = $_SERVER['REQUEST_TIME'];
            $upload->saveName = array('uniqid', $now);//上传文件的保存规则
            //上传文件
            $info = $upload->upload();
            if (!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            } else {
                Vendor("PHPExcel.Classes.PHPExcel");//引入phpexcel类
                Vendor("PHPExcel.Classes.PHPExcel.IOFactory");
                $all = [];
                foreach ($info as $val) {
                    $path        = $val['savepath'];
                    $filename    = $val['savename'];
                    $objPHPExcel = \PHPExcel_IOFactory::load('./Upload/Baobiao/' . $path . $filename);
                    $sheetData   = $objPHPExcel->getActiveSheet()->toArray(true, true, true, true);
//                    dump($sheetData);exit;
                    unset($sheetData[1], $sheetData[2]);
                    foreach ($sheetData as $value) {
                        if (empty($value['A'])) continue;
                        $recom = M('member')->where('msn="' . $value['A'] . '"')->find(); //根据表格推荐人编号，进行数据查询
                        if (empty($recom)) continue;

                        //查询用户信息
                        $memInfo = M('member')->where('mobile_phone="' . $value['D'] . '"')->find(); //用户手机号
                        if (!$memInfo) {
                            $member = new Member();
                            if ($value['C'] < 1000) {
                                $type = 4;
                            }
                            if ($value['C'] >= 1000 && $value['C'] < 10000) {
                                $type = 3;
                            }
                            if ($value['C'] >= 10000 && $value['C'] < 50000) {
                                $type = 2;
                            }
                            if ($value['C'] >= 50000) {
                                $type = 1;
                            }
                            //新建用户
                            $member->addMember($value['D'], $recom['mid'], $recom['msn'], $recom['mobile_phone'], $value['C'], $value['C'], $type);
                            $memInfo = M('member')->where('mobile_phone="' . $value['D'] . '"')->find();
                        }else{
                            //更新等级
                            $level = new Levels($memInfo['msn']);
                            $rs    = $level->check($value['C']);
                            //更新用户总金额
                            M("member")->where("msn='{$memInfo['msn']}'")->setInc("all_score", $value['C']);
                            M("member")->where("msn='{$memInfo['msn']}'")->setInc("leave_score", $value['C']);

                        }

                        //插入充值记录
                        $member_point                = M('member_point');
                        $member_point->msn           = $memInfo['msn'];
                        $member_point->change_point  = $value['C'];
                        $member_point->change_type   = 1;
                        $member_point->op_type       = 1;//增加积分
                        $member_point->addtime       = time();
                        $member_point->remark        = $value['F'];
                        $member_point->operator_id   = 0;
                        $member_point->operator_name = $value['E'];
                        $result                      = $member_point->add();
                        if (!$result) {
                            $this->error($member_point->getError());
                        }

                        //返佣金
                        if($value['C']>=1000 && $value['C']<50000){
                            //得到四级关系树
                            $recharge = new MemberRechage($memInfo['mid']);
                            $recharge->setPrice($value['C']);
                            $recharge->relationTree();
                            //执行返佣操作
                            $recharge->getTree();
                            $recharge->save($result,$memInfo['msn'],$value['D'],$value['C']);
                        }


                    }
                }
            }

            $this->success('上传成功！');
        } else {
            $this->display(C('DEFAULT_TPL') . '/Member/batchRecharge');
        }

    }

}


?>
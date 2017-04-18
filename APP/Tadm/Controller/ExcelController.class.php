<?php
namespace Tadm\Controller;

use Common\Controller\BaseController;
use Tadm\Biz\Commission;
use Tadm\Biz\Member;

class ExcelController extends BaseController
{
    public function index()
    {
        //dump(strtoupper(createOfflineOrder()));
        $this->display(C('DEFAULT_TPL') . '/ExcelIndex');
    }

    //上传线下订单表单
    public function uploadExcel()
    {
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
                //dump($sheetData);exit;
                unset($sheetData[1], $sheetData[2]);
                foreach ($sheetData as $value) {

                    $ordersn                 = strtoupper(createOfflineOrder());
                    $orderData               = M('offline_order');
                    $orderData->order_sn     = $ordersn;
                    $orderData->carno        = $value['A']; //商品名称
                    $orderData->num          = $value['B']; //商品数量
                    $orderData->price        = $value['C']; //商品单价
                    $orderData->total        = $value['D']; //商品总价
                    $orderData->mobile_phone = $value['E']; //用户手机号
                    //查询自己的MSN及推荐人
                    $memInfo = M('member')->where('mobile_phone="' . $value['E'] . '"')->find(); //用户手机号
                    if (!$memInfo) {
                        $member = new Member();
                        if ($value['D'] >= 1000 && $value['D'] < 10000) {
                            $type = 4;
                        }
                        if ($value['D'] >= 10000) {
                            $type = 3;
                        }
                        $member->add($value['E'], $type);
                        $memInfo = M('member')->where('mobile_phone="' . $value['E'] . '"')->find();
                    }


                    $orderData->msn   = $memInfo['msn'];
                    $orderData->recom = $memInfo['recom_msn'];

                    $orderData->auth      = $value['F']; //操作员
                    $orderData->remark    = $value['G']; //备注
                    $orderData->order_sta = $value['H']; //订单状态
                    $orderData->ctime     = time(); //导入时间
                    $orderData->sta       = 1;
                    $result               = $orderData->add();
                    if (!$result) {
                        $this->error($orderData->getError());
                    }
                    //Process Commission Maximum Depth 3
                    $comm = new Commission();
                    $comm->setMid($memInfo['mid']);
                    $comm->setPrice($value['D']);
                    $comm->setOrderSN($orderData->order_sn);
                    //$all[$memInfo['realname']] = $comm->process();

                    //会员佣金更新操作
                    //todo 更新会员现有积分以及插入积分变更记录 and 会员类型更新
                    $point = $comm->process();
                    foreach ($point as $p) {
                        // inserto twince
                        $point_data = array(
                            'msn'          => $memInfo['msn'],
                            'change_point' => $p['returnd'],
                            'change_type'  => 2,
                            'op_type'      => 1,
                            'addtime'      => time(),
                        );
                        $point      = M("member_point");
                        $point->add($point_data);

                        M("member")->where("msn='{$memInfo['msn']}'")->setInc("all_score", $p['returnd']);
                        M("member")->where("msn='{$memInfo['msn']}'")->setInc("leave_score", $p['returnd']);
                        M("member")->where("msn='{$memInfo['msn']}'")->setInc("all_money", $p['returnd']);
                        M("member")->where("msn='{$memInfo['msn']}'")->setInc("leave_money", $p['returnd']);

                        $commission = array(
                            'order_id'   => $result,
                            'order_sn'   => $ordersn,
                            'member_msn' => $memInfo['msn'],
                            'commamont'  => $p['returnd'],
                            'addtime'    => time(),
                        );
                        M("member_commission")->add($commission);
                    }
                }
            }
        }

        $this->success('上传成功！');
    }

    
}
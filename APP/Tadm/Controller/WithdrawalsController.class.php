<?php
namespace Tadm\Controller;
class WithdrawalsController extends Base
{
    /**
     * 提现列表
     */
    public function index() {
        $fee   = 0 ;//提现手续费
        $map   = array('1=1');
        $msn   = trim($this->post("msn","string","")); //用户编号
        $state = $this->post("state","int",0); //状态

        //用户编号
        if (!empty($msn)) {
            $map['ts_presentation_record.msn'] = array('like', $msn . '%');
        }

        //状态
        if(!empty($state)){
            $map['ts_presentation_record.state'] = $state;
        }

        $model = M("presentation_record");
        $data  = $model->where($map)->field("id,ts_presentation_record.msn,ts_member.nickname,ts_member.mobile_phone,amount,ts_presentation_record.state,addtime,bank_id")->join('ts_member on ts_presentation_record.mid=ts_member.mid', 'LEFT')->where($map)->order('id desc')->select();

        //手续费
        $fee_data = M('fee_set')->find();
        if(empty($fee_data) || $fee_data['fee']<0){
            $fee = 0;
        }else{
            $fee = $fee_data['fee'];
        }
        $this->data = $data;
        $this->fee  = $fee;
  
    }
    //提现详情
    public function view(){

        $id      = $this->get("id","int",0); //提现状态
        $bank_id = $this->get("bank_id","int",0); //银行卡ID
        $data    = M("presentation_record")->where("id=".$id)->find();

        $res = M("bank")->where("id=".$bank_id)->find();

        $this->state = $data['state']; //订单状态
        $this->data  = $data; //订单信息
        $this->res   = $res; //所有银行卡信息
    }

    public function look(){
        $id = $this->post("id","int",0); //ID 提现金id
        $data['remark']     = $this->post("remarks","string",""); //备注
        $data['state']      = $this->post("state","int",0); //状态
        $data['updatetime'] = date("Y-m-d H:i:s",time());

        $record = M('presentation_record')->where("id='$id'")->find();
        if(empty($record)){
            $this->error("提现记录不存在","",1);
        }

        if(empty($data['remark']) && $data['state']==0 || empty($data['remark']) || $data['state']==0){
            $this->error("数据填入不完整","",1);
        }

        $res = M("presentation_record")->where("id=".$id)->setField($data);
        if(!$res){
            $this->error('状态修改失败',U('/Tadm/Withdrawals/index'),1);
        }else{
            //如果状态为打款状态成功，则更新用户剩余金额
            if($data['state']==5){
                $u_res = M('member')->where("mid=".$record['mid'])->setDec('leave_money',$record['amount']); 
                if(!$u_res){
                    $this->error('状态修改失败',U('/Tadm/Withdrawals/index'),1);
                }
            }
            $this->success('状态修改成功',U('/Tadm/Withdrawals/index'),1);
        }

        
    }

    public function feeSet(){
        //查询设置的手续费
        $data = M('fee_set')->find();
        if(IS_POST){
            $id          = $this->request('id','int',0);
            $data['fee'] = $this->request('fee','float',0.00);

            $is_have = M('fee_set')->where("id='$id'")->find();
            if($is_have){
                $res = M('fee_set')->where("id='$id'")->save($data);
            }else{
                $res = M('fee_set')->add($data);
            }

            if($res){
                $this->success('设置成功！');
            }else{
                $this->error('设置失败！');
            }
        }

        $this->data = $data;
    }
}
<?php
/**
 * 用户充值返佣计算类
 * User: Funky
 * Date: 2017/4/12
 * Time: 上午1:42
 */

namespace Tadm\Biz;


class MemberRechage
{
    private $mid   = 0;
    private $depth = 4;
    private $tree  = array();
    private $price = 0.00;

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    private $level
        = array(
            1 => .0,
            2 => .1,
            3 => .05,
            4 => .03,
        );

    /**
     * @return array
     */
    public function getTree()
    {
        return $this->tree;
    }

    /**
     * @param array $tree
     */
    public function setTree($tree)
    {
        $this->tree = $tree;
    }

    public function __construct($mid = 0)
    {
        $this->mid = $mid;
    }

    /**
     * 获取当前用户上级关系树
     * @param int $mid
     */
    public function relationTree()
    {
        $mid   = $this->mid;
        $count = 1;
        $list  = array();

        while (true) {
            $member = M("Member");
            $rs     = $member->where("mid='{$mid}'")->field("mid,msn,nickname,mobile_phone,recom_id,recom_msn,all_score,leave_score")->find();
            if ($rs) {
                $mid           = $rs['recom_id'];
                $rs['returnd'] = $this->price * $this->level[$count];
                array_unshift($list, $rs);
            } else {
                break;
            }
            $count++;
            if ($count > $this->depth) break;
        }
        $this->tree = $list;

    }

    /**进行返佣操作
     * @param int $point_id        充值id
     * @param string $mobile_phone 充值人手机号
     * @param string $msn          充值人msn
     * @param int $score           充值金额
     * @return bool
     */
    public function save($point_id=0,$msn='',$mobile_phone='',$score=0)
    {
        $str = '充值用户编号：%s(手机号：%s)，充值金额：%s,返佣比例：%s%%';
        foreach ($this->tree as $row) {

            //插入佣金日志
            if ($row['returnd']) {
                $proportion = round(($row['returnd']/$score)*100);  //返佣比例
                $remark = sprintf($str,$msn,$mobile_phone,$score,$proportion); //备注
                $Model               = M('member_commission');
                $Model->order_id     = 0;
                $Model->order_sn     = '';
                $Model->member_msn   = $row['msn'];
                $Model->commamont    = $row['returnd'];
                $Model->addtime      = time();
                $Model->source       = 1; //充值
                $Model->point_id     = $point_id;
                $Model->remark       = $remark;
                $Model->add();
            }else{
                //更新用户总金额
                M("member")->where("mid='{$row['mid']}'")->setInc("all_score", $row['returnd']);
                M("member")->where("mid='{$row['mid']}'")->setInc("leave_score", $row['returnd']);
            }
        }
    }


}
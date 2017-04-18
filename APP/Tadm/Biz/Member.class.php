<?php
namespace Tadm\Biz;

/**
 * Created by PhpStorm.
 * User: Funky
 * Date: 2017/4/7
 * Time: 上午4:30
 */
class Member
{
    public function Level4($member)
    {
        //$point = 50000;
        $orderlimit = 5;
        $rs         = [];
        for ($i = 1; $i <= $orderlimit; $i++) {
            $orderinfo = array();
            $datetime  = new \DateTime();
            $datetime->add(new \DateInterval("P{$i}M"));
            $orderinfo['datetime']   = $datetime->format("Y-m-t");
            $irderinfo['member_msn'] = $member;

            $rs[] = $orderinfo;
        }

        return $rs;
    }

    public function Add($mobile = "", $type = 4)
    {
        $pwd         = 'ts123456';
        $data['msn'] = \Tweb\Biz\Crpty::makeMSN();
//        $data['nickname'] = '';
        $data['group'] = '0';
//        $data['sex'] = '';
//        $data['realname'] = '';
        $data['pwd'] = pwdProcess($pwd);
//        $data['headimg'] = '';
        $data['mobile_phone'] = $mobile;
//        $data['email'] = '';
//        $data['all_money'] = '';
//        $data['all_score'] = '';
//        $data['leave_score'] = '';
//        $data['orient_score'] = '';
//        $data['leave_orient_score'] = '';
//        $data['prov'] = '';
//        $data['city'] = '';
//        $data['dist'] = '';
//        $data['address'] = '';
//        $data['recom_id'] = '';
//        $data['recom_msn'] = '';
//        $data['recom_mobile'] = '';
//        $data['birthday'] = '';
//        $data['sec_question'] = '';
//        $data['sec_answer'] = '';
//        $data['pay_pwd'] = '';
//        $data['ident_num'] = '';
        $data['reg_time'] = time();
        $data['type']     = $type;
//        $data['leave_money'] = '';
//        $data['origin'] = '';
//        $data['sta'] = '';
//        $data['ident_img'] = '';
        $data['acount_sta'] = 2;
//        $data['is_seed'] = '';

        M("member")->add($data);
    }

    public function AddMember($mobile = "", $recom_id = 0, $recom_msn = '', $recom_mobile='', $orient_score = 0, $leave_orient_score = 0, $type = 4)
    {
        $pwd         = 'ts123456';
        $data['msn'] = \Tweb\Biz\Crpty::makeMSN();
//        $data['nickname'] = '';
        $data['group'] = $this->getRegGroupId('', $recom_msn);
//        $data['sex'] = '';
//        $data['realname'] = '';
        $data['pwd'] = pwdProcess($pwd);
//        $data['headimg'] = '';
        $data['mobile_phone'] = $mobile;
//        $data['email'] = '';
//        $data['all_money'] = '';
        $data['all_score']   = $orient_score;
        $data['leave_score'] = $leave_orient_score;
//        $data['orient_score']       = $orient_score;
//        $data['leave_orient_score'] = $leave_orient_score;
//        $data['prov'] = '';
//        $data['city'] = '';
//        $data['dist'] = '';
//        $data['address'] = '';
        $data['recom_id']     = $recom_id;
        $data['recom_msn']    = $recom_msn;
        $data['recom_mobile'] = $recom_mobile;
//        $data['birthday'] = '';
//        $data['sec_question'] = '';
//        $data['sec_answer'] = '';
//        $data['pay_pwd'] = '';
//        $data['ident_num'] = '';
        $data['reg_time'] = time();
        $data['type']     = $type;
//        $data['leave_money'] = '';
//        $data['origin'] = '';
//        $data['sta'] = '';
//        $data['ident_img'] = '';
        $data['acount_sta'] = 2;
//        $data['is_seed'] = '';
        M("member")->add($data);
    }

    /**得到注册用户的小组id
     * @param string $mobile 推荐人手机号
     * @param string $msn 推荐人编号
     * @return bool|int
     */
    public function getRegGroupId($mobile = '', $msn = '')
    {
        if (empty($mobile) && empty($msn)) return false;
        //$msn         = ''; //父类编号
        $group_id    = 1; //返回小组id
        $group_count = array(); //最大小组个数

        //判断是用推荐人手机号还是编号进行查询
        if (empty($msn)) {
            //根据手机号查出推荐人编号 即上一级用户信息
            if (empty($mobile)) return false;
            $cond  = array('mobile_phone' => $mobile);
            $model = M('member');
            $data  = $model->where($cond)->field('msn')->find();

            if ($data) {
                $msn = $data['msn'];
            } else {
                return false;
            }
        }

        //根据编号得到该推荐人下的所有第一代目前最大的组号
        $cond      = array('recom_msn' => $msn);
        $group_max = M('member')->where($cond)->field('max(`group`) as group_id')->find();
        //如果大于0则统计该推荐人下最大小组个数
        $group_max_id = $group_max['group_id'];
        if ($group_max_id > 0) {
            $cond['group'] = $group_max_id;
            $group_count   = M('member')->where($cond)->field('count(msn) num')->find();
        }

        //判断是否大于6,，是group_id + 1，否则为该group_id
        if ($group_count['num'] >= 6) {
            $group_id = $group_max_id + 1;
        }

        return $group_id;
    }
}
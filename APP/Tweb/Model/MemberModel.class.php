<?php 
namespace Tweb\Model;
use Think\Model;
/**
* 
*/
class MemberModel extends Model
{
	//自动验证
	protected $_validate=array(
		//array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
		array('nickname','require','昵称不得为空!',0,1),
		array('mobile_phone','/^1[34578]{1}\d{9}$/','手机号格式不正确',0,'regex',1),
		array('mobile_phone','','该号码已被注册！',0,'unique',1),
		array('pwd','6,16','密码长度在6到16位!',0,'length',1),
		array('pwd1','pwd','两次密码输入不一致!',0,'confirm',1),
		array('recom_mobile','/^1[34578]{1}\d{9}$/','推荐人手机号格式不正确!',0,'regex',1),
	);

	protected $_auto = array(
		array('pwd','pwdProcess',3,'function'), // 对name字段在新增和编辑的时候回调getName方法
		array('reg_time','time',3,'function'),
	);

    /**添加用户
     * @param string $nickname
     * @param string $mobile_phone
     * @param int $type
     * @param string $password
     *
     * @return array mixed
     */
	public function saveMember($nickname='',$mobile_phone='',$type=0,$password=''){
	    $msg    = '添加成功';
	    $status = 1;
	    $data   = array();

        if(!preg_match('/^1[34578]{1}\d{9}$/',$mobile_phone)){
           $status = 10;
           $msg    = '手机号格式错误';
        }
        //检测手机号是否存在
        $is_exist = $this->checkMobile($mobile_phone);
        if(!$is_exist){
            $status = 11;
            $msg    = '手机号已存在！';
        }

        //添加
        $model = D('member');
        $recomMemInfo = $model->where('msn="'.session('msn').'"')->find();
        $data['nickname']     = $nickname;
        $data['realname']     = $nickname;
        $data['msn']           = $this->generateMsn();
        $data['mobile_phone'] = $mobile_phone;
        $data['type']          = $type;
        $data['pwd']     = pwdProcess($password);
        $data['recom_id']     = $_SESSION['mid'];
        $data['recom_msn']    = $_SESSION['msn'];
        $data['recom_mobile'] = $recomMemInfo['mobile_phone'];
        $data['group']        = $this->getRegGroupId($recomMemInfo['mobile_phone'],$_SESSION['msn']);
        $data['reg_time']     =time();
        //保存用户
        if(!$model->add($data)) {
					echo M()->getLastSql();exit;
            $status = 12;
            $msg = '添加失败';
        }

        return $res = array(
            'status' =>$status,
            'msg'    =>$msg,
        );
    }

    /**验证用户手机号是否添加
     * @param string $mobile
     * @return bool
     */
    public function checkMobile($mobile=''){
	    if(empty($mobile)) return false;
	    $cond = array('mobile_phone'=>$mobile);
        $model = D('member');
        $data = $model->where($cond)->field('mid')->find();

        if($data){
            return false;
        }

        return true;
    }

    /**随机生成会员编号 16位
     * @return string
     */
    public function generateMsn(){
			//todo 临时过滤之前的测试字段，上线前修改
			$objMem = D('member');
//				$maxMsn = $objMem->field("max(msn)")->find();
			$maxMsn = $objMem->order('mid DESC')->find();
//			dump($maxMsn);die;
			if(!preg_match('/^\d{6,}$/',$maxMsn['msn'])){
				$data['msn'] = '000001';
			}else {
				$data['msn'] = str_pad($maxMsn['msn']+1,6,0,STR_PAD_LEFT);
			}
			return $data['msn'];
    }

    /**得到注册用户的小组id
     * @param string $mobile 推荐人手机号
     * @param string $msn 推荐人编号
     * @return bool|int
     */
    public function getRegGroupId($mobile='',$msn=''){
        if(empty($mobile) && empty($msn)) return false;
        //$msn         = ''; //父类编号
        $group_id    = 1; //返回小组id
        $group_count = array(); //最大小组个数

        //判断是用推荐人手机号还是编号进行查询
        if(empty($msn)) {
            //根据手机号查出推荐人编号 即上一级用户信息
            if (empty($mobile)) return false;
            $cond = array('mobile_phone' => $mobile);
            $model = M('member');
            $data = $model->where($cond)->field('msn')->find();

            if ($data) {
                $msn = $data['msn'];
            } else {
                return false;
            }
        }

        //根据编号得到该推荐人下的所有第一代目前最大的组号
        $cond = array('recom_msn'=>$msn);
        $group_max = M("member")->where($cond)->field('max(`group`) as group_id')->find();
        //如果大于0则统计该推荐人下最大小组个数
        $group_max_id = $group_max['group_id'];
        if($group_max_id>0){
            $cond['group'] = $group_max_id;
            $group_count = M("member")->where($cond)->field('count(msn) num')->find();
        }

        //判断是否大于6,，是group_id + 1，否则为该group_id
        if($group_count['num']>=6){
            $group_id = $group_max_id+1;
        }

        return $group_id;
    }

    /**得到第一代下属 按小组分组 统计指定小组超过指定消费的积分，则进行返利 已审核通过
     * @param array $cond
     * @param string $recom_msn 推荐人msn
     * @param int $maxscore 超过指定的消费积分
     * @param int $page
     * @param int $pagesize
     * @return array|bool
     */
    public function getList($cond=array(),$recom_msn='',$maxscore=0,$page=1,$pagesize=10){
        if(!$recom_msn) return false;
        $whereStr = "";
        $result = array();

        $orderby = 'order by `group` ';
        $groupby = "group by  `group`";
        $start = ($page-1) * $pagesize;
        $limit = " limit {$start},{$pagesize}";
        $whereStr = implode(" AND ", $cond);

        $str = "  FROM (SELECT
                     o.ctime,
                    o.msn,
                    total,
                `group`,
                 sum(total) sum
                FROM
                    ts_offline_order o
                LEFT JOIN ts_member m ON o.msn = m.msn
                WHERE
                    o.msn in (SELECT msn FROM ts_member WHERE recom_msn='%s') and order_sta=1 %s %s)a WHERE  a.sum>=%s and %s";
        $tplcount = ' SELECT count(*) num '.$str;
        $tpl      = ' SELECT *  '.$str;
        $sqlcount = sprintf($tplcount,$recom_msn,$groupby,$orderby,$maxscore,$whereStr);
        $sql = sprintf($tpl,$recom_msn,$groupby,$orderby,$maxscore,$whereStr);

        $model = M();
        $countdata = $model->query($sqlcount);
        $count = $countdata[0]['num'];

        $sql .= $limit;
        $list = $model->query($sql);

        return array(
            'pagetotal' => ceil($count/$pagesize),
            'count' => $count,
            'data' => empty($list) ? [] : $list,
        );
    }

    /** 得到下属列表
     * @param array $cond
     * @param int $page
     * @param int $pagesize
     * @return array
     */
    public function getUnderling($cond=array(),$page=1,$pagesize=10){
        $whereStr = "";
        $result = array();

        $orderby = 'order by `mid`';

        $start = ($page-1) * $pagesize;
        $limit = " limit {$start},{$pagesize}";
        $whereStr = implode(" AND ", $cond);

        $str = "from  ts_member where msn in (select msn from ts_member WHERE %s
            UNION
            SELECT msn from ts_member WHERE recom_msn in(select msn from ts_member WHERE %s)
            UNION
            SELECT
                msn
            FROM
                ts_member
            WHERE
                recom_msn IN (
                    SELECT
                        msn
                    FROM
                        ts_member
                    WHERE
                        recom_msn IN (
                            SELECT
                                msn
                            FROM
                                ts_member
                            WHERE
                               %s
                        )
                )
            )";
        $tplcount = ' SELECT count(*) num '.$str;
        $tpl      = " SELECT *   ".$str;
        $sqlcount = sprintf($tplcount,$whereStr,$whereStr,$whereStr,$orderby);
        $sql      = sprintf($tpl,$whereStr,$whereStr,$whereStr,$orderby);

        $model = M();
        $countdata = $model->query($sqlcount);
        $count = $countdata[0]['num'];

        $sql .= $limit;
        $list = $model->query($sql);

        return array(
            'pagetotal' => ceil($count/$pagesize),
            'count' => $count,
            'data' => empty($list) ? [] : $list,
        );
    }

    /**获取小组当前月消费详情
     * @param array $cond
     * @param string $recom_msn
     * @return mixed
     */
    public function consumedDetial($cond=array(),$recom_msn=''){
        $whereStr = implode(" AND ", $cond);

        $sql = "SELECT * FROM (SELECT
                    order_sn,
                FROM_UNIXTIME(o.ctime,'%Y-%m-%d') orderdate,
                    m.msn,
                    m.nickname,
                FROM_UNIXTIME(m.reg_time,'%Y-%m-%d') regdate,
                    total,
                `group`,
                 sum(total) sum
                FROM
                    ts_offline_order o
                LEFT JOIN ts_member m ON o.msn = m.msn
                WHERE
                    o.msn in (SELECT msn FROM ts_member WHERE recom_msn='$recom_msn') and $whereStr  GROUP BY o.msn ORDER BY o.ctime)a ";

        $model = M();
        $data = $model->query($sql);

        return $data;
    }

    /**得到会员信息，通过msn
     * @param $cond
     * @return mixed
     */
    public function getMemberBymsn($cond){
        $member = D('member');

        $list = $member->where($cond)->find();

        return $list;
    }

}



















 ?>
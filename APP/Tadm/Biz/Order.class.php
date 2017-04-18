<?php
namespace Tadm\Biz;

class Order
{
    /**
     * 创建订单
     * @param int $mid 会员ID
     * @param int $address 收货地址ID
     * @param array $cart 商品信息
     */
    public function Create($mid = 0, $address = 0, $cart = [])
    {
        $member  = $this->getMember($mid);
        $address = $this->getAddress($address);

        $objOrder = new \Tweb\Model\OrderModel();

        $orderData['order_sn']     = \Tweb\Biz\Crpty::makeOrderSN();
        $orderData['msn']          = $member['msn'];
        $orderData['order_status'] = 0;
        $orderData['realname']     = $member['realname'];
        $orderData['province']     = $address['province'];
        $orderData['city']         = $address['city'];
        $orderData['county']       = $address['county'];
        $orderData['address']      = $address['address'];
        $orderData['zipcode']      = $address['zipcode'];
        $orderData['tel']          = $address['tel'];
        $orderData['integral']     = $cart['sum'];
        $orderData['create_time']  = date("Y-m-d H:i:s", strtotime("now"));
        $orderData['update_time']  = date("Y-m-d H:i:s", strtotime("now"));

        $result = $objOrder->add($orderData);


        $newOrder = $objOrder->where('id=' . $result)->find();

        $objGoods         = M('goods');
        $objOrderRelation = D('order_goods');

        //构造关系表数据

        foreach ($cart['items'] as $value => $key) {
            $goodInfo = $objGoods->where('goods_code="' . $cart['items']['goods_code'] . '"')->find();
            //填充关系表数据
            $relation['msn']          = $member['msn'];
            $relation['goods_code']   = $goodInfo['goods_code'];
            $relation['order_sn']     = $newOrder['order_sn'];
            $relation['order_status'] = $newOrder['order_status'];
            $relation['goods_name']   = $goodInfo['goods_name'];
            $relation['goods_thumb']  = $goodInfo['goods_thumb'];
            $relation['goods_num']    = $cart['items']['num'];
            $relation['total_score']  = $cart['items']['num'] * $goodInfo['goods_score'];
            $relation['create_at']    = date("Y-m-d H:i:s", strtotime("now"));
            $relation['update_at']    = date("Y-m-d H:i:s", strtotime("now"));
            $newRelation              = $objOrderRelation->add($relation);
            //清空购物车
            if (!$newRelation) {
                return false;
            } else {
                //更新用户审核状态
                $member             = M("member"); // 实例化MEMBER对象
                $member->acount_sta = 2;
                $member->where("mid='{$mid}'")->save(); // 根据条件更新记录
                return true;
            }

        }
    }

    /**
     * 根据会员id查找会员信息
     * @param int $id
     * @return mixed
     */
    private function getMember($id = 0)
    {
        $member = M("member")->where("mid='{$id}'")->find();
        return $member;
    }

    /**
     * 根据地址编号查找会员收货地址
     * @param int $aid
     * @return mixed
     */
    private function getAddress($aid = 0)
    {
        return M("address")->where("id='{$aid}'")->find();
    }


}


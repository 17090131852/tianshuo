<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo (C("WEB_TITLE")); ?></title>
<link rel="icon" type="image/png" href="/Public/Admin/i/favicon.png">
<link rel="stylesheet" href="/Public/Admin/css/amazeui.min.css"/>
<link rel="stylesheet" href="/Public/Admin/css/admin.css">
<link rel="stylesheet" href="/Public/Admin/css/jquery.datetimepicker.css">
<script src="/Public/Admin/js/jquery-1.9.1.min.js"></script>
<base target="main" />
</head>
<body>
<script src="/Public/Admin/js/jquery.datetimepicker.js"></script>

<style type="text/css">

    .custom-date-style {
        background-color: red !important;
    }
    .check{
        margin-bottom: 20px;
    }
    .check td{
        width: 100px;
        height: 40px;
        text-align: right;
    }
    .check input{
        height:30px;
    }
    .check select{
        width: 100px;
        height: 40px;
        text-align: right;
    }

    #check_title{
        margin-left: 10px;
    }
</style>
<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">订单管理</strong> / <small>线上订单列表</small></div>
    </div>
    <div class="check">
        <div class="am-cf am-padding">
            <div class="am-fl am-cf" id="check_title"><middle class="am-text-primary am-text-lg">订单查询<middle/></div>
        </div>
        <form action="/Tadm/Order/index" method="post">
            <table>
                <tr>
                    <td>订单编号：</td>
                    <td class="check_left"><input name="order_sn" value="<?php echo ($order_sn); ?>"></td>
                    <td>用户编号：</td>
                    <td><input name="msn" value="<?php echo ($msn); ?>"></td>
                    <td>用户姓名：</td>
                    <td><input name="realname" value="<?php echo ($realname); ?>"></td>
                    <td>用户电话：</td>
                    <td><input name="tel" value="<?php echo ($tel); ?>"></td>
                </tr>
                <tr>
                    <td>开始时间：</td>
                    <td>
                        <input name="start_time" type="text"  readonly="true" value="<?php echo ($start_time); ?>" id="datetimepicker"> </td>
                    <td>结束时间：</td>
                    <td>
                        <input name="end_time" type="text" readonly="true" value="<?php echo ($end_time); ?>" id="datetimepicker1"> </td>

                    </td>
                    <td>订单状态：</td>
                    <td style="text-align: left">
                        <select name="order_status">
                            <option value="0" <?php if($order_status==0):?>selected<?php endif;?>>--请选择--</option>
                            <option value="1" <?php if($order_status==1):?>selected<?php endif;?>>未付款</option>
                            <option value="2" <?php if($order_status==2):?>selected<?php endif;?>>已付款</option>
                            <option value="3" <?php if($order_status==3):?>selected<?php endif;?>>已关闭</option>
                        </select>
                    </td>
                    <td>配送状态：</td>
                    <td style="text-align: left">
                        <select name="shipping_status">
                            <option value="0" <?php if($shipping_status==0):?>selected<?php endif;?>>--请选择--</option>
                            <option value="1" <?php if($shipping_status==1):?>selected<?php endif;?>>未发货</option>
                            <option value="2" <?php if($shipping_status==2):?>selected<?php endif;?>>已发货</option>
                            <option value="3" <?php if($shipping_status==3):?>selected<?php endif;?>>已确认收货</option>
                        </select>
                    </td>
                </tr>
                <tr><td></td><td></td><td><td></td><td></td><td></td><td></td> <td><input type="submit" value="提交" /></td></tr>
            </table>
        </form>
    </div>
    <div class="am-g">
        <div class="am-u-sm-12">
            <table class="am-table am-table-striped am-table-hover table-main">
                <thead>
                <tr>
                    <th>序号</th>
                    <th>订单编号</th>
                    <th>用户编号</th>
                    <th>用户姓名</th>
                    <th>用户电话</th>
                    <th>收货人地址</th>
                    <th>收货人电话</th>
                    <th>订单积分</th>
                    <th>下单时间</th>
                    <th>订单状态</th>
                    <th>发货状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><tr>
                        <td><?=$key+1?></td>
                        <td><?php echo ($value["order_sn"]); ?></td>
                        <td><?php echo ($value["o_msn"]); ?></td>
                        <td><?php echo ($value["m_realname"]); ?></td>
                        <td><?php echo ($value["mobile_phone"]); ?></td>
                        <td><?php echo ($value["province"]); echo ($value["o_city"]); echo ($value["county"]); echo ($value["o_address"]); ?></td>
                        <td><?php echo ($value["tel"]); ?></td>
                        <td><?php echo ($value["integral"]); ?>BV</td>
                        <td><?php echo ($value["create_time"]); ?></td>
                        <td><?php echo (getOrderStatus($value["order_status"])); ?></td>
                        <td><?php echo (getOrderShippingStatus($value["shipping_status"])); ?></td>
                        <td>
                            <a href="/index.php/Tadm/Order/view?id=<?php echo ($value["id"]); ?>">[查看]</a>
                            <?php if($value['order_status']==0):?>
                            <a href="/index.php/Tadm/Order/changeOrderStatus?id=<?php echo ($value["id"]); ?>&status=1">[付款]</a>
                            <?php endif;?>
                            <?php if($value['shipping_status']==0 && $value['order_status']==1):?>
                            <a href="/index.php/Tadm/Order/changeOrderShippingStatus?id=<?php echo ($value["id"]); ?>&status=1">[发货]</a>
                            <?php endif;?>
                        </td>
                    </tr><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
                </tbody>
            </table>
            <div class="am-cf page">
                <?php echo ($page); ?>
            </div>

            <hr />
            <p></p>
        </div>
    </div>
    <!-- content end -->
</div>
<script>
    $('#datetimepicker').datetimepicker({
        formatTime:'H:i',
        formatDate:'d.m.Y',
        //defaultDate:'8.12.1986', // it's my birthday
        defaultDate:'+03.01.1970', // it's my birthday
        defaultTime:'10:00',
        timepickerScrollbar:false
    });
    $('#datetimepicker1').datetimepicker({
        formatTime:'H:i',
        formatDate:'d.m.Y',
        //defaultDate:'8.12.1986', // it's my birthday
        defaultDate:'+03.01.1970', // it's my birthday
        defaultTime:'10:00',
        timepickerScrollbar:false
    });
</script>
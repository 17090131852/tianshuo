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
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">提现管理</strong> / <small>提现列表</small></div>
    </div>
    <div class="check">
        <div class="am-cf am-padding">
            <div class="am-fl am-cf" id="check_title"><middle class="am-text-primary am-text-lg">提现查询<middle/></div>
        </div>
        <form action="/Tadm/Withdrawals/index" method="post">
            <table>
                <tr>
                    <td>用户编号：</td>
                    <td class="check_left"><input name="msn" value="<?php echo ($member_msn); ?>"></td>
                    <td>提现状态：</td>
                    <td style="text-align: left">
                        <select name="state">
                            <option value="0" <?php if($state==0):?>selected<?php endif;?>>--请选择--</option>
                            <option value="1" <?php if($state==1):?>selected<?php endif;?>>已提交</option>
                            <option value="2" <?php if($state==2):?>selected<?php endif;?>>审核失败</option>
                            <option value="3" <?php if($state==3):?>selected<?php endif;?>>审核成功</option>
                            <option value="4" <?php if($state==4):?>selected<?php endif;?>>打款失败</option>
                            <option value="4" <?php if($state==5):?>selected<?php endif;?>>打款成功</option>
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
                    <th>用户编号</th>
                    <th>用户姓名</th>
                    <th>用户电话</th>
                    <th>提现总金额</th>
                    <th>状态</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><tr>
                        <td><?=$key+1?></td>
                        <td><?php echo ($value["msn"]); ?></td>
                        <td><?php echo ($value["nickname"]); ?></td>
                        <td><?php echo ($value["mobile_phone"]); ?></td>
                        <td><?php echo ($value["amount"]); ?></td>
                        <td><?php echo (getPlayState($value["state"])); ?></td>
                        <td><?php echo ($value["addtime"]); ?></td>
                        <td>
                            <a href="/index.php/Tadm/Withdrawals/view?id=<?php echo ($value["id"]); ?>&bank_id=<?php echo ($value["bank_id"]); ?>">[查看]</a>
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
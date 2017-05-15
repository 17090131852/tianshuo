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
<style>
    .nav{
        margin-left: 45px;
    }
</style>
<!-- content start -->
<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">提现管理</strong> / <small>提现详情</small></div>
    </div>
    <table class="show_msg">
        <tr>
            <td class="msg_title">编号：</td><td><span><?php echo ($data["id"]); ?></span></td>
        </tr>
        <tr>
            <td class="msg_title">用户编号：</td><td><span><?php echo ($data["msn"]); ?></span></td>
        </tr>
        <tr>
            <td class="msg_title">银行卡号：</td><td><span><?php echo ($res["card_number"]); ?></span></td>
        </tr>
        <tr>
            <td class="msg_title">开户名：</td><td><span><?php echo ($res["account_name"]); ?></span></td>
        </tr>
        <tr>
            <td class="msg_title">开户行：</td><td><span><?php echo ($res["bank_account"]); ?></span></td>
        </tr>
        <tr>
            <td class="msg_title">开户支行：</td><td><span><?php echo ($res["branch_account"]); ?></span></td>
        </tr>
        <tr><td class="msg_title">状态：</td><td><span><?php if($data['state']==0):?>未删除<?php else:?>已删除<?php endif;?></span></td></tr>
        <tr>
            <td class="msg_title">添加时间：</td><td><span><?php echo ($data["addtime"]); ?></span></td>
        </tr>
        <tr>
            <td class="msg_title">更新时间：</td><td><span><?php echo ($data["updatetime"]); ?></span></td>
        </tr>
        <tr>
            <td class="msg_title">备注：</td><td><span><?php echo ($data["remark"]); ?></span></td>
        </tr>
    </table>
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><span class="am-text-primary am-text-lg nav" >操作</span> </div>
    </div>
    <form action="/Tadm/Withdrawals/look" method="post">
        <table class="show_msg">
            <?php if($state==2 || $state==4 || $state==5):?>
                <tr>
                    <td class="msg_title">审核状态：</td>
                    <td>
                        <span>
                            <?php if($state==1):?>
                                <input type="radio" name="state" value="2">审核失败
                                <input type="radio" name="state" value="3">审核成功
                            <?php elseif($state==2):?>
                                审核失败
                            <?php elseif($state==3):?>
                                审核成功 <br />
                                <input type="radio" name="state" value="4">打款失败
                                <input type="radio" name="state" value="5">打款成功
                            <?php elseif($state==4):?>
                                打款失败
                            <?php elseif($state==5):?>
                                打款成功
                            <?php endif;?>
                        </span>
                    </td>
                </tr>
            <?php else:?>
                <tr>
                    <td class="msg_title">备注：</td>
                    <td>
                        <textarea name="remarks" id="" cols="30" rows="10"></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="msg_title">审核状态：</td>
                    <td>
                        <span>

                            <?php if($state==1):?>
                                <input type="radio" name="state" value="2">审核失败
                                <input type="radio" name="state" value="3">审核成功
                            <?php elseif($state==2):?>
                                审核失败
                            <?php elseif($state==3):?>
                                审核成功 <br />
                                <input type="radio" name="state" value="4">打款失败
                                <input type="radio" name="state" value="5">打款成功
                            <?php elseif($state==4):?>
                                打款失败
                            <?php elseif($state==5):?>
                                打款成功
                            <?php endif;?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>" />
                        <input type="submit" value="提交" />
                    </td>
                </tr>
            <?php endif;?>
        </table>
    </form>
</div>
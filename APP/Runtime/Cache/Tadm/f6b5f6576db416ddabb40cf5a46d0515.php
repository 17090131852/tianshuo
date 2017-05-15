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
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">商品管理</strong> / <small>商品详情</small></div>
    </div>

    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><span class="am-text-primary am-text-lg nav" >商品主信息</span> </div>
    </div>
    <table class="show_msg">
        <tr>
            <td class="msg_title">商品编号：</td><td><span><?php echo ($data["goods_code"]); ?></span></td>
        </tr>
        <tr>
            <td class="msg_title">商品名称：</td><td><span><?php echo ($data["goods_name"]); ?></span></td>
        </tr>
        <tr>
            <td class="msg_title">商品价格：</td><td><span><?php echo ($data["goods_price"]); ?></span></td>
        </tr>
        <tr>
            <td class="msg_title">商品积分：</td><td><span><?php echo ($data["goods_score"]); ?></span></td>
        </tr>
        <tr>
            <td class="msg_title">商品数量：</td><td><span><?php echo ($data["goods_num"]); ?></span></td>
        </tr>
        <tr>
            <td class="msg_title">可售数量：</td><td><span><?php echo ($data["goods_sale_num"]); ?></span></td>
        </tr>
        <tr><td class="msg_title">商品状态：</td><td><span><?php if($data['is_show']==1):?>上架<?php else:?>下架<?php endif;?></span></td></tr>
        <tr>
            <td class="msg_title">分类名称：</td><td><span><?php echo (getCategoryName($data["cat_id"])); ?></span></td>
        </tr>
        <tr>
            <td class="msg_title">商品图片：</td><td><span><img src="<?php echo C('DOMAIN_NAME');?>/<?php echo ($data["goods_thumb"]); ?>" width="80px" height="80px"/></span></td>
        </tr>
        <tr>
            <td class="msg_title">商品详情：</td><td><span><?php echo ($data["desc"]); ?></span></td>
        </tr>
    </table>
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><span class="am-text-primary am-text-lg nav" >扩展信息</span> </div>
    </div>
    <table class="show_msg">
        <tr>
            <td class="msg_title">商品类型：</td><td><span><?php if($data['is_real']==1):?>实物<?php else:?>虚拟商品<?php endif;?></span></td>
        </tr>
        <tr>
            <td class="msg_title">是否热销：</td><td><span><?php if($data['is_hot']==1):?>是<?php else:?>否<?php endif;?></span></td>
        </tr>
        <tr>
            <td class="msg_title">是否新品：</td><td><span><?php if($data['is_new']==1):?>是<?php else:?>否<?php endif;?></span></td>
        </tr>
        <tr>
            <td class="msg_title">是否赠送积分：</td><td><span><?php if($data['give_score']==1):?>赠送<?php else:?>不赠送<?php endif;?></span></td>
        </tr>
        <!--<tr>-->
            <!--<td  class="msg_title">商品排序：</td><td><span><?php echo ($data["goods_sort"]); ?></span></td>-->
        <!--</tr>-->
    </table>
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><span class="am-text-primary am-text-lg nav" >其他信息</span> </div>
    </div>
    <table class="show_msg">
        <tr>
            <td  class="msg_title">添加时间：</td><td><span><?php echo ($data["add_time"]); ?></span></td>
        </tr>
    </table>

</div>
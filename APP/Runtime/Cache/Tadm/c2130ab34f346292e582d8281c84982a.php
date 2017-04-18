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
.am-icon-file:before{padding-right:5px;}
</style>
<div class="am-cf admin-main">
<ul class="am-list admin-sidebar-list">
    <li><a class="am-cf" href="<?php echo U('main');?>"><span class="am-icon-home"></span> 首页</a></li>
    <?php if(is_array($treeArr)): foreach($treeArr as $key=>$app): ?><li class="admin-parent"><a class="am-cf"><span class="am-icon-file"><?php echo ($app["title"]); ?></span>　<span class="am-icon-angle-right am-fr am-margin-right"></span></a></li>
				<ul class="am-list admin-sidebar-sub am-collapse">
					<?php if(is_array($app["child"])): foreach($app["child"] as $key=>$L1): ?><li><a href="<?php echo U($L1['model'].'/'.$L1['action']);?>"><span class="am-icon-tag"></span> <?php echo ($L1["title"]); ?></a></li><?php endforeach; endif; ?>
				</ul><?php endforeach; endif; ?>
</ul>
</div>
<script type="text/javascript">
$(function(){
	$('.admin-parent').click(function(){
	  $(this).next('ul').slideToggle(250);
   })
    // $('.am-list li a').hover(function(){
    //     $(this).addClass('hover');
    // },function(){
    //     $(this).removeClass('hover');
    // })
})
</script>
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
<header class="am-topbar admin-header">
  <div class="am-topbar-brand">
    <!--<img src="/Public/images/logo.jpg">-->
    <strong><?php echo (C("WEB_TITLE")); ?></strong><small></small>　
    <span style="cursor: pointer;" class="am-icon-arrows-alt"></span>
  </div>
  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">
    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
      <li style="margin:13px 0 0 0;"><span class="am-icon-users"></span> 您好！<?php echo (session('admUname')); ?> </li>
      <li><a href="<?php echo U('login/editpwd');?>"><span class="am-icon-tag"> 修改密码</a></li>
      <li><a target="_top" href="<?php echo U('Public/logout');?>"><span class="am-icon-sign-out"></span>注销</a></li>
    </ul>
  </div>
</header>

<script type="text/javascript">
$(function(){
    $('.am-icon-arrows-alt').click(function(){
        var cols = $("#frame", top.document).attr('cols');
        if(cols != '0,*')
        {
            $("#frame", top.document).attr('cols','0,*');
        }
        else
        {
            $("#frame", top.document).attr('cols','180,*');
        }
    });
})
</script>
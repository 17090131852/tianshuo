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
<!-- content start -->
<div class="admin-content">
    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> / <small>基本参数</small></div>
    </div>
 
    <div class="am-g">
      <div class="am-u-sm-12">
          <table width="100%" class="am-table am-table-striped am-table-hover table-main">
            <tr><td>操作系统:</td><td><?php echo ($sysInfo["操作系统"]); ?></td></tr>
            <tr><td>服务器系统版本:</td><td><?php echo ($sysInfo["服务器系统版本"]); ?></td></tr>
            <tr><td>运行环境:</td><td><?php echo ($sysInfo["运行环境"]); ?></td></tr>
            <tr><td>PHP运行方式:</td><td><?php echo ($sysInfo["PHP运行方式"]); ?></td></tr>
            <tr><td>PHP版本:</td><td><?php echo ($sysInfo["PHP版本"]); ?></td></tr>
            <tr><td>MySql:</td><td><?php echo ($sysInfo["MySql"]); ?></td></tr>
            <tr><td>MySql版本:</td><td><?php echo ($sysInfo["MySql版本"]); ?></td></tr>
            <tr><td>ThinkPHP版本:</td><td><?php echo ($sysInfo["ThinkPHP版本"]); ?></td></tr>
            <tr><td>服务器语言:</td><td><?php echo ($sysInfo["服务器语言"]); ?></td></tr>
            <tr><td>服务器端口:</td><td><?php echo ($sysInfo["服务器端口"]); ?></td></tr>
            <tr><td>上传附件限制:</td><td><?php echo ($sysInfo["上传附件限制"]); ?></td></tr>
            <tr><td>脚本最大执行时间:</td><td><?php echo ($sysInfo["脚本最大执行时间"]); ?></td></tr>
            <tr><td>最大上传文件限制:</td><td><?php echo ($sysInfo["最大上传文件限制"]); ?></td></tr>
            <tr><td>执行时间限制:</td><td><?php echo ($sysInfo["执行时间限制"]); ?></td></tr>
            <tr><td>北京时间:</td><td><?php echo ($sysInfo["北京时间"]); ?></td></tr>
            <tr><td>服务器时间:</td><td><?php echo ($sysInfo["服务器时间"]); ?></td></tr>
            <tr><td>服务器域名:</td><td><?php echo ($sysInfo["服务器域名"]); ?></td></tr>
            <tr><td>剩余空间:</td><td><?php echo ($sysInfo["剩余空间"]); ?></td></tr>
            <tr><td>图像处理GD2:</td><td><?php echo ($sysInfo["图像处理GD2"]); ?></td></tr>
            <tr><td>图像处理GD2版本:</td><td><?php echo ($sysInfo["图像处理GD2版本"]); ?></td></tr>
            <tr><td>register_globals:</td><td><?php echo ($sysInfo["register_globals"]); ?></td></tr>
            <tr><td>magic_quotes_gpc:</td><td><?php echo ($sysInfo["magic_quotes_gpc"]); ?></td></tr>
            <tr><td>magic_quotes_runtime:</td><td><?php echo ($sysInfo["magic_quotes_runtime"]); ?></td></tr>
            <tr><td>SOCKET支持:</td><td><?php echo ($sysInfo["SOCKET支持"]); ?></td></tr>
          </table>
      </div>
    </div>
  <!-- content end -->
</div>
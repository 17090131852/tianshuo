<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo (C("WEB_TITLE")); ?></title>
<link rel="icon" type="image/png" href="/Public/Admin/i/favicon.png">
<style>
#main{ border-left: 1px solid #ccc;}
</style>
</head>
<frameset rows="51,*" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="<?php echo u('index/top/');?>" name="top" scrolling="No" noresize="noresize" id="top" />
  <frameset cols="180,*" id="frame" frameborder="no" border="0" framespacing="0">
    <frame src="<?php echo u('index/left/');?>" name="left" scrolling-y="yes" noresize="noresize" id="left" />
    <frame src="<?php echo u('index/main/');?>" name="main" scrolling="yes" id="main" />
  </frameset>
</frameset>
<noframes><body>
</body>
</noframes></html>
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
<script>
function formuser()
{
	if(document.user.old_pwd.value == '')
	{
		alert('原密码不能为空！');
		document.user.old_pwd.focus();
		return false;
	}

	if(document.user.password.value == '')
	{
		alert('请输入新密码！');
		document.user.password.focus();
		return false;
	}

	if(document.user.password.value != document.user.password2.value)
	{
		alert('两次新密码不一致！');
		document.user.password2.focus();
		return false;
	}

	if(document.user.verify.value == '')
	{
		alert('请输入验证码！');
		document.user.verify.focus();
		return false;
	}
}

</script>
<div class="admin-content">
  <div class="am-cf am-padding">
    <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">用户</strong> / <small>修改密码</small></div>
  </div>
  <form name="user" action="<?php echo U('Public/Editpwd');?>" method="post" onsubmit="return formuser();">
  <table id="add">
    <tr>
      <td width="90" align="right">原密码：</td>
      <td><input type="password" name="oldPwd"></td>
    </tr>
    <tr>
      <td width="90" align="right">新密码：</td>
      <td><input type="password" name="pwd"></td>
    </tr>
    <tr>
      <td width="90" align="right">确认新密码：</td>
      <td><input type="password" name="rePwd"></td>
    </tr>
    <tr>
      <td width="90" align="right"></td>
      <td colspan="2"><input type="submit" style="width: 176px;border-radius:4px" value="确定修改"></td>
    </tr>
  </table>
  </form>
</div>
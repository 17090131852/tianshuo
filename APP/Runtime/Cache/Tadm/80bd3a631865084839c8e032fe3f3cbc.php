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
<script type="text/javascript" src="/Public/Plugin/AjaxFileUpload/ajaxfileupload.js"></script>
<div class="admin-content">
	<div class="am-cf am-padding">
		<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">推荐位管理</strong> / <small>资源管理</small></div>
	</div>

	<div class="am-g">
		<div class="am-u-sm-12">
			<table class="am-table am-table-striped am-table-hover table-main">
				<thead>
				<tr>
					<td>推荐位位置:&nbsp;&nbsp;<?php echo ($commendInfo["location"]); ?></td>
				</tr>
				<tr>
					<th>ID</th>
					<th>预览</th>
					<th>资源描述</th>
					<th>上传时间</th>
				</tr>
				</thead>
				<tbody>
				<?php if(is_array($resourceList)): $i = 0; $__LIST__ = $resourceList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$role): $mod = ($i % 2 );++$i;?><tr>
						<td><?php echo ($role["id"]); ?></td>
						<td><img src="<?php echo ($role["url"]); ?>" alt="图片错误" style="width:160px;height: 90px;"></td>
						<td><?php echo ($role["resource_desc"]); ?></td>
						<td><?php echo ($role["create_at"]); ?></td>
						<td>
							<a href="/index.php/../Tadm/Commend/destroyImg/id/<?php echo ($role["id"]); ?>" onclick="return dispConfirm()">删除</a>
						</td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
			<hr />
			<p></p>
		</div>
	</div>
	<div class="am-g">
		<div class="am-u-sm-12">
			<input type="button" class="btn-success" onclick="addnode();" value="点击添加" />
			<form class="upForm" method="post" action="<?php echo U('Commend/uploadImg');?>" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo ($commendInfo["id"]); ?>" />
				<input type="submit" class="btn btn-success" value="提交" />
			</form>
		</div>
	</div>
</div>
<script>
	var i=1;
	var g=1;
	function addnode(){
		//console.log(123);
		$('form').append('<br /><input type="file" class="iptFile" name='+i+' value='+i+++' />' +
										 '资源描述：<input type="text" name='+g+' class='+g+++'>');
	}

	function dispConfirm(){
		var r=confirm("确定删除图片？");
		if (r==true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
</script>
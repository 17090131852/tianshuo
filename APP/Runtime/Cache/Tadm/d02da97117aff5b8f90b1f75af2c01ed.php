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
		<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">推荐位管理</strong> / <small>推荐位列表</small></div>
	</div>
	<div class="am-g">
		<div class="am-u-sm-12">
			<table class="am-table am-table-striped am-table-hover table-main">
				<thead>
				<tr>
					<th>ID</th>
					<th>推荐位位置</th>
					<th>推荐位描述</th>
					<th>更新时间</th>
					<th>状态</th>
					<th>操作</th>
				</tr>
				</thead>
				<tbody>
				<?php if(is_array($commentList)): $i = 0; $__LIST__ = $commentList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$role): $mod = ($i % 2 );++$i;?><tr>
						<td><?php echo ($role["id"]); ?></td>
						<td><?php echo ($role["location"]); ?></td>
						<td><?php echo ($role["description"]); ?></td>
						<td><?php echo ($role["update_at"]); ?></td>
						<td>
							<?php if($role["status"] == 1): ?><a href="/index.php/../Tadm/Commend/modifyCommend/id/<?php echo ($role["id"]); ?>/status/0"><span style="color:green;" onclick="alert('确认关闭推荐位？')">开启</span></a>
								<?php else: ?>
								<a href="/index.php/../Tadm/Commend/modifyCommend/id/<?php echo ($role["id"]); ?>/status/1"><span style="color:red;" onclick="alert('确认开放推荐位？')">关闭</span></a><?php endif; ?>
						</td>
						<td>
							<a href="/index.php/../Tadm/Commend/updateCommend/id/<?php echo ($role["id"]); ?>">资源修改</a>
						</td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
			<hr />
			<p></p>
		</div>
	</div>
	<!-- content end -->
</div>
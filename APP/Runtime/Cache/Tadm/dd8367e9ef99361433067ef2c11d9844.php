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
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">权限控制</strong> / <small>管理员列表</small></div>
    </div>
    <div class="am-g">
      <div class="am-u-sm-12">
        <table class="am-table am-table-striped am-table-hover table-main">
            <thead>
              <tr>
                <th>ID</th>
                <th>用户名</th>
               <?php if(empty($group_id)): else: ?>
                <th>当前组</th><?php endif; ?> 
                <th>所属组</th>
                <th>状态</th>
                <th style="text-align:center; width:21%;" >操作</th>
              </tr>
          </thead>
          <tbody>
          <?php if(is_array($users)): $i = 0; $__LIST__ = $users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
              <td><?php echo ($user["uid"]); ?></td>
              <td><?php echo ($user["uname"]); ?></td>
              <?php if(empty($group_id)): else: ?>
                <td><?php echo (getGroupTitle($group_id)); ?></td><?php endif; ?> 
              
              <td><?php echo (getUserGroups($user["uid"])); ?></td>
              <td><?php if($user["sta"] == 1): ?><span style="color:green;">开启</span><?php else: ?><span style="color:red;">关闭</span><?php endif; ?></td>
            <?php if($user['uid'] != 1): ?><td align="center">
                <a href="<?php echo U('Authority/userEdit', "uid=$user[uid]");?>" class="am-btn am-btn-default am-btn-xs am-text-secondary am-icon-pencil-square-o">编辑</a>
                <?php if(empty($group_id)): ?><a href="<?php echo U('Authority/userDel', "uid=$user[uid]");?>" onclick="return confirm('确实要删除吗?')" class="am-btn am-btn-default am-btn-xs am-text-danger am-icon-pencil-square-o">删除</a>
                <?php else: ?>
                  <a href="<?php echo U('Authority/removeCrew',['uid'=>$user[uid],'group_id'=>$group_id]);?>" onclick="return confirm('确实要移除吗?')" class="am-btn am-btn-default am-btn-xs am-text-danger am-icon-pencil-square-o">从该组移除</a><?php endif; ?>
              </td>
              <?php else: ?>
                 <td align="center">
                    <span class="am-btn am-btn-default am-btn-xs am-text-secondary am-icon-pencil-square-o">不可操作</span>
                  </td><?php endif; ?>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
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
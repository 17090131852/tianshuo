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
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">节点管理</strong> / <small>节点列表</small></div>
    </div>
    <div class="am-g">
      <div class="am-u-sm-12">
        <table class="am-table am-table-striped am-table-hover table-main">
            <thead>
              <tr>
                <th>ID</th>
                <th>父ID</th>
                <th>标题</th>
                <th>模块</th>
                <th>方法</th>
                <!-- <th>参数</th> -->
                <th>状态</th>
                <th>排序</th>
                <th>层级</th>
                <th>备注</th>
                <th>操作</th>
              </tr>
          </thead>
          <tbody>
            <?php if(is_array($treeArr)): $i = 0; $__LIST__ = $treeArr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tvo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($tvo["id"]); ?></td>
                <td><?php echo ($tvo["pid"]); ?></td>
                <td style="text-align:left;"><?php echo ($tvo["title"]); ?></td>
                <td><?php echo ($tvo["model"]); ?></td>
                <td><?php echo ($tvo["action"]); ?></td>
                <!-- <td><?php echo ($tvo["param"]); ?></td> -->
                <td><?php echo (getSta($tvo["sta"])); ?></td>
                <td><?php echo ($tvo["ord"]); ?></td>
                <td><?php echo ($tvo["level"]); ?></td>
                <td><?php echo ($tvo["remark"]); ?></td>
                <td>
                  <a href="/index.php/../Tadm/Node/edit/id/<?php echo ($tvo["id"]); ?>">[改]</a> / 
                  <a href="/index.php/../Tadm/Node/del/id/<?php echo ($tvo["id"]); ?>" onclick="if(confirm('确定删除[<?php echo ($cvo["title"]); ?>]?')==false){ return false; }">[删]</a>
                </td>
              </tr>
              <?php if(is_array($tvo["child"])): $i = 0; $__LIST__ = $tvo["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cvo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($cvo["id"]); ?></td>
                <td><?php echo ($cvo["pid"]); ?></td>
                <td style="text-align:left;padding-left:2em">|-<?php echo ($cvo["title"]); ?></td>
                <td><?php echo ($cvo["model"]); ?></td>
                <td><?php echo ($cvo["action"]); ?></td>
                <!-- <td><?php echo ($cvo["param"]); ?></td> -->
                <td><?php echo (getSta($cvo["sta"])); ?></td>
                <td><?php echo ($cvo["ord"]); ?></td>
                <td><?php echo ($cvo["level"]); ?></td>
                <td><?php echo ($cvo["remark"]); ?></td>
                <td>
                  <a href="/index.php/../Tadm/Node/edit/id/<?php echo ($cvo["id"]); ?>">[改]</a> / 
                  <a href="/index.php/../Tadm/Node/del/id/<?php echo ($cvo["id"]); ?>" onclick="if(confirm('确定删除[<?php echo ($cvo["title"]); ?>]?')==false){ return false; }">[删]</a>
                </td>
              </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
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
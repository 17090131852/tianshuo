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
    <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">节点管理</strong> / <small>添加节点</small></div>
  </div>
  <form action="<?php echo U('Node/Edit');?>" method="post">
  <input type="hidden" name="id" value="<?php echo ($nodeInfo["id"]); ?>" />
  <table id="add">
    <tr>
      <td>节点名称：</td>
      <td><input type="text" name="title" value="<?php echo ($nodeInfo["title"]); ?>"></td>
    </tr>
    <tr>
      <td>　控制器：</td>
      <td><input type="text" name="model" value="<?php echo ($nodeInfo["model"]); ?>"></td>
    </tr>
    <tr>
      <td>　　方法：</td>
      <td><input type="text" name="action" value="<?php echo ($nodeInfo["action"]); ?>"></td>
    </tr>
    <tr>
      <td>方法参数：</td>
      <td><input type="text" name="parma" value="<?php echo ($nodeInfo["parma"]); ?>"></td>
    </tr>
    <tr>
      <td>父级节点：</td>
      <td>
        <select name="pid" id="">
          <option value="1">新增父级</option>
          <?php if(is_array($nodes)): $i = 0; $__LIST__ = $nodes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$node): $mod = ($i % 2 );++$i;?><option value="<?php echo ($node["id"]); ?>"><?php echo ($node["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>节点描述：</td>
      <td><input type="text" name="remark" value="<?php echo ($nodeInfo["remark"]); ?>"></td>
    </tr>
    <tr>
      <td>　　层级：</td>
      <td><input type="text" name="level" value="<?php echo ($nodeInfo["level"]); ?>"></td>
    </tr>
    <tr>
      <td>　　排序：</td>
      <td><input type="text" name="ord" value="<?php echo ($nodeInfo["ord"]); ?>"></td>
    </tr>
    <tr>
      <td>　　状态：</td>
      <td><input type="radio" name="sta" value="1" <?php if($nodeInfo["sta"] == 1): ?>checked="checked"<?php endif; ?> > 正常 　<input type="radio" name="sta" value="2" <?php if($nodeInfo["sta"] == 2): ?>checked="checked"<?php endif; ?>> 禁用</td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" value="确定修改"></td>
    </tr>
  </table>
  </form>
</div>

<script>
$("select[name=pid]").val(<?php echo ($nodeInfo["pid"]); ?>)


</script>
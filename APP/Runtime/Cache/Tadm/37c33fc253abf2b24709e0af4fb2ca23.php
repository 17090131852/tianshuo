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
    .upForm{  }
    .upForm input{ margin-top:1em; }
    .iptFile{ display:inline }
</style>
<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">充值管理</strong> / <small>线下充值导入</small></div>
    </div>
    <div class="am-g">
        <div class="am-u-sm-12">
            <a class="btn btn-success" href="javascript:;" onclick="addnode();">添加文件</a>
            <form class="upForm" method="post" action="<?php echo U('Member/batchRecharge');?>" enctype="multipart/form-data">
                <input type="submit" class="btn btn-success" value="提交" />
            </form>
        </div>
    </div>
    <!-- content end -->
</div>
<script>
    var i=1;
    var g='excel'
    function addnode(){
        //console.log(123);
        $('form').append('<input type="file" class="iptFile" name='+g+''+i+' value='+i+++' />');
    }
</script>
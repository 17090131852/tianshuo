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
<script src="/Public/Admin/js/jquery.datetimepicker.js"></script>

<style type="text/css">

    .custom-date-style {
        background-color: red !important;
    }
    .check{
        margin-bottom: 20px;
    }
    .check td{
        width: 100px;
        height: 40px;
        text-align: right;
    }
    .check input{
        height:30px;
    }
    .check select{
        width: 100px;
        height: 40px;
        text-align: right;
    }

    #check_title{
        margin-left: 10px;
    }
</style>
<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">商品管理</strong> / <small>商品列表</small></div>
    </div>
    <div class="check">
        <div class="am-cf am-padding">
            <div class="am-fl am-cf" id="check_title"><middle class="am-text-primary am-text-lg">商品查询<middle/></div>
        </div>
        <form action="/Tadm/Goods/index" method="post">
            <table>
                <tr>
                    <td>商品编号：</td>
                    <td class="check_left"><input name="goods_code" value="<?php echo ($goods_code); ?>"></td>
                    <td>商品名称：</td>
                    <td><input name="goods_name" value="<?php echo ($goods_name); ?>"></td>
                    <td>状态：</td>
                    <td style="text-align: left">
                        <select name="is_show">
                            <option value="0" <?php if($is_show==0):?>selected<?php endif;?>>--请选择--</option>
                            <option value="1" <?php if($is_show==1):?>selected<?php endif;?>>下架</option>
                            <option value="2" <?php if($is_show==2):?>selected<?php endif;?>>上架</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>开始时间：</td>
                    <td>
                        <input name="start_time" type="text"  readonly="true" value="<?php echo ($start_time); ?>" id="datetimepicker"> </td>
                    <td>结束时间：</td>
                    <td>
                        <input name="end_time" type="text" readonly="true" value="<?php echo ($end_time); ?>" id="datetimepicker1"> </td>

                    </td>
                </tr>
                <tr><td></td><td></td><td><td></td><td></td><td></td><td></td> <td><input type="submit" value="提交" /></td></tr>
            </table>
        </form>
    </div>
    <div class="am-g">
        <div class="am-u-sm-12">
            <table class="am-table am-table-striped am-table-hover table-main">
                <thead>
                <tr>
                    <th>序号</th>
                    <th>商品编号</th>
                    <th>商品名称</th>
                    <th>商品价格</th>
                    <th>商品积分</th>
                    <th>商品总数量</th>
                    <th>商品可销售数量</th>
                    <!--<th>是否是热品</th>-->
                    <!--<th>是否是新品</th>-->
                    <th>添加时间</th>
                    <th>状态</th>
                    <th>分类</th>
                    <th>商品类型</th>
                    <!--<th>是否赠送积分</th>-->
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><tr>
                        <td><?=$key+1?></td>
                        <td><?php echo ($value["goods_code"]); ?></td>
                        <td><?php echo ($value["goods_name"]); ?></td>
                        <td><?php echo ($value["goods_price"]); ?></td>
                        <td><?php echo ($value["goods_score"]); ?></td>
                        <td><?php echo ($value["goods_num"]); ?></td>
                        <td><?php echo ($value["goods_sale_num"]); ?></td>
                        <!--<td><?php echo ($value["is_hot"]); ?></td>-->
                        <!--<td><?php echo ($value["is_new"]); ?></td>-->
                        <td><?php echo ($value["add_time"]); ?></td>
                        <td><?php if($value['is_show']==1):?>上架<?php else:?>下架<?php endif;?></td>
                        <td><?php echo (getCategoryName($value["cat_id"])); ?></td>
                        <td><?php if($value['is_real']==1):?>实物商品<?php else:?>虚拟商品<?php endif;?></td>
                        <!--<td><?php echo ($value["give_score"]); ?></td>-->
                        <td>
                            <a href="/index.php/Tadm/Goods/view?id=<?php echo ($value["goods_id"]); ?>">[查看]</a>
                            <?php if($value['is_show']!=0):?>
                            <a href="/index.php/Tadm/Goods/add?id=<?php echo ($value["goods_id"]); ?>">[编辑]</a>
                            <?php endif;?>
                            <?php if($value['is_show']==0):?>
                            <a href="/index.php/Tadm/Goods/changeStatus?id=<?php echo ($value["goods_id"]); ?>&isshow=1">[上架]</a>
                            <?php elseif($value['is_show']==1):?>
                            <a href="/index.php/Tadm/Goods/changeStatus?id=<?php echo ($value["goods_id"]); ?>&isshow=0">[下架]</a>
                            <?php endif;?>
                        </td>
                    </tr><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
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
<script>
    $('#datetimepicker').datetimepicker({
        formatTime:'H:i',
        formatDate:'d.m.Y',
        //defaultDate:'8.12.1986', // it's my birthday
        defaultDate:'+03.01.1970', // it's my birthday
        defaultTime:'10:00',
        timepickerScrollbar:false
    });
    $('#datetimepicker1').datetimepicker({
        formatTime:'H:i',
        formatDate:'d.m.Y',
        //defaultDate:'8.12.1986', // it's my birthday
        defaultDate:'+03.01.1970', // it's my birthday
        defaultTime:'10:00',
        timepickerScrollbar:false
    });
</script>
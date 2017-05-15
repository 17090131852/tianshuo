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
<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">用户管理</strong> /
            <small>用户列表</small>
        </div>
    </div>
    <div class="am-g">
        <div class="am-u-sm-12">
            <form action="<?php echo U('Member/index');?>" method="post" style="margin-bottom: 1em">
                <table>
                    <tr>
                        <td class="col-lg-3 col-xs-12 col-sm-3 col-md-3">
                            <label>用户编号：</label>
                            <input class="iptText rds5" type="text" name="msn" value="<?php echo ($msn); ?>">
                        </td>
                        <td class="col-lg-3 col-xs-12 col-sm-3 col-md-3">
                            <label>&nbsp;&nbsp;用户昵称：</label>
                            <input class="iptText rds5" type="text" name="nickname" value="<?php echo ($nickname); ?>">
                        </td>
                        <td class="col-lg-3 col-xs-12 col-sm-3 col-md-3">
                            <label>&nbsp;&nbsp;手机号码：</label>
                            <input class="iptText rds5" type="text" name="mobile_phone" value="<?php echo ($mobile_phone); ?>">
                        </td>
                        <td class="col-lg-3 col-xs-12 col-sm-3 col-md-3">
                            <label>&nbsp;&nbsp;推荐人：</label>
                            <input class="iptText rds5" type="text" name="recom_mobile" value="<?php echo ($recom_mobile); ?>">&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>

                    </tr>
                    <tr>
                        <td class="col-lg-3 col-xs-12 col-sm-3 col-md-3">
						<span class="flatSelect">
						<select data-criteria="equal" name="type" class="rds5">
							<option value="0">用户类型</option>
							<option value="1"  <?php if($level == 1): ?>selected="selected"<?php endif; ?> >众筹股东</option>
                            <option value="2"  <?php if($level == 2): ?>selected="selected"<?php endif; ?>>总代理</option>
                            <option value="3"  <?php if($level == 3): ?>selected="selected"<?php endif; ?>>VIP会员</option>
                            <option value="4"  <?php if($level == 4): ?>selected="selected"<?php endif; ?>>普通会员</option>
						</select>
						</span>&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                        <td class="col-lg-3 col-xs-12 col-sm-3 col-md-3">
						<span class="flatSelect">
						<select data-criteria="equal" name="sta" class="rds5">
							<option value="0">用户状态</option>
							<option value="1"  <?php if($level == 1): ?>selected="selected"<?php endif; ?>>正常</option>
                            <option value="2"  <?php if($level == 2): ?>selected="selected"<?php endif; ?>>异常</option>
                            <option value="3"  <?php if($level == 3): ?>selected="selected"<?php endif; ?>>封禁</option>
						</select>
						</span>
                        </td><td></td><td></td><td class="col-lg-3 col-xs-12 col-sm-3 col-md-3">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input style="margin: 0 0 0 .4em;border-radius: 5px" type="submit"
                                                       value="提交">
                    </td>
                    </tr>
                </table>
            </form>
            <table class="am-table am-table-striped am-table-hover table-main">
                <thead>
                <tr>
                    <th>用户编号</th>
                    <th>昵称</th>
                    <th>手机号</th>
                    <th>推荐人</th>
                    <th>注册时间</th>
                    <th>会员状态</th>
                    <th>会员申请类型</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($memberList)): $i = 0; $__LIST__ = $memberList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mvo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($mvo["msn"]); ?></td>
                        <td><?php echo ($mvo["nickname"]); ?></td>
                        <td><?php echo ($mvo["mobile_phone"]); ?></td>
                        <td><?php echo ($mvo["recom_mobile"]); ?></td>
                        <td><?php echo (date('Y-m-d H:i',$mvo["reg_time"])); ?></td>
                        <td><?php echo (getSta($mvo["sta"])); ?></td>
                        <td><?php echo (getMemType($mvo["type"])); ?></td>
                        <td>
                            <?php if($mvo['acount_sta']==1): ?>
                            <?php if($mvo['type']==1):?>
                            <a href="/index.php/Tadm/Memberoperation/audit/?id=<?php echo ($mvo["mid"]); ?>">[开通股东会员]</a>
                            <?php endif;?>
                            <?php if($mvo['type']==2):?>
                            <a href="/index.php/Tadm/Memberoperation/audit/?id=<?php echo ($mvo["mid"]); ?>">[开通总代会员]</a>
                            <?php endif;?>
                            <?php if($mvo['type']==3):?>
                            <a href="/index.php/Tadm/Memberoperation/audit/?id=<?php echo ($mvo["mid"]); ?>">[开通VIP会员]</a>
                            <?php endif;?>
                            <?php if($mvo['type']==4):?>
                            <a href="/index.php/Tadm/Memberoperation/audit/?id=<?php echo ($mvo["mid"]); ?>">[普通会员]</a>
                            <?php endif;?>
                            <a href="/index.php/Tadm/Member/del/?id=<?php echo ($mvo["mid"]); ?>">删除</a>
                            <?php elseif($mvo['acount_sta']==2): ?>
                            [已交费]
                            <?php endif;?>

                        </td>
                    </tr>
                    <!--<?php if(is_array($tvo["child"])): $i = 0; $__LIST__ = $tvo["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cvo): $mod = ($i % 2 );++$i;?>-->
                    <!--<tr>-->
                    <!--<td><?php echo ($cvo["id"]); ?></td>-->
                    <!--<td><?php echo ($cvo["pid"]); ?></td>-->
                    <!--<td style="text-align:left;padding-left:2em">|-<?php echo ($cvo["title"]); ?></td>-->
                    <!--<td><?php echo (getSta($cvo["sta"])); ?></td>-->
                    <!--<td><?php echo ($cvo["ord"]); ?></td>-->
                    <!--<td><?php echo ($cvo["intr"]); ?></td>-->
                    <!--<td>-->
                    <!--<a href="/index.php/../Tadm/category/edit/id/<?php echo ($cvo["id"]); ?>">[改]</a> |-->

                    <!--</td>-->
                    <!--</tr>-->
                    <!--<?php endforeach; endif; else: echo "" ;endif; ?>--><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <div class="am-cf page">
                <?php echo ($page); ?>
            </div>

            <hr/>
            <p></p>
        </div>
    </div>
    <!-- content end -->
</div>
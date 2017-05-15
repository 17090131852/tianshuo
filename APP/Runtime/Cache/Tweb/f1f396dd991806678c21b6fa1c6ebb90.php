<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>个人中心</title>
	<meta name="description" content="用户个人中心" />
	<meta name="keywords" content="天朔 天朔电动汽车 山西天朔 天朔汽车 电动未来 天朔电动 电动汽车 " />
	<link rel="stylesheet" href="/Public/Style/Reset.css" />
	<link rel="stylesheet" href="/Public/Plugin/Bootstrap/bootstrap.min.css"/>
	<link rel="stylesheet" href="/Public/Style/Common.css" />
	<!--[if lte IE 6]><script src="/skin/js/letskillie6.zh_cn.pack.js"></script><![endif]-->
	<script src="/Public/Script/jquery-1.9.1.min.js"></script>
	<script src="/Public/Plugin/Bootstrap/bootstrap.min.js"></script>
</head>
<body>
<style>

	.familyTree{ margin-top:2em; }
	.pageTitle{ line-height:2em; color:#1ea78d; font-size:1.25em; margin-top:2em; }
	.iptText{ padding: .4em .6em; }
	.iptBtn { padding: .4em 1.5em; }
	.flatSelect{ border:1px solid #ddd; overflow:hidden; font-size:.875em; }
	.flatSelect select{ padding: .5em 1em;border: 1px solid #0eb493;}
	.listTable{ margin-top:2em; }
	.listTable tr th { height:2em; text-align:center; background:#1ea78d; border: 1px solid #fff; color: #fff; }
	.listTable tr td{ border:1px solid #ddd; font-size:.875em; line-height:2em; text-align:center;}
	@media screen and (max-width: 425px) {
			.flatSelect select { margin: .5em 0; }
			.CenterPhone { text-align: center; }
		}
</style>
<style>
	.headArea{  line-height:40px; font-size:.875em; border-bottom:1px solid #062033; margin: 0; background: #0eb493;}
	.logout{ line-height:40px; }
	.memBasic { float: left; padding-left: 1em; }
	.logout { float: right;padding-right: 1em; }
	.memBasic img{ margin:0 auto;}
	.memBasic p{ margin-bottom: 0; color: #fff; }
	.memBasic a,.logout a{ color: #fff; }
	.logout a:hover{ color: red; }
	.nav{ margin:0; padding:0}
	.nav .open>a, .nav .open>a:hover, .nav .open>a:focus{ border-color:#35bca1; }

	.nav-tabs>li>a{ color: #333;padding: .8em 1em; text-align: right;}
	.nav-tabs>li{margin:2px; width: 138px;}
	/*顶部 返回首页 退出 种子会员*/
	.logout i,.backIndex i { position: relative; top: 4px; display: inline-block; width: 20px; height: 18px; }
	.logoutIcon { background: url("/Public/Images/Tweb/logout.png") no-repeat 2px 2px; }
	.backIndexIcon { background: url("/Public/Images/Tweb/backIndex.png") no-repeat 0 0; }
	.seedMember { background: url("/Public/Images/Tweb/seedMember.png") no-repeat 0 0; }
	.backIndex a:hover { color: #fff; }
	.lineBar { display: inline-block; color: #fff; padding: 0 .4em 0 1em; }
	.nav-tabs { margin-top: 1.6em; }
</style>

<div class="headArea">
	<div class="container">
		<div class="row">
			<div class="memBasic">
				<p><a href="<?php echo U('Member/view');?>" title="<?php echo (session('nickname')); ?>"><?php echo (msubstr(session('nickname'),0,4)); ?></a>[<?php echo (getMemType(getMemberType(session('msn')))); ?>]</p>
			</div>
			<div class="logout">
				<i class="logoutIcon"></i>
				<a href="<?php echo U('Public/logout');?>">退出</a>
			</div>
			<div class="logout backIndex">
				<i class="backIndexIcon"></i> 
				<a href="<?php echo U('Member/index');?>"> 返回首页</a>
				<span class="lineBar">/</span>
			</div>
			<!-- <div class="logout backIndex">
				<i class="seedMember"></i> 
				<a href="<?php echo U('Public/addSeed');?>"> 种子会员</a>
				<span class="lineBar">/</span>
			</div> -->
		</div>
	</div>
</div>
<div class="container">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<!-- 轮播图 按钮 -->
		<ol class="carousel-indicators">
			<?php if(is_array($resourceList)): $i = 0; $__LIST__ = $resourceList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li data-target="#carousel-example-generic" data-slide-to="<?php echo ($i-1); ?>" class="<?php if($key == 1 ): ?>active<?php endif; ?>"></li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ol>
		<!-- 轮播图 内容 -->
		<div class="carousel-inner">
			<?php if(is_array($resourceList)): $i = 0; $__LIST__ = $resourceList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div class="item <?php if($i == 1 ): ?>active<?php endif; ?>">
					<img class="img-responsive center-block" src="<?php echo ($item["url"]); ?>" alt="<?php echo ($item["resource_desc"]); ?>" title="天朔活动1" />
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<!-- 左右滑动按钮 -->
		<a class="carousel-control left" href="#carousel-example-generic" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control right" href="#carousel-example-generic" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>
<!-- 导航条描边样式 -->
<style type="text/css">
	.navNewMember { border: 2px solid rgb(66, 176, 216); }
	.navAccData { border: 2px solid rgb( 63, 187, 155); }
	.navCarSupermaket {border: 2px solid rgb(141,192,88);}
	.navOder {border: 2px solid rgb(238,171,171);}
	.navReport {border: 2px solid rgb(239, 189, 125);}
	.navHistory {border: 2px solid rgb(252, 141, 107) ;}
	.navMoney {border: 2px solid rgb( 224, 100, 83);}
	.navStore {border: 2px solid rgb( 239, 44, 44);}

	.nav-tabs>li>a { margin-right: 0; width: 134px; }
	.nav-tabs li i { position: relative;left: 0px; bottom: 5px; float: left; display: inline-block; }
	.memberIcon { background: url("/Public/Images/Tweb/memberNavIcon.png") no-repeat 0 0; width: 32px;height: 27px; }/*新会员*/
	.dataIcon { background: url("/Public/Images/Tweb/memberNavIcon.png") no-repeat -34px -2px; width: 35px;height: 26px; }/*账户资料*/
	.superMaketIcon { background: url("/Public/Images/Tweb/memberNavIcon.png") no-repeat -69px -2px; width: 32px;height: 27px; }/*汽车超市*/
	.oderIcon { background: url("/Public/Images/Tweb/memberNavIcon.png") no-repeat -102px -1px; width: 32px;height: 29px; }/*订单*/
	.reportIcon { background: url("/Public/Images/Tweb/memberNavIcon.png") no-repeat 0 -29px; width: 25px;height: 27px; }/*报告*/
	.historyIcon { background: url("/Public/Images/Tweb/memberNavIcon.png") no-repeat -24px -29px; width: 24px;height: 27px; }/*奖励历史*/
	.moneyIcon { background: url("/Public/Images/Tweb/memberNavIcon.png") no-repeat -48px -30px; width: 27px;height: 28px; }/*电子钱包*/
	.storeIcon { background: url("/Public/Images/Tweb/memberNavIcon.png") no-repeat -75px -30px; width: 36px;height: 28px; }/*积分商城*/
</style>
<!--导航条-->
<div class="container">
<ul class="row nav nav-tabs col-lg-12 clearfix">
	<li class="navNewMember"><a href="<?php echo U('Member/add');?>"><i class="memberIcon"></i>新会员</a></li>
	<li class="navAccData" role="presentation" class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;" role="button" aria-haspopup="true" aria-expanded="false">
		<i class="dataIcon"></i>
			帐户资料<span class="caret"></span>
		</a>
		<ul class="dropdown-menu">
			<li> <a href="<?php echo U('Member/view');?>">个人资料</a> </li>
			<li><a href="<?php echo U('Member/postAddr');?>">收货地址</a></li>
			<li><a href="<?php echo U('Member/changePwd');?>">修改密码</a></li>
		</ul>
	</li>
	<li role="presentation" class="navCarSupermaket dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;" role="button" aria-haspopup="true" aria-expanded="false">
			<i class="superMaketIcon"></i>汽车超市<span class="caret"></span>
		</a>
		<ul class="dropdown-menu">
			<li><a href="<?php echo U('MotoType/index');?>"><span></span>车型总览</a></li>
			<li><a href="<?php echo U('MotoType/testDrive');?>"><span></span>预约试驾</a></li>
		</ul>
	</li>
	<li class="navOder" role="presentation" class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;" role="button" aria-haspopup="true" aria-expanded="false">
			<i class="oderIcon"></i>
			订单<span class="caret"></span>
		</a>
		<ul class="dropdown-menu">
			<li><a href="<?php echo U('Agents/order');?>">历史订单</a></li>
			<!--li><a href="<?php echo U('Agents/orderList');?>">积分订单</a></li-->
		</ul>
	</li>
	<li class="navReport" role="presentation" class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;" role="button" aria-haspopup="true" aria-expanded="false">
		<i class="reportIcon"></i>
			报告<span class="caret"></span>
		</a>
		<ul class="dropdown-menu">
			<li> <a href="<?php echo U('Agents/report');?>">下属报告</a></li>
			<li> <a href="<?php echo U('Agents/family');?>">家谱树</a></li>
		</ul>
	</li>
	<li class="navHistory"><a href="<?php echo U('Wallet/index');?>"><i class="historyIcon"></i>奖励历史</a></li>
	<li class="navMoney"><a href="<?php echo U('Award/index');?>"><i class="moneyIcon"></i>电子钱包</a></li>
	<li class="navStore"><a href="<?php echo U('Imall/index');?>"><i class="storeIcon"></i>积分商城</a></li>

</ul>
</div>
<section class="container">
	<h1 class="pageTitle">
		历史订单
	</h1>
	<div class="familyTree">
		<ul class="row">
			<form action="/Agents/order" method="post">
				<li class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<label>订单编号：</label>
					<input class="iptText rds5" type="text" name="order_sn" value="<?php echo ($order_sn); ?>">
				</li>
				<li class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
						<span class="flatSelect">
							<select  data-criteria="equal" name="level" class="rds5" >
								<option value="0">请选择</option>
								<option value="1"  <?php if($sta == 1): ?>selected="selected"<?php endif; ?> >正常</option>
								<option value="2"  <?php if($sta == 2): ?>selected="selected"<?php endif; ?> >封禁</option>
								<option value="3"  <?php if($sta == 3): ?>selected="selected"<?php endif; ?> >异常</option>
							</select>
						</span>
				</li>
				<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12 CenterPhone">
					<input class="iptBtn rds5" type="submit" value="提交">
				</li>
			</form>
		</ul>
		<div class="table-responsive">
		<table class="listTable table-hover table">
			<thead>
				<tr>
					<th class="sorting_desc" tabindex="0" aria-controls="datatable-generation-tree-report" rowspan="1" colspan="1" aria-label="订单编号" aria-sort="descending">
						订单编号
					</th>
					<th class="sorting_desc" tabindex="0" aria-controls="datatable-generation-tree-report" rowspan="1" colspan="1" aria-label="订单状态" aria-sort="descending">
						订单状态
					</th>
					<th class="sorting_desc" tabindex="0" aria-controls="datatable-generation-tree-report" rowspan="1" colspan="1" aria-label="订单日期" aria-sort="descending">
						订单日期
					</th>
					<th class="sorting_desc" tabindex="0" aria-controls="datatable-generation-tree-report" rowspan="1" colspan="1" aria-label="收货人姓名" aria-sort="descending">
						收货人姓名
					</th>
					<th class="sorting_desc" tabindex="0" aria-controls="datatable-generation-tree-report" rowspan="1" colspan="1" aria-label="消费积分" aria-sort="descending">
						消费积分
					</th>
				</tr>
			</thead>
			<?php if(is_array($orderList)): $i = 0; $__LIST__ = $orderList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$al): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($al["order_sn"]); ?></td>
					<td><?php echo (getOfflineOrderSta($al["sta"])); ?></td>
					<td><?php echo (date("Y-m-d H:i:s",$al["ctime"])); ?></td>
					<td><?php echo ($al["remark"]); ?></td>
					<td><?php echo ($al["total"]); ?></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
		</div>
	</div>
</section>
	<style>
		footer{margin-top:2em; border-top: 5px solid #062033; background: #1ea78d;}
		footer .FirmBottom{ margin: 0 auto;}
		footer .FirmBottom ul li{ font-size: .875em; padding-left:0;}
		footer .FirmBottom ul li a{ color: #fff;}
		footer .FirmBottom .FirmCall{padding-top: 20px; color: #fff;}
		footer .FirmBottom .FirmCall ol{ font-size: .875em; }
		footer .FirmBottom .FirmCall ol li{ padding-left:0; margin-left:0; line-height:2.5em; }
		footer .FirmBottom .FirmCall ol li a{ padding-left:0; color: #fff; font-size: 1em; }
		footer .FirmBottom .FirmCall ol li span{ padding-left:0; }
		footer .FirmCopy{text-align: center; font-size: .875em;}
		footer .FirmCopy p{padding-top: 8px; padding-bottom:8px; color: #fff;}
		footer .row{margin-left: 0; margin-right: 0; margin: 0 auto;}
		footer .FirmLogo img{width: 158px; padding-bottom: 1em;}
		footer .FirmLogo span{color: #fff; font-size: .75em;}
		footer .FirmLogo a{display: block; margin-top: 1.6em;}
		footer .AttenTion p{float: left; margin-right: 30px; display: inline-block; text-align: center; font-size: 1em; color: #fff;}
		footer .AttenTion p img{padding-bottom: 1em;}
	</style>
	<footer>
		<div class="container">
		<div class="row clearfix hidden-xs" style="margin-top:3em;">
			<div class="col-md-3 FirmLogo">
        <a href="<?php echo U('Index/index');?>">
        	<img src="/Public/Images/Tweb/logo_write.png" alt="天朔集团LOGO" title="天朔集团LOGO" />
        </a>
        <!-- <span>关于公司的简介，可以简单地说一下这个公司的一些内容。需要一些文案来填充</span> -->
	    </div>

	    <div class="col-md-7 FirmBottom clearfix">
				<ul>
					<li class="col-lg-2 col-sm-2"><a href="/index.php">网站首页</a></li>
					<li class="col-lg-2 col-sm-2"><a href="<?php echo U('Index/tsContactUs');?>">联系我们</a></li>
					<li class="col-lg-2 col-sm-2"><a href="javascript:;">隐私条款</a></li>
					<li class="col-lg-2 col-sm-2"><a href="javascript:;">版权声明</a></li>
					<li class="col-lg-2 col-sm-2"><a href="<?php echo U('Index/tsSitemap');?>">网站地图</a></li>
				</ul>
				<div class="FirmCall">
					<ol class="clearfix">
						<!--li>经销商专区<a href="javascript:;">经销商招募</a><a href="javascript:;">经销商登录</a></li-->
						<li class="col-lg-2 col-sm-2">
							<span>人才招聘：</span>
						</li>
						<li class="col-lg-2 col-sm-2">
							<a href="javascript:;">社会招聘</a>
							<!--a href="javascript:;">应聘帮助&nbsp;&nbsp;&nbsp;&nbsp;</a-->
						</li>
						<li class="col-lg-2 col-sm-2">
							<a href="javascript:;">校园招聘</a>
						</li>
						
					</ol>
					<ol class="clearfix">
						<li class="col-lg-2 col-sm-2">
							<span>联系我们：</span>
						</li>
						<li class="col-lg-4 col-sm-4">
							<a href="javascript:;">800-810-1100</a>
							<!--a href="javascript:;">在线客服</a-->
						</li>
					</ol>
				</div>
			</div>

	   	<div class="col-md-2 clearfix AttenTion">
				<!--p><img src="/Public/Tspc/Images/attention1.png" alt="" />微博关注</p-->
				<p><img src="/Public/Images/Tweb/attention2.png" alt="天朔集团-微信二维码" title="天朔集团-微信二维码" />微信关注</p>
			</div>
			</div>
		</div>

		<div class="FirmCopy clearfix">
			<p>Copyright &copy; <span>2016-2018</span> 天朔集团 版权所有 <span class="hidden-xs">ICP备案号：晋ICP备13008414号-3</span></p>
		</div>
		<!--回到顶部-->
		<link rel="stylesheet" href="/Public/Plugin/BackTop/backtop.css"/>
		<div class="go-top dn" id="go-top">
			<!-- <a href="javascript:;" class="uc-2vm"></a>
			<div class="uc-2vm-pop dn">
				<h2 class="title-2wm">扫一扫订阅</h2>
				<div class="logo-2wm-box">
					<img src="/Public/Images/Sys2.0/jmRead.jpg" alt="" width="100" height="100">
				</div>
			</div> -->
			<!--a href="javascript:;" target="_blank" class="feedback rds5"></a-->
			<a href="javascript:;" class="go rds5"></a>
		</div>
		<script src="/Public/Plugin/BackTop/backTop.js"></script>
	</footer>
</body>
</html>
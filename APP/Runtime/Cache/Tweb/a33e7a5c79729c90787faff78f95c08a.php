<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>天朔电动汽车有限公司</title>
	<meta name="keywords" content="天朔 天朔电动汽车 山西天朔 天朔汽车 电动未来 天朔电动 电动汽车 " />
	<meta name="description" content="山西天朔电动汽车有限公司隶属山西天朔集团，是一家集研发，设计，生产销售为一体的新能源电动汽车制造企业。我公司保持以节能减排为宗旨。按照汽车产品的新的设计理念，采用先进的轿车生产工艺和标准。结合乘用车辆配合的性能。打造国内先进的具有开发生产多种类型新能源，电动汽车为主的大型生产企业。" />
	<link rel="stylesheet" href="/Public/Style/Reset.css" />
	<link rel="stylesheet" href="/Public/Plugin/Bootstrap/bootstrap.min.css"/>
	<link rel="stylesheet" href="/Public/Style/Common.css" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	
	<!--[if lte IE 6]><script src="/skin/js/letskillie6.zh_cn.pack.js"></script><![endif]-->
	<script src="/Public/Script/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="/Public/Plugin/Bootstrap/bootstrap.min.js" type="text/javascript"></script>
	<style>
		.navbar-default{ padding:1.5em 0 1em 0; margin-bottom:0; background:#fff; border:0; }
		.nav li a:hover{ color:#3da654; border-bottom: 2px solid #3da654; }
		.LogoImg{ margin-left:1em; }
		.pullRight{ float:right; }
		.FirmTop{background: #0eb493;color: #fff; line-height: 2em;}
		.FirmTop a{color: #fff;}
		.navbar-nav li a { border-bottom: 2px solid #fff; }
		/*种子会员 样式*/
		.vipMember{ float: left; margin-right: 1em; }
		.logout i,.vipMember i { position: relative; top: 4px; display: inline-block; width: 20px; height: 18px; }
		.backIndexIcon { background: url("/Public/Images/Tweb/backIndex.png") no-repeat 0 0; }
		.seedMember { background: url("/Public/Images/Tweb/seedMember.png") no-repeat 0 0; }
		.vipMember a:hover { color: #fff; }
		.lineBar { display: inline-block; color: #fff; padding: 0 .4em 0 1em; }
	</style>
</head>
<body>
	<header class="clearfix">
		<div class="FirmTop clearfix ">
			<div class="MaxWidth container">
				<span>客服电话：4008916400</span>
				<span class="pullRight">
					<?php if($_SESSION['msn']== '' ): ?><a href="<?php echo U('Public/Login');?>">登录</a>
						<!--种子会员-->
						<?php if(is_array($entryStatus)): $i = 0; $__LIST__ = $entryStatus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i; if(($val["en_name"] == 'seed') AND ($val["status"] == 1)): ?><div class="logout vipMember">
								<i class="seedMember"></i>
								<a href="<?php echo U('Public/addSeed');?>"> 种子会员</a>
								<span class="lineBar">/</span>
							</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					<?php else: ?>
						<a href="<?php echo U('Public/logout');?>">退出</a> <a href="<?php echo U('Member/index');?>"> <?php echo (msubstr(session('nickname'),0,2)); ?></a><?php endif; ?>
				</span>
			</div>
		</div>
		
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">快捷菜单</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
						<!-- <div class="LogoImg">
							<a href="<?php echo U('Index/index');?>">
								<img src="/Public/Images/Tweb/logo.png" alt="天朔集团LOGO" title="天朔集团LOGO" />
							</a>
						</div> -->
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo U('Index/index');?>"><span></span>首页</a></li>
						<li role="presentation" class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;" role="button" aria-haspopup="true" aria-expanded="false">
								汽车超市<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo U('MotoType/index');?>"><span></span>车型总览</a></li>
								<li><a href="<?php echo U('MotoType/testDrive');?>"><span></span>预约试驾</a></li>
							</ul>
						</li>
						<li><a href="<?php echo U('About/afterService');?>"><span></span>售后服务</a></li>
						<li><a href="<?php echo U('News/index');?>"><span></span>会员中心</a></li>
						<li><a href="<?php echo U('About/index');?>"><span></span>关于天朔</a></li>
						<li><a href="<?php echo U('Imall/index');?>"><span></span>积分商城</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div><!--/.container-fluid -->
		</nav>
	</header>
	<style>
		.login{ height:600px; background:url(/Public/Images/Tweb/loginBg.jpg) no-repeat 10%; background-size:100% 600px; }
		.loginForm{ background:#fff; border-top:4px solid #0eb493; }
		.loginForm h1{ font-size:.875em; padding:1em 0 1em 0; color:#0eb493; border-bottom:1px solid #ddd; }
		.loginForm h1 span{ float:right; color:#333; }
		
		.iptTxt{ border:1px solid #ddd; text-indent:.5em; height:30px; }
		.iptBtn{ width:95%; height:36px; color:#fff; font-size:1.125em; margin-left:5%; background:#0eb493; border:1px solid #0eb493; }
		form{ padding-bottom:1.5em; }
		form ul li{ margin-top:1em; }
		form ul li img{ float:right; }
		form ul li .iptTxt{ width:100%; }
		
		.styled-select { width: 97%; height:30px; margin-left:3%; overflow: hidden; background: url(/Public/Images/Tweb/arrowDown.png) no-repeat right #fff; border-right:1px solid #ddd;}
		.styled-select select { background: transparent; width: 106%; padding: 5px; font-size: 16px; border: 1px solid #ddd; height: 40px;-webkit-appearance: none; /*for chrome*/ }
		
		@media screen and (min-width: 768px) {
			.loginForm{ width:360px; float:right; margin:60px 160px 0 0;}
		}
		
		@media screen and (max-width: 414px) {
			.login{ background:#fff; margin-top:2em;}
		}
		footer{
			margin-top: 0 !important;
		}
	</style>
	<section class="clearfix">
		<div class="login">
			<div class="container loginForm">
				<h1>注册 <span>已有帐号？<a href="<?php echo U('Public/login');?>">去登录</a></span></h1>
				<form action="<?php echo U('Public/register');?>" method="post">
					<ul class="row">
						<!--li class="col-lg-12 col-xs-12">
							<span class="col-lg-4 col-xs-4">昵称：</span>
							<span class="col-lg-8 col-xs-8"><input class="iptTxt rds5" type="text" name="nickname" /></span>
						</li-->
						<li class="col-lg-12 col-xs-12">
							<span class="col-lg-4 col-xs-4">手机号：</span>
							<span class="col-lg-8 col-xs-8"><input class="iptTxt rds5" type="text" name="mobile_phone" placeholder="手机号" /></span>
						</li>
						<!--li class="col-lg-12 col-xs-12">
							<span class="col-lg-4 col-xs-4">会员类型：</span>
							<span class="col-lg-8 col-xs-8">
								<div class="styled-select rds5">
									<select name="type">
										<option value="1">众筹股会员</option>
										<option value="2">合伙人</option>
										<option value="3">VIP会员</option>
									</select>
								</div>
							</span>
						</li-->
						<li class="col-lg-12 col-xs-12">
							<span class="col-lg-4 col-xs-4">密码：</span>
							<span class="col-lg-8 col-xs-8"><input class="iptTxt rds5" type="password" name="pwd" placeholder="6位以上密码" /></span>
						</li>
						<li class="col-lg-12 col-xs-12">
							<span class="col-lg-4 col-xs-4">确认密码：</span>
							<span class="col-lg-8 col-xs-8"><input class="iptTxt rds5" type="password" name="pwd1" placeholder="再次输入密码" /></span>
						</li>
						<li class="col-lg-12 col-xs-12">
							<span class="col-lg-4 col-xs-4">推荐手机：</span>
							<span class="col-lg-8 col-xs-8"><input class="iptTxt rds5" type="text" name="recom_mobile" placeholder="推荐人手机" value="<?php echo ($recomMobile); ?>"/></span>
						</li>
						<li class="col-lg-12 col-xs-12">
							<input class="iptBtn rds5" type="submit" value="注册" />
						</li>
					</ul>
				</form>
			</div>
		</div>
	</section>
	<script>
		function change_code(){
			$("#imgcode").attr('src',"<?php echo U('Public/webVerify');?>")
		}
	</script>
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
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
		section .Intro h2{padding-bottom: 1em; color: #0eb493; font-weight: bolder; font-size: 2em; padding-left: 15px;}
		section .Intro img{ padding-bottom: 35px;}
		section .Intro > div p{ text-indent: 2em; font-size: .75em; color: #666; line-height:1.8em;}
		@media screen and (max-width: 425px) {
			.OurPurpose img { margin: 0 auto; }
		}
		.navComm {background: #333;}
		.navComm ul li { text-align: center; }
		.navComm ul li a{ display: inline-block; border-bottom: 2px solid #333; margin-bottom: 0; }
		.navComm ul li .ThisActive { border-bottom: 2px solid #0eb493; color: #fff; }

		.AboutBanner { background:url("/Public/Images/Tweb/AboutBanner.jpg") no-repeat center center; height: 350px; padding-top: 2em;}
		.AboutBanner .PartL { margin-top: 2em; }
		.AboutBanner h2,.PartR h2,.OurAdv h2,.OurReason h2 { font-weight: bold; }
		.AboutBanner h2 span ,.PartR h2 span,.OurAdv h2 span,.OurReason h2 span { color: #0eb493;  }
		.AboutBanner p { color: #333;  }
		.AboutLogo { padding: 2em 0; }
		.OurPurpose { padding: 4em 0; }
		.OurAdv { padding: 4em 0; background: #f1f1f1; }
		.OurReason { margin-bottom: 2em; }
		.OurReason h2 { padding: 2em 0; }
		.OurReason h2,.OurReason img { margin: 0 auto; text-align: center;}
		.OurReason p { font-size: .875em;color: #666;line-height: 24px;margin-top: 1em; }

	</style>
	<div class="breadNav">
		<ol class="breadcrumb">
			<li>当前位置：</li>
			<li><a href="/index.php">主页</a></li>
			<li><a href="<?php echo U('About/index');?>">关于我们</a></li>
			<li class="active">天朔简介</li>
		</ol>
	</div>
	<section>
		<div class="navComm">
			<ul class="container clearfix">
				<li class="col-lg-2 col-md-2 col-sm-2 col-xs-2" >
					<a class="ThisActive" href="<?php echo U('About/index');?>">简介</a>
				</li>
				<li class="col-lg-2 col-md-2 col-sm-2 col-xs-2" >
					<a href="<?php echo U('About/honor');?>">荣誉</a>
				</li>
				<li class="col-lg-2 col-md-2 col-sm-2 col-xs-2" >
					<a href="<?php echo U('About/culture');?>">文化</a>
				</li>
				<li class="col-lg-2 col-md-2 col-sm-2 col-xs-2" >
					<a href="<?php echo U('About/develop');?>">发展</a>
				</li>
				<li class="col-lg-2 col-md-2 col-sm-2 col-xs-2" >
					<a href="<?php echo U('About/mien');?>">风采</a>
				</li>
			</ul>
		</div>
		<div class="container Intro clearfix">
			<h2>天朔简介</h2>
		</div>
		<!--天朔简介-->
		<div class="AboutBanner">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-6 col-lg-6">
						<div class="PartL">
							<h2><span>我们</span>是谁？</h2>
							<p>
								山西天朔电动汽车有限公司隶属于山西天朔集团<br />
		是一家集研发，设计，生产销售为一体的新能源电动汽车制造企业
							</p>
						</div>
					</div>
					<div class="col-xs-12 col-md-6 col-lg-6 hidden-xs">
	          <div class="AboutLogo">
	          	<img src="/Public/Images/Tweb/AboutLogo.png" alt="天朔集团LOGO" title="天朔集团LOGO" style="max-width:100%; margin: 0 auto;" />
	          </div>
					</div>
				</div>
			</div>
		</div>
		<!--我们的宗旨-->
		<div class="container">
			<div class="row">
				<div class="OurPurpose">
					<div class="col-xs-12 col-md-6">
						<img src="/Public/Images/Tweb/AboutPurpose.jpg" alt="我们的宗旨" title="我们的宗旨" style="max-width:100%;" />
					</div>
					<div class="col-xs-12 col-md-6">
						<div class="PartR">
								<h2>我们的<span>宗旨</span></h2>
								<p>
									公司保持以节能减排为宗旨，按照新能源汽车新的设计理念<br />
	采用先进的轿车生产工艺和技术标准<br />
	力争在未来借助公司全新的电池技术和汽车轻量化碳纤维车身平台<br />
	打造行业前端的新能源汽车
								</p>
							</div>
					</div>
				</div>
			</div>
		</div>
		<!--我们的优势-->
		<div class="OurAdv">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-6">
						<div class="PartL">
							<h2>我们的<span>优势</span></h2>
							<p>
								该项目已列入山西省十三五规划<br />
是全市产业转型的重要项目<br />
项目总投资15.8亿元，项目建成后<br />
可实现年产能电动汽车3万辆（单班）电动汽车
							</p>
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
	          <img src="/Public/Images/Tweb/AboutAd.jpg" alt="我们的优势" title="我们的优势" style="max-width:100%; margin: 4em auto;" />
					</div>
				</div>
			</div>
		</div>
		<!--选择我们的理由-->
		<div class="OurReason">
			<h2>选择我们的<span>理由</span></h2>
			<div class="container">
				<div class="row">
					<img class="col-md-12 col-sm-12 col-xs-12" src="<?php echo C('UPLOAD_SAVAPATH');?>/Test/address.jpg" alt="选择我们的理由" title="选择我们的理由" />
				</div>
				<p>
					公司占地600亩，公司具备汽车生产的四大工艺，有冲压、涂装、焊装、总装四大车间和汽车整车检测线一条、1个产品技术中心，1个占地80亩的车辆试验场，以及办公楼、科研楼、展区，宿舍、食堂等基础设施。公司主要产品为电动轿车，电动观光车，电动客车，电动公交车，电动环卫车，油电混合车等节能新能源汽车。
该项目已列入山西省十三五规划，是全市产业转型的重要项目；项目总投资15.8亿元，项目建成后，可实现年产能电动汽车3万辆（单班）电动汽车。
				</p>
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
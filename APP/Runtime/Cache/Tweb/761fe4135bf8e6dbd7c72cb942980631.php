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
		p{line-height:1.8em;}
		section .serviceIdea{ padding-top: 4em; padding-bottom: 3em; margin: 0 auto;}
		section .serviceIdea li{}
		section .serviceIdea .mTitle{height: 50px; border-bottom: 1px solid #9a9a9a;}
		section .serviceIdea .mTitle > span{color: #0eb493; font-size: 2.25em; display: block; float: left;}
		section .serviceIdea .mTitle > div{float: left; padding-left: 5px;}
		section .serviceIdea .mTitle > div > span:first-child{margin-top: 6px; color: #0eb493; display: block; font-size: 1em;}
		section .serviceIdea .mTitle > div > span:last-child{position: relative; top: 0px; color: #a1a1a1; font-size: .75em; line-height: .75em;}
		section .serviceIdea .mCon{padding-top: 15px;}
		section .serviceIdea .mCon p{font-size: .75em;  color: #666; }
		section .serviceIdea .mCon p span{background: #666; width: 4px; height: 4px; display: block; float: left; margin: 7px 0 0 -8px;}
		section .FirmMore{padding-left: 15px; margin-top:3em;}
		section .FirmMore h2{font-size: 2em; color: #0eb493; font-weight: bolder;}
		section .FirmMore p{font-size: .75em; color: #999;}
		.navComm {background: #333;}
		.navComm ul li { text-align: center; }
		.navComm ul li a{ display: inline-block; border-bottom: 2px solid #333; margin-bottom: 0; }
		.navComm ul li .ThisActive { border-bottom: 2px solid #0eb493; color: #fff; }
		/*服务流程 暂未开通弹出层 样式*/
		.modal-header .close { margin-top: -.4em; }
		.modal-body { font: 1em;color: #666; text-align: center; }
	</style>
	<div class="breadNav">
		<ol class="breadcrumb">
			<li>当前位置：</li>
			<li><a href="/index.php">主页</a></li>
			<li class="active">售后服务</li>
		</ol>
	</div>
	<section>
		<div class="navComm">
			<ul class="clearfix container">
				<li class="col-lg-4 col-xs-4">
					<a class="ThisActive disabled" href="<?php echo U('About/afterService');?>">服务理念</a>
				</li>
				<li class="col-lg-4 col-xs-4">
					<a data-toggle="modal" data-target=".bs-example-modal-sm" href="javascript:;">服务流程</a>
				</li>
				<li class="col-lg-4 col-xs-4">
					<a href="<?php echo U('About/threeGuarantees');?>">三包服务</a>
				</li>
			</ul>
		</div>
		<!--服务流程 暂未开通弹出层-->
		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		  <div class="modal-dialog modal-sm" role="document" style="padding-top:4em;">
		    <div class="modal-content">
		    	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		      </div>
		      <div class="modal-body">
		        暂未开通
		      </div>
		    </div>
		  </div>
		</div>

		<div class="container clearfix serviceIdea">
			<ul class="row clearfix">
					<li class="col-md-4 col-sm-6">
						<div class="mTitle">
							<span>01</span>
							<div>
								<span>服务</span>
								<span>Service</span>
							</div>
						</div>
						<div class="mCon">
							<p><span class="rds50"></span>做服务、做售后就是市场，就是未来！</p>
						</div>
					</li>
					<li class="col-md-4 col-sm-6">
						<div class="mTitle">
							<span>02</span>
							<div>
								<span>做好</span>
								<span>Do Well</span>
							</div>
						</div>
						<div class="mCon">
							<p><span class="rds50"></span>只有做好、做细产品售后服务的企业才能提升顾客的满意度，才能赢得市场！</p>
						</div>
					</li>
					<li class="col-md-4 col-sm-6">
						<div class="mTitle">
							<span>03</span>
							<div>
								<span>市场</span>
								<span>Market</span>
							</div>
						</div>
						<div class="mCon">
							<p><span class="rds50"></span>以满足顾客的要求、超越顾客的期待为基础，努力充实完善售后服务体制，力争提供切实热情的服务，从而赢得顾客的满意和信赖。</p>
						</div>
					</li>
				</ul>
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
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
	</head>
	<style>
		.FirmName{text-align: center;}
		.FirmName > p{font-size: 1.125em;  padding-top: 35px; color: #8d9298;}
		.container .col-lg-12{font-size: 1.75em; color: #0eb493; font-weight: bold; padding-top: 15em;}
		.container .col-lg-12 span{color: #f97433;}
		.container .col-xs-12{ padding-top:1em; }
		.FirmName b{display: inline-block; margin: 0 auto; padding-top: 23px;}
		.FirmName .MemBer{ padding:3em 0; }
		.FirmName .MemBer dl dt{float: left; padding-right: 15px; padding-bottom: 50px;}
		.FirmName .MemBer dl dd{text-align: left; }
		.FirmName .MemBer dl dd h6{font-size: 1.25em;}
		.FirmName .MemBer dl dd p{color: #8d9298; font-size: .75em; line-height:1.8em;}
		.FirmName .FirmPic{padding:2em 0;}
		.FirmName .FirmPic h6{font-size: 1.125em; padding-top: 10px; padding-bottom: 3px;}
		.FirmName .FirmPic span{font-size: .75em; color: #8d9298;}
		.FirmName .FirmPic img{width: 100%;}
		.FirmName .FirmPic>div{display:inline-block; padding-top:15px;}

		.MeinPic h4 {font-size:18px; color:#333; text-align:center; line-height:1.8em;}
		.MeinPic p { font-size:12px; color:#999; text-align:center; line-height:1.8em;}
		.MeinPic a { display:	block;}
		.MeinPic .box {position:relative; margin:0 auto; overflow:hidden; display:block; width:97%; margin-bottom: 1em;}
		.MeinPic .box .mask { position:absolute;top:-100%;left:0; background:#0eb493; width:100%;height:100%; opacity:.8;transition:all ease-out .5s;-webkit-transition:all ease-out .5s;-moz-transition:all ease-out .5s;-ms-transition:all ease-out .5s;-o-transition:all ease-out .5s;}
		.MeinPic .box:hover .mask{top:0; }
		.MeinPic .box img {width:100%;}
		.MeinPic .box .mask p{ color:#fff;line-height12px;}
		.MeinPic .box .mask .MaskText {padding-top:40%;}
	</style>

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

	<header class="clearfix">
	<!--top bar-->
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
		<!--导航-->
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">快捷菜单</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="javascript:;">
						<div class="LogoImg">
							<a href="<?php echo U('/Index/index');?>">
								<img src="/Public/Images/Tweb/logo.png" alt="天朔集团LOGO" title="天朔集团LOGO" />
							</a>
						</div>
					</a>
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
				</div>
			</div>
		</nav>
	</header>

	<section class="clearfix">
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

		<!--三大会员体系-->
		<div class="container FirmName clearfix">
			<h2 class="col-lg-12 col-xs-12">三大会员体系</h2>
			<b><img src="/Public/Images/Tweb/title.png" alt="三大会员体系" title="三大会员体系" /></b>
			<div class="row MemBer clearfix">
				<div class="col-md-4 col-xs-12">
					<dl>
						<dt><img src="/Public/Images/Tweb/shareholder.png" alt="众筹股东图标" title="众筹股东图标" /></dt>
						<dd>
							<h6>众筹股东</h6>
							<p>一次性投入五万元，作为一次众筹股权的投资，成为投资所在主体公司的股东合伙人之一，永久享受经营企业年度经营0.1%的分红权利等会员八项权益。</p>
						</dd>
					</dl>
				</div>
				<div class="col-md-4 col-xs-12">
					<dl>
						<dt><img src="/Public/Images/Tweb/partner.png" alt="合伙人图标" title="合伙人图标" /></dt>
						<dd>
							<h6>合伙人</h6>
							<p>一次性投入一万元，成为所投资公司的代理合伙人，可以享受公司线上商城商品的折扣优惠，自主经营公司产品引发   发展线下享受三级分润等权益。</p>
						</dd>
					</dl>
				</div>
				<div class="col-md-4 col-xs-12">
					<dl>
						<dt><img src="/Public/Images/Tweb/member.png" alt="VIP会员图标" title="VIP会员图标" /></dt>
						<dd>
							<h6>VIP会员</h6>
							<p>只要在6S店充值消费1000元即可成为VIP会员，可以消费享受6S店各项服务。</p>
						</dd>
					</dl>
				</div>
			</div>
		</div>
		<!--标准6S店的设计与功能-->
		<div class="container FirmName">
			<h2>标准<span>6S</span>店的设计与功能</h2>
			<b><img class="col-lg-12 col-xs-12" src="/Public/Images/Tweb/title.png" alt="店的设计与功能下标" title="店的设计与功能下标" /></b>
			<p>我们6S店主要以客户为主体，创建的一个集汽车超市、商业化运营、综合服务、大健康一站式商业中心，体现车-家-生活的新概念，其中全新的科技展厅可以享受新能源产品的宣传体验，让客户有一种家的温暖，给客户带来全新的体验。</p>
			<div class="row"><img class="col-md-12 col-sm-12 col-xs-12" src="/Public/Images/Tweb/Index6sFloor.jpg" alt="店的设计与功能" title="店的设计与功能" /></div>
		</div>
		<!--商业运营体系-->
		<!-- <div class="container FirmName">
			<h2>商业运营体系</h2>
			<b><img src="/Public/Images/Tweb/title.png" alt="商业运营体系下标" title="商业运营体系下标" /></b>
			<p>我们6s店的主要体现了XXX，需要文案支持，这里保持两行，文字，颜色，间距，之后需要文案来填充.文案需要策划 尽快提供好填写此内容来完成，完成现在的样式设计</p>
			<div class="row"><img class="col-md-12 col-sm-12 col-xs-12" src="/Public/Images/Tweb/IndexBusiness.jpg" alt="商业运营体系" title="商业运营体系" /></div>
		</div> -->
		<!--我们的活动-->
		<div class="container FirmName">
			<h2>我们的活动</h2>
			<b><img src="/Public/Images/Tweb/title.png" alt="" /></b>
			<p>公司保持以节能减排为宗旨，按照新能源汽车新的设计理念，采用先进的轿车生产工艺和技术标准，力争在未来借助公司全新的电池技术和汽车轻量化碳纤维车身平台，打造行业前端的新能源汽车。</p>
			<div class="row FirmPic clearfix">
				<div class="col-md-3 col-sm-3 col-xs-6 MeinPic">
					<a class="box" href="javascript:;">
						<div class="mask">
							<div class="MaskText">
								<p>时间：2016-06-15</p>
								<p>天朔电动汽车厂景</p>
							</div>
						</div>
						<img src="<?php echo C('UPLOAD_SAVAPATH');?>Test/QiYeFengCai.jpg" alt="天朔电动汽车厂景" title="天朔电动汽车厂景" />
					</a>
					<h6>天朔电动汽车厂景</h6>
					<span>天朔电动汽车企业内部厂景展示</span> 
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 MeinPic">
					<a class="box" href="javascript:;">
						<div class="mask">
							<div class="MaskText">
								<p>时间：2017-01-15</p>
								<p>山西大同发布充电基础设施建设管理办法</p>
							</div>
						</div>
						<img src="<?php echo C('UPLOAD_SAVAPATH');?>Test/hd1.jpg" alt="活动图2" title="活动图2" />
					</a>
					<h6>充电基础设施建设管理办法</h6>
					<span>山西大同发布充电基础设施建设管理办法</span>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 MeinPic" style="float:right;">
					<a class="box" href="javascript:;">
						<div class="mask">
							<div class="MaskText">
								<p>时间：2017-02-05</p>
								<p>市政协领导等深入山西天朔电动</p>
							</div>
						</div>
						<img src="<?php echo C('UPLOAD_SAVAPATH');?>Test/hd2.jpg" alt="活动图3" title="活动图3" />
					</a>
					<h6>市政协领导等深入山西天朔电动</h6>
					<span>市政协领深入天朔电动汽车有限公司考察调研</span>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 MeinPic">
					<a class="box" href="javascript:;">
						<div class="mask">
							<div class="MaskText">
								<p>时间：2017-03-20</p>
								<p>天朔集团2017年誓师大会</p>
							</div>
						</div>
						<img src="<?php echo C('UPLOAD_SAVAPATH');?>Test/hd3.jpg" alt="活动图4" title="活动图4" />
					</a>
					<h6>天朔集团2017年誓师大会</h6>
					<span>天朔集团2016年誓师大会在北京黄河京都会展中心隆重举行</span>
				</div>
			</div>
		</div>
		<div class="clearfix FirnMap hidden-xs hidden-sm">
			<img style="width: 100%;" src="/Public/Images/Tweb/map.jpg" alt="地图" />
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
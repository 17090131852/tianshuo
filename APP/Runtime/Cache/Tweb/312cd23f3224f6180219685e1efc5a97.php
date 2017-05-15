<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>天朔电动汽车有限公司-积分商城</title>
	<meta name="keywords" content="天朔 天朔电动汽车 山西天朔 天朔汽车 电动未来 天朔电动 电动汽车 " />
	<meta name="description" content="山西天朔电动汽车有限公司隶属山西天朔集团，是一家集研发，设计，生产销售为一体的新能源电动汽车制造企业。我公司保持以节能减排为宗旨。按照汽车产品的新的设计理念，采用先进的轿车生产工艺和标准。结合乘用车辆配合的性能。打造国内先进的具有开发生产多种类型新能源，电动汽车为主的大型生产企业。" />
	<link rel="stylesheet" href="/Public/Style/Reset.css" />
	<link rel="stylesheet" href="/Public/Plugin/Bootstrap/bootstrap.min.css"/>
	<link rel="stylesheet" href="/Public/Style/Common.css" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

	<!--[if lte IE 6]><script src="/skin/js/letskillie6.zh_cn.pack.js"></script><![endif]-->
	<script src="/Public/Script/jquery-1.9.1.min.js" ></script>
	<script src="/Public/Plugin/Bootstrap/bootstrap.min.js" ></script>
	<style>
		.TopBar{ line-height:32px; background: #1ea78d; color: #fff; font-size: .875em; }
		.LogoBar { padding:1em 0; }
		.TopBar a{color: #fff; }
		.TopBar .BarRight li{ float: left; padding-right: 1em; }
		.TopBar a{color: #fff; }
		.pullLeft{ float:left;}
		.pullRight{ float:right;}
	</style>
</head>
<body>
<header>
	<!--顶部条-->
	<div class="TopBar">
		<div class="container">
			<div class="row clearfix">
				<div class="pullLeft">
					<span class="hidden-xs">欢迎访问天朔积分商城 | </span>
					<?php if($_SESSION['msn']== '' ): ?><a href="<?php echo U('Public/Login');?>">登录</a>
						<?php else: ?>
						<a href="<?php echo U('Public/logout');?>">退出</a> <a href="<?php echo U('Member/index');?>"> <?php echo (msubstr(session('nickname'),0,4)); ?></a><?php endif; ?>
				</div>
				<div class="pullRight">
					<a href="<?php echo U('Imall/orderList');?>">我的订单</a> | <a href="<?php echo U('Imall/cartList');?>">购物车</a>
				</div>
			</div>
		</div>
	</div>
	<!--LOGO等-->
	<div class="container LogoBar">
		<div class="row">
			<div class="TsLogo col-lg-3 col-md-5 col-sm-5 col-xs-8">
				<a href="/index.php">
					<!--<img src="/Public/Images/Tweb/logo.png" alt="天朔集团LOGO" title="天朔集团LOGO" />-->
				</a>
			</div>
		</div>
	</div>
	<!--导航-->
	<!--div class="container">
		<div class="row">
			<!--nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">快捷菜单</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-center">
							<li><a href="<?php echo U('Index/index');?>"><span></span>首页</a></li>
							<li><a href="<?php echo U('MotoType/index');?>"><span></span>车型总览</a></li>
							<li><a href="<?php echo U('About/afterService');?>"><span></span>售后服务</a></li>
							<li><a href="<?php echo U('News/index');?>"><span></span>资讯中心</a></li>
							<li><a href="<?php echo U('MotoType/testDrive');?>"><span></span>预约试驾</a></li>
							<li><a href="<?php echo U('About/index');?>"><span></span>关于天朔</a></li>
							<li><a href="<?php echo U('BusiUnion/index');?>"><span></span>招商加盟</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</div-->
</header>
<style>
	.goodHead{ margin-top:2em; }
	.goodPic{ border:1px solid #eee; }
	.goodPic img{ width:100%; }
	.goodTit{ line-height:1.5em; font-size:1.8em; }
	.intrList{ line-height:2em;  }

	.btnSub{ border-top:1px solid #ddd; padding:1em 0; }
	.addMin{ display:block; margin:0 .5em; float:left; width:18px; height:18px; line-height:18px; text-align:center;
		border:1px solid #0EB493; margin-top:.5em; }
	.carnoNum{ float:left; height:1.5em; margin-top:.4em; text-indent:.5em; }
	.iptBtn{ display:block; height:30px; width:120px; line-height:30px; text-align:center; }
	.goodDetail{ margin-top:2em; }
	.discTitle{ line-height:3em;border-bottom:2px solid #0EB493; }
</style>
<div class="container">
	<div class="goodHead row">
		<div class="goodPic col-lg-3">
			<img src="<?php echo ($data["goods_thumb"]); ?>" alt="" />
		</div>
		<div class="goodIntr col-lg-9">
			<h1 class="goodTit"><?php echo ($data["goods_name"]); ?></h1>
			<ul class="intrList">
				<li> 商品库存：<?php echo ($data["goods_num"]); ?> </li>
				<li> 商品销量：<?php echo ($data["goods_sale_num"]); ?></li>
				<li> 所需积分：<?php echo ($data["goods_score"]); ?>&nbsp;BV</li>
				<li class="clearfix">
					<a href="javascript:;" class="addMin rds5" onclick="addMin(0)">-</a>
					<input class="carnoNum iptText rds5" type="text" name="num" value="1" style="width:4em;" />
					<a href="javascript:;" class="addMin rds5" onclick="addMin(1)" >+</a>
				</li>
			</ul>
			<a class="iptBtn rds5 addCart" href="javascript:;">加入购物车</a>
		</div>
	</div>
	<div class="goodDetail">
		<h3 class="discTitle">商品描述</h3>
		<div class="discCont">
			<?php echo (htmlspecialchars_decode($data["goods_desc"])); ?>
		</div>
	</div>
</div>
<script>
	$('document').ready(function() {
		//添加购物车
		$('.addCart').click(function (){
			var gCode = '<?php echo ($data["goods_id"]); ?>';
			var gNum = $('.carnoNum').val();
			//console.log(gNum+gCode);return false;
			$.post("/index.php/../Imall/addCart", {num: gNum, id: gCode}, function (rs){
				alert(rs.msg);
			}, 'json');
		});
	});
	//数量自加减
	function addMin(v){
		baseNum = $('.carnoNum').val();
		if(v==1 && baseNum<999){
			baseNum++;
			$('.carnoNum').val(baseNum);
		}else if(v==0 && baseNum>1){
			baseNum--;
			$('.carnoNum').val(baseNum);
		}else{
			return false;
		}
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
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

		/*精品推荐*/
		.recomArea{ margin-top:2em; }
		.recomList{ margin-top:2em; }
		.recomArea h2, .cargoArea h2{ font-size:1.5em; }
		.recomArea .ItemBox { padding: .2em 0; }

		.cargoArea{ margin-top:2em; }
		.cargoList a{ text-decoration: none; }
		.cargoList li{ margin-top:1em;  padding:0 .4em;}
		.goodItemCase{ border:1px solid #eee; padding:1em .5em;}
		.goodsImg{ border:1px solid #eee;  }
		.goodsImg img{ width:100%; margin:0 auto; }
		.cargoProperty{ margin-top:1em; }
		.cargoProperty p{ line-height:1em; }
		.cargoProperty p:first-child{ font-weight:bold; font-size:1.125em; }
		/*数量加减*/
		.addMin{  }
		.addMin a{ float:left; margin-top:.2em; display:block; color:#fff; width:1.25em; height:1.25em; background:#0eb493; text-align:center; line-height:1.25em;  }
		.addMin input{ float:left; width:4em; margin:0 .5em;text-align: center; }
		.iptBtn{ display:block;width:100%; height:2em; line-height:2em; text-align:center; font-weight:bold; }
		.iptBtn:hover, .iptBtn:visited, .iptBtn:active{ color:#fff; }
	</style>

	<!-- 轮播图 -->
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

	<!-- 1楼 -->
	<div class="container recomArea">
		<h2 class="row">精品推荐</h2>
		<div class="row recomList">
			<ul>
				<?php if(is_array($goodsHot)): $i = 0; $__LIST__ = $goodsHot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gItem): $mod = ($i % 2 );++$i;?><li class="col-lg-2">
						<div class="goodItemCase">
							<div class="goodsImg">
								<a href="/index.php/Imall/info/goods_id/<?php echo ($gItem["goods_id"]); ?>"><img src="<?php echo ($gItem["goods_thumb"]); ?>" alt="" /></a>
							</div>
							<div class="cargoProperty">
								<input type="hidden" name="goodsCode" value="<?php echo ($gItem["goods_id"]); ?>" />
								<p><a href="/index.php/Imall/info/goods_id/<?php echo ($gItem["goods_id"]); ?>"><?php echo (msubstr($gItem["goods_name"],0,12)); ?></a></p>
								<p>所需积分：<?php echo ($gItem["goods_score"]); ?>&nbsp;BV</p>
								<p class="addMin clearfix">
									<a class="rds5 minNum" href="javascript:;">-</a>
									<input class="carnoNum iptText rds5" type="text" name="cnum" value="1" title="数量" />
									<a class="rds5 addNum" href="javascript:;">+</a>
								</p>
								<a class="iptBtn rds5 addCart" href="javascript:;">加入购物车</a>
							</div>
						</div>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>
	</div>
	<div class="container cargoArea">
		<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vItem): $mod = ($i % 2 );++$i;?><h2 class="row"><?php echo ($vItem["title"]); ?></h2>
			<ul class="row cargoList">
				<?php if(is_array($vItem["goods"])): $i = 0; $__LIST__ = $vItem["goods"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gItem): $mod = ($i % 2 );++$i;?><li class="col-lg-2">
						<div class="goodItemCase">
							<div class="goodsImg">
								<a href="/index.php/Imall/info/goods_id/<?php echo ($gItem["goods_id"]); ?>"><img src="<?php echo ($gItem["goods_thumb"]); ?>" alt="" /></a>
							</div>
							<div class="cargoProperty">
								<input type="hidden" name="goodsCode" value="<?php echo ($gItem["goods_id"]); ?>" />
								<p><a href="/index.php/Imall/info/goods_id/<?php echo ($gItem["goods_id"]); ?>"><?php echo (msubstr($gItem["goods_name"],0,12)); ?></a></p>
								<p>所需积分：<?php echo ($gItem["goods_score"]); ?>&nbsp;BV</p>
								<p class="addMin clearfix">
									<a class="rds5 minNum" href="javascript:;">-</a>
									<input class="carnoNum iptText rds5" type="text" name="cnum" value="1" title="数量" />
									<a class="rds5 addNum" href="javascript:;">+</a>
								</p>
								<a class="iptBtn rds5 addCart" href="javascript:;">加入购物车</a>
								<!--a class="iptBtn rds5" href="/index.php/Imall/addCart/goodsCode/<?php echo ($gItem["goods_code"]); ?>">加入购物车</a-->
							</div>
						</div>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
	<script>
		$('document').ready(function(){
			//添加购物车
			$('.addCart').click(function(){
				var gCode = $(this).parent().children('input[name=goodsCode]').val();
				var gNum = $(this).parent().children('p').children('.carnoNum').val();
				//console.log(gNum+gCode);return false;
				$.post("/index.php/../Imall/addCart",{num:gNum,id:gCode},function(rs){
					//console.log(rs.code);
					alert(rs.msg);
				},'json');
			});
			//产品数量加
			$('.addNum').click(function(){
				var numNow = $(this).parent().children('.carnoNum').val();
				if(numNow < 999){
					numNow++;
					$(this).parent().children('.carnoNum').val(numNow);
				}
			});
			//产品数量减
			$('.minNum').click(function(){
				var numNow = $(this).parent().children('.carnoNum').val();
				if(numNow > 1){
					numNow--;
					$(this).parent().children('.carnoNum').val(numNow);
				}
			});

		});
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
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
	td{ width:350px;}
	.subTitle{ font-size:1.125em; color:#1ea78d; margin-top:1em; line-height:2em; }
	.flatSelect{ border:1px solid #ddd; overflow:hidden; font-size:.875em; }
	.flatSelect select{padding: .5em 1em;border: 1px solid #0eb493;}

	.iptText{ padding: .4em .6em; }
	.iptBtn { padding: .4em 1.5em; }

	.listTable tr th { height:2em; text-align:center; background:#1ea78d; border: 1px solid #fff; color: #fff; }
	.listTable tr td{ border:1px solid #ddd; font-size:.875em; line-height:2em; text-align:center;}

	.news_list ul li { margin: .5em 0; }

	#cont{ margin-top:1em; }
	#cont tr{ line-height:1.8em; font-size:.875em; }
	/*分页*/
	#pageNav_1{ margin: 2em 0; }
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
<div class="container">
	<h2 class="subTitle">下属名单</h2>
	<div class="news_list" >
		<ul class="row">
			<!--会员编号-->
			<li class="col-lg-2 col-xs-12 col-sm-3 col-md-3">
				<label>会员编号：</label>
				<input class="iptText rds5" name="msn" value="">
			</li>
			<!--会员姓名-->
			<li class="col-lg-2 col-xs-12 col-sm-3 col-md-3">
				<label>会员姓名：</label>
				<input class="iptText rds5" name="name" value="">
			</li>
			<!--加入日期-->
			<li class="col-lg-4 col-xs-12 col-sm-3 col-md-3">
				<label>加入日期：</label>
				<div>
					<input class="timeSelect iptText rds5" style="line-height:1em;" name="reg_time_start" type="date" value="">
				<input class="timeSelect iptText rds5" style="line-height:1em;" name="reg_time_end" type="date" value="">
				</div>
			</li>
			<!--会员类型-->
			<li class="col-lg-2 col-xs-12 col-sm-3 col-md-3">
				<label>会员类型：</label>
				<span class="flatSelect">
					<select name="m_type" id="m_type" class="rds5">
						<option value="0">--请选择--</option>
						<option value="1">众筹股会员</option>
						<option value="2">合伙人会员</option>
						<option value="3">汽车VIP会员</option>
					</select>
				</span>
			</li>
			<li class="col-lg-2 col-xs-12 col-sm-3 col-md-3">
				<input class="iptBtn rds5" type="button" value="提交" onclick="getu(1)">
			</li>
		</ul>
		<div class="table-responsive">
		<table class="listTable table-hover table" >
			<thead>
				<tr>
					<th>订单</th>
					<th>会员</th>
					<th>会员编号</th>
					<th>加入日期</th>
					<th>会员姓名</th>
					<th>状态</th>
				</tr>
			</thead>
			<tbody id="cont">
			</tbody>
		</table>
		</div>
	</div>
	<!--分页-->
	<div id="pageNav_1"></div>
	<!--下属个人小组积分-->
	<h2 class="subTitle">下属个人小组积分</h2>
	<div class="container">
		<div class="row" style="margin-bottom: .5em;">
				<ul class="row">
					<li class="col-lg-6 col-xs-12 col-sm-3 col-md-3">
						<label>消费总计积分</label>
							<input class="timeSelect iptText rds5" name="allscore_start" value="">
							<input class="timeSelect iptText rds5" name="allscore_end" value="">
					</li>
					<li class="col-lg-2 col-xs-12 col-sm-3 col-md-3">
						<input class="iptBtn rds5" type="button" value="提交" onclick="getdata(1)">
					</li>
			<!--<tr>-->
				</ul>
			<!--<td>消费周期</td>-->
			<!--<td>-->
			<!--<select name="period" >-->
			<!--<option value="1">今日</option>-->
			<!--<option value="2">本星期</option>-->
			<!--<option value="3" >本月</option>-->
			<!--<option value="4">本年度</option>-->
			<!--</select>-->
			<!--</td>-->
			<!--</tr>-->
		</div>
	</div>

	<div class="news_list" >
		<table class="listTable table-hover table">
			<thead>
				<tr>
				<th>操作</th>
				<th>小组</th>
				<th>消费积分总计</th>
				</tr>
			</thead>
			<tbody id="cont1">
			</tbody>
		</table>
	</div>
	<div id="pageNav"></div>
</div>


<link rel="stylesheet" type="text/css" href="/Public/Plugin/Page/Page.css" />
<script type="text/javascript" src="/Public/Plugin/Page/Pagenav1.1.cn.js"></script>
<script type="text/javascript" src="/Public/Plugin/Page/Pagenav1.1.cn_1.js"></script>
<style type="text/css">
	.cPageNum { background: #1ea78d; border: 1px solid #1ea78d; }
</style>
<script type="text/javascript">
	var u_page = 1;
	var u_pagesize = 4;

	var page = 1;
	var pagesize = 1;

	$(function(){

		pageNav_1.pre="上一页1";
		pageNav_1.next="下一页1";

		pageNav.pre="上一页";
		pageNav.next="下一页";

		getu(1);
		getdata(1);
	});

	/**
	 * 下属人员
	 * @param u_page
	 */
	function  getu(u_page){
		var m_sta = '正常';
		var msn            = $("input[name='msn']").val();
		var name           = $("input[name='name']").val();
		var reg_time_start = $("input[name='reg_time_start']").val();
		var reg_time_end   = $("input[name='reg_time_end']").val();
		var m_type         = $("#m_type option:selected").val(); //获取选中的项
		url='/Ajax/getUnderling';
		$.get(url,{page:u_page,pagesize:u_pagesize,msn:msn,name:name,reg_time_start:reg_time_start,reg_time_end:reg_time_end,type:m_type },function(data){
			if(data.data!='undefined'){
				$('#cont').html('');
				if(data.data==null || data.data==''){
					$("#cont").append('暂无数据');
				}else{
					if(data.pagetotal>1){
						pageNav_1.go(u_page,data.pagetotal);
					}
					$.each(data.data, function(key, val) {
						str = "<tr><td><a href='/Agents/orderview?msn="+data.data[key]['msn']+"&mid="+data.data[key]['mid']+"'> 查看订单</a></td><td><a href='/Agents/memberview?msn="+data.data[key]['msn']+"'> 查看会员信息</a></td>";
						str += "<td>"+data.data[key]['msn']+"</td>";
						str += "<td>"+data.data[key]['reg_time']+"</td>";
						str += "<td>"+data.data[key]['nickname']+"</td>";
						if(data.data[key]['sta']==1){
							m_sta = '正常';
						}
						if(data.data[key]['sta']==2){
							m_sta = '异常';
						}
						if(data.data[key]['sta']==3){
							m_sta = '封禁';
						}

						str += "<td>"+m_sta+"</td></tr>";
						$("#cont").append(str);
					});
				}
			}
		},'json');
	}


	function  getdata(page){
		var allscore_start = $("input[name='allscore_start']").val()
		var allscore_end   = $("input[name='allscore_end']").val()
//        var period         = $("input[name='period']").val()
		url='/Ajax/getGroupList';
		$.get(url,{page:page,pagesize:pagesize,allscore_start:allscore_start,allscore_end:allscore_end },function(data){
			if(data.data!='undefined'){
				$('#cont1').html('');
				if(data.data==null || data.data==''){
					$("#cont1").append('暂无数据');
				}else{
					if(data.pagetotal>1){
						pageNav.go(page,data.pagetotal);
					}
					$.each(data.data, function(key, val) {
						str = "<tr><td><a href='/Agents/consumedView?group_id="+data.data[key]['group']+"'> 查看小组消费情况</a></td>";
						str += "<td>"+data.data[key]['group']+"</td>";
						str += "<td>"+data.data[key]['sum']+"</td>";
						$("#cont1").append(str);
					});
				}
			}
		},'json');
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
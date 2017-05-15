<?php
namespace LaneWeChat;
/**
 * 系统主配置文件.
 * @Created by Lane.
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-8-1
 * @Time: 下午1:00
 * @Blog: Http://www.lanecn.com
 */
//版本号
define('LANEWECHAT_VERSION', '1.4');
define('LANEWECHAT_VERSION_DATE', '2014-11-05');

/*
 * 服务器配置，详情请参考@link http://mp.weixin.qq.com/wiki/index.php?title=接入指南
 */
define("WECHAT_URL", 'http://ts.jomon.cc/');
define('WECHAT_TOKEN', 'i12o3lsaod0vl1');
// define('ENCODING_AES_KEY', ""); //开发者
define('ENCODING_AES_KEY', "iArhfFNtyXsjoX596jsO4PZZTRy9tVVR8OYpsiVVWvy"); //天朔

/*
 * 开发者配置
 */
// define("WECHAT_APPID", 'wx62d6b3c37243e48e');
// define("WECHAT_APPSECRET", 'c15b92a40c15dfea05d30b350726c210');
//天朔
define("WECHAT_APPID", 'wxb73f3b272e75a926');
define("WECHAT_APPSECRET", '0822facc4c7529f205249b874597a82d');
/*
 * SAE平台配置
 */
define("HTTP_ACCESSKEY", '04xmzo3zm5');
define("HTTP_APPNAME", 'imcustom4test');

////-----引入系统所需类库-------------------
////引入错误消息类
//include_once 'core/msg.lib.php';
////引入错误码类
//include_once 'core/msgconstant.lib.php';
////引入CURL类
//include_once 'core/curl.lib.php';
//
////-----------引入微信所需的基本类库----------------
////引入微信处理中心类
//include_once 'core/wechat.lib.php';
////引入微信请求处理类
//include_once 'core/wechatrequest.lib.php';
////引入微信被动响应处理类
//include_once 'core/responsepassive.lib.php';
////引入微信access_token类
//include 'core/accesstoken.lib.php';
//
////-----如果是认证服务号，需要引入以下类--------------
////引入微信权限管理类
//include_once 'core/wechatoauth.lib.php';
////引入微信用户/用户组管理类
//include_once 'core/usermanage.lib.php';
////引入微信主动相应处理类
//include_once 'core/responseinitiative.lib.php';
////引入多媒体管理类
//include_once 'core/media.lib.php';
////引入自定义菜单类
//include_once 'core/menu.lib.php';
?>
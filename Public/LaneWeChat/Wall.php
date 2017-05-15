<?php
namespace LaneWeChat;

header("Content-type:text/html;charset=utf-8");


use LaneWeChat\Core\AccessToken;
use LaneWeChat\Core\UserManage;
ini_set("display_errors", "on");
error_reporting(7);


//引入配置文件
include_once __DIR__.'/config.php';
//引入自动载入函数
include_once __DIR__.'/autoloader.php';

//调用自动载入函数
AutoLoader::register();

$accessToken = \LaneWeChat\Core\AccessToken::getAccessToken();
$openId = $_GET['id'];
$userinfo = UserManage::getUserInfo($openId);

print_r($userinfo);

echo "<img src='{$userinfo['headimgurl']}' />";
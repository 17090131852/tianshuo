<?php
namespace LaneWeChat;
use LaneWeChat\Core\Wechat;
use LaneWeChat\Dev\MsgWall;
define("DIRNAME", __DIR__."/");
ini_set("display_errors", "on");
error_reporting(7);
/**
 * 微信插件唯一入口文件.
 * @Created by Lane.
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:00
 * @Blog: Http://www.lanecn.com
 */
//引入配置文件
include_once __DIR__.'/config.php';
//引入自动载入函数
include_once __DIR__.'/autoloader.php';
//调用自动载入函数
AutoLoader::register();
//初始化微信类
$wechat = new WeChat(WECHAT_TOKEN, TRUE);
// file_put_contents("log.txt", "123"."\r\n",FILE_APPEND);
// file_put_contents("log.txt", var_export($_GET,1),FILE_APPEND);

$MsgWall = new \LaneWeChat\Dev\MsgWall();
$content = $MsgWall->reply($request);
//首次使用需要注视掉下面这1行（27行），并打开最后一行（29行）
echo $wechat->run();
//首次使用需要打开下面这一行（29行），并且注释掉上面1行（27行）。本行用来验证URL
// $wechat->checkSignature();
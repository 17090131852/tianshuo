<?php
namespace Tadm\Controller;
use Common\Controller\BaseController;
class IndexController extends BaseController {
	public function index(){
		$this->display(C('DEFAULT_TPL').'/index');
	}

	public function top(){
		$this->display(C('DEFAULT_TPL').'/top');    	
	}

	public function left(){
		$nodeArr = D('Node')->getAll(); //获取全部节点
		$cateObj = new \Org\Util\Category($nodeArr);  //实例化
		$this->treeArr = $cateObj->getTree($nodeArr,1); //树形数组
		$this->display(C('DEFAULT_TPL').'/left');    	
	}

	//后台主体区块内容x
	public function main(){
		$gd = gd_info();
		$info = array(
			'操作系统' => PHP_OS,
			'服务器系统版本' => php_uname(),
			'运行环境' => $_SERVER["SERVER_SOFTWARE"],
			'PHP运行方式' => php_sapi_name(),
			'PHP版本'     => PHP_VERSION,
			'ThinkPHP版本' => THINK_VERSION,
			'服务器语言' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
			'服务器端口' => $_SERVER['SERVER_PORT'],
			'上传附件限制' => ini_get('upload_max_filesize'),
			'脚本最大执行时间' => ini_get("max_execution_time")."秒",
			'最大上传文件限制' => ini_get("file_uploads") ? ini_get("upload_max_filesize") : "Disabled",
			'执行时间限制' =>ini_get('max_execution_time').'秒',
			'北京时间' => gmdate("Y年n月j日 H:i:s",time()+8*3600),
			'服务器时间' => date("Y年n月j日 H:i:s"),
			'服务器域名/IP' => $_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
			'剩余空间' => round((@disk_free_space(".")/(1024*1024)),2).'M',
			"图像处理GD2"       => function_exists("gd_info") ? "支持" : "不支持",
			"图像处理GD2版本"       => $gd["GD Version"],
			"MySql"       => function_exists("mysql") ? "支持" : "不支持",
			"MySql版本"   => $this -> mysqlVer(),
			'register_globals' => get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
			'magic_quotes_gpc' => (1===get_magic_quotes_gpc())?'YES':'NO',
			'magic_quotes_runtime' => (1===get_magic_quotes_runtime())?'YES':'NO',
			'SOCKET支持'    => function_exists('fsockopen') ? '支持' : '不支持',
		);
		$this->sysInfo = $info;
		$this->display(C('DEFAULT_TPL').'/main');    	
	}

	//获取MySQL版本
	private function mysqlVer(){
		$row = M()->query("select VERSION() as version");
		return $row['0']['version'];
	}
}
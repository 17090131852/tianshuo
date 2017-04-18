<?php
return array(
	//'配置项'=>'配置值'
	'MODULE_ALLOW_LIST'	=>	array('Tweb','Tadm'),	//允许的模块
	'DEFAULT_MODULE'	=>	'Tweb',									//锁定默认目录
	
	//URL配置
	'URL_CASE_INSENSITIVE'  =>  false,	// 默认false 表示URL区分大小写 true则表示不区分大小写
	'URL_MODEL'							=>	1,			//URL模式
	
	//AUTH权限配置,调用TP自带权限认证机制
	'AUTH_ON'						=>	true,									//认证开关
	'AUTH_TYPE'					=>	1,										//认证方式，1为实时认证；2为登录认证。
	'AUTH_GROUP'				=>	'auth_group',					//用户组数据表名
	'AUTH_GROUP_ACCESS' =>	'auth_group_access',	//用户-用户组关系表
	'AUTH_RULE'         =>	'auth_rule',					//权限规则表            
	'AUTH_USER' 				=>	'user',								//用户信息表
	
	//数据库配置 fff
	'DB_HOST'			=>	'182.92.200.96',
	'DB_USER'			=>	'ts_adm',
	'DB_NAME'			=>	'tianshuo',
	'DB_PWD'			=>	'CX)(Q*()cxsa',
	'DB_TYPE'			=>	'mysql',
	'DB_PREFIX'		=>	'ts_',
	'DB_CHARSET'	=>	'utf8',
	'DB_PORT'			=>	3306,
	'DB_FIELDTYPE_CHECK'	=>	true,		//开启字段类型验证
	
	//数据缓存设置
  'DATA_CACHE_TIME'			=>	3600,		//数据缓存有效期 0表示永久缓存
  'DATA_CACHE_COMPRESS'	=>	false,	//数据缓存是否压缩缓存
	'DATA_CACHE_PREFIX'		=>	'',			//缓存前缀
	
	//上传配置
	'UPLOAD_MAX_SIZE'	=>	5242880,		//默认5M
	'UPLOAD_SAVAPATH'	=>	'/Upload/',	//上传默认根路径
	
	//SESSION配置
	'SESSION_PREFIX'	=>	'',					// session 前缀
	
	//Cookie设置
  'COOKIE_EXPIRE'		=>	3600,				// Cookie有效期默认30分钟
	'COOKIE_PATH'			=>	'/Cookie/',	// Cookie路径
  'COOKIE_PREFIX'		=>	'',					// Cookie前缀 避免冲突
	
	//错误设置
	'ERROR_MESSAGE' => '请求内容错误，请联系管理员！',		//错误显示信息,非调试模式有效
	'ERROR_PAGE'    =>  './error.html',										//错误定向页面
	//'TMPL_ACTION_ERROR' => 'Tpl/jump',//默认成功跳转对应的模板文件
  //'TMPL_ACTION_SUCCESS' => 'Tpl/jump',
	
	//个性化配置
	'SUPER_ADM'		=> 1,											//后台超级管理员ID，默认ID=1的第一位用户
	'SITE_NAME' 	=> '天朔新能源',					//站点名字
	'ADM_VER' 		=> 'V1.2',								//后台版本
	'DOMAIN_NAME' => 'http://ts.jomon.cc',	//域名
	'DEFAULT_TPL' => 'Tpl',									//默认模板
);




//test
<?php
namespace Act\Controller;
// use Common\Controller\BaseController;
class IndexController extends Base {
	public function index(){
        echo "<pre>";
		print_r($_SERVER);exit;
	}

	/**
	 * 清除缓存
	 * @return [type] [description]
	 */
    public function clear()
    {
        if (!empty($_COOKIE)) {
            foreach ($_COOKIE as $k => $v) {
                setcookie($k, '', time() - 3600);
            }
        }
        if (!empty($_COOKIE)) {
            foreach ($_COOKIE as $k => $v) {
                setcookie($k, '', time() - 3600);
            }
        }
        session_start();
        session_destroy();
        var_dump($_COOKIE);
    }


	
}
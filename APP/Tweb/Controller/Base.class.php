<?php
/**
 * Created by PhpStorm.
 * User: Funky
 * Date: 2017/4/6
 * Time: 下午11:14
 */

namespace Tweb\Controller;


class Base extends \Tweb\Controller\BaseController
{

    public function __destruct()
    {
        //auto render;
        $dir =  dirname(__DIR__)."/View/";
        $tpl = C('DEFAULT_TPL').'/'.CONTROLLER_NAME."/".ACTION_NAME;
        if(file_exists($dir.$tpl.".html")){
            $this->display(C('DEFAULT_TPL').'/'.CONTROLLER_NAME."/".ACTION_NAME);
        }
    }

}
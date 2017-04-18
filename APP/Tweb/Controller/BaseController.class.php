<?php
namespace Tweb\Controller;
use Think\Controller;

class BaseController extends Controller{

//最新
    public function get($key,$type='string',$default=''){
        $value = $_GET[$key];
        if(empty($value) && $default){
            $value = $default;
        }

        switch ($type) {
            case 'string':
                $value = (string)$value;
                break;
            case 'int':
                $value = intval($value);
                break;
            case 'float':
                $value = (float)$value;
                break;
            case 'boolean':
                $value = (boolean)$value;
                break;
            case 'array':
                $value = (array)$value;
                break;
            default:
                $value;
                break;
        }

        return $value;
    }

    public function post($key,$type='string',$default=''){
        $value = $_POST[$key];
        if(empty($value) && $default){
            $value = $default;
        }

        switch ($type) {
            case 'string':
                $value = (string)$value;
                break;
            case 'int':
                $value = intval($value);
                break;
            case 'float':
                $value = (float)$value;
                break;
            case 'boolean':
                $value = (boolean)$value;
                break;
            case 'array':
                $value = (array)$value;
                break;
            default:
                $value;
                break;
        }

        return $value;
    }

    public function request($key,$type='string',$default=''){
        $value = $_REQUEST[$key];

        if(empty($value) && $default){
            $value = $default;
        }

        switch ($type) {
            case 'string':
                $value = (string)$value;
                break;
            case 'int':
                $value = intval($value);
                break;
            case 'float':
                $value = (float)$value;
                break;
            case 'boolean':
                $value = (boolean)$value;
                break;
            case 'array':
                $value = (array)$value;
                break;
            default:
                $value;
                break;
        }

        return $value;
    }

    /**
     * 得到当前用户msn
     */
    public function getMsn(){
        $msn = $_SESSION['msn'];
        return $msn;
    }

}
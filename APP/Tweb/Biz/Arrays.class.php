<?php
/**
 * Created by PhpStorm.
 * User: Funky
 * Date: 2017/4/6
 * Time: 下午10:45
 */

namespace Tweb\Biz;


class Arrays
{
    static public function setkeys($data,$key){
        $tmp = [];
        foreach($data as $d){
            $tmp[$d[$key]] = $d;
        }

        return $tmp;
    }

    static public function groupBy(){

    }

}
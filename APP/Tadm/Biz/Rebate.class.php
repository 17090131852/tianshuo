<?php
namespace Tadm\Biz;

class Rebate
{

    public function Rebate($msn='',$total=0)
    {
        //根据用户msn，进行用户返佣金/返积分 自己
        //根据用户msn，查询用户直荐人msn，进行返佣金/返积分 第一级
        //根据用户第一级msn,查询第一级msn直接人msn，进行饭佣金/返积分  第二级
        //根据用户第二级msn,查询第二级msn直接人msn，进行饭佣金/返积分  第三级


    }

}


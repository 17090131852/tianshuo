<?php
namespace Tadm\Biz;

class Goods
{
	/**
	 * 得到逗号连接的cat_id
	 * @param  string $title 父类title
	 * @return string        子类id
	 */
    public function getCatidByPidTitle($title='')
    {
        $cat = array();
        // 获得积分商城分类id，查询该分类下的所有子分类
        $id = M('category')->field('id')->where("title='$title'")->find();
        //查询该父类下的所有子类
        $cat_two = M('category')->field('id')->where("pid='{$id[id]}'")->select();
        foreach ($cat_two as $key => $value) {
            $cat[] = $value['id'];
        }
        $cat_id = implode(',', $cat);

        return $cat_id;
    }

}


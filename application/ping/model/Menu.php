<?php
/**
 * FILE_NAME:Menu.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/30
 * DESC:
 */

namespace app\ping\model;

use think\Model;

class Menu extends Model
{
    //设置模型的数据集返回类型的话
    protected $resultSetType = 'collection';

    public function getMenuList()
    {
        return Menu::where(['status'=>1])->order('id')->select()->toArray();
    }
}
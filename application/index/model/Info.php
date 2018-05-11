<?php
/**
 * FILE_NAME:Info.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/27
 * DESC:
 */

namespace app\index\model;

use think\Model;

class Info extends Model
{
    //设置模型的数据集返回类型的话
    protected $resultSetType = 'collection';


    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }

    public function getAbout()
    {
        Blog::where('cateid','4')->setInc('readed_sum');
        return Blog::where('cateid','4')->find();
    }
}
<?php
/**
 * FILE_NAME:Tagsmap.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/28
 * DESC:
 */

namespace app\index\model;

use think\Model;
class Tagsmap extends Model
{
    //设置模型的数据集返回类型的话
    protected $resultSetType = 'collection';

    public function getBlogsByTagId($id)
    {
        return Tagsmap::where(['tagid'=>$id])->order('id')->select()->toArray();
    }
}
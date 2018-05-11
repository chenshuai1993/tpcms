<?php
/**
 * FILE_NAME:Tags.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/26
 * DESC:
 */

namespace app\index\model;

use think\Model;

class Tags extends Model
{

    //设置模型的数据集返回类型的话
    protected $resultSetType = 'collection';


    public function getTags()
    {
        return Tags::all()->toArray();
    }

    public function getNameById($id)
    {
        return Tags::where(['id'=>$id])->value('name');
    }
}
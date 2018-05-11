<?php
/**
 * FILE_NAME:Tagsmap.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/28
 * DESC:
 */

namespace app\ping\model;

use think\Model;
class Tagsmap extends Model
{
    //设置模型的数据集返回类型的话
    protected $resultSetType = 'collection';

    public function dealTagsmap($tagId,$blogId)
    {
        Tagsmap::create(['tagid'=>$tagId,'blogid'=>$blogId]);
    }


    public function dealDelTagsmap($tagId,$blogId)
    {
        Tagsmap::where(['blogid' =>$blogId,'tagid' => $tagId ] )->delete();
    }
}
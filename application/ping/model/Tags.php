<?php
/**
 * FILE_NAME:seo.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/22
 * DESC:
 */


namespace app\ping\model;

use think\Model;
use app\ping\model\Tagsmap;

class Tags extends Model
{

    //设置模型的数据集返回类型的话
    protected $resultSetType = 'collection';


    /**
     * @param $param
     * @author chenss
     * @email  css852438363@163.com
     * @desc    处理标签
     */
    public function dealTags($param,$blogId)
    {
        $tags = [];
        if(!empty($param)){
            $tags = explode(',',$param);
        }

        array_walk($tags,function(&$value,$index,$blogId){
            //判断是否存在
            //如果存在 那么count++,
            //如果不存在 那么add  count = 1
            $this->saveTag($value,$blogId);
        },$blogId);
    }

    /**
     * @param $tag
     * @author chenss
     * @email  css852438363@163.com
     * @desc   更新 insert or update
     */
    public function saveTag($tag,$blogId)
    {
        $info = Tags::get(['name' => $tag]);
        //处理tags表
        if($info){
            Tags::where(['name'=>$tag])->setInc('count');
        }else{
            Tags::create(['name'=>$tag]);
            //echo Tags::getLastSql();
        }


        //处理tagsmap表
        $tagId = Tags::where(['name'=>$tag])->value('id');
        model('tagsmap')->dealTagsmap($tagId,$blogId);

    }


    public function dealEditTages($tags,$oldTags,$blogId)
    {
        $tags_temp = [];
        $oldTags_temp = [];
        if(!empty($tags)){
            $tags_temp = explode(',',$tags);
        }
        if(!empty($oldTags)){
            $oldTags_temp = explode(',',$oldTags);
        }

        //判断数组的差异
        //先判断新增加
        foreach ($tags_temp as $key=>$val){
            if(!in_array($val,$oldTags_temp)){
              //新增 或者 加一
                $info = Tags::get(['name' => $val]);
                //处理tags表
                if($info){
                    Tags::where(['name'=>$val])->setInc('count');
                }else{
                    Tags::create(['name'=>$val]);
                }


                //添加记录
                $tagId = Tags::where(['name'=>$val])->value('id');
                model('tagsmap')->dealTagsmap($tagId,$blogId);

            }
        }

        //在判断删除
        foreach ($oldTags_temp as $key=>$val){
            if(!in_array($val,$tags_temp)){
                //新增 或者 加一
                $info = Tags::get(['name' => $val]);
                //处理tags表
                if($info){
                    if($info['count'] <= 1){
                        //删除某个记录
                        $tagId = Tags::where(['name'=>$val])->value('id');
                        model('tagsmap')->dealDelTagsmap($tagId,$blogId);

                        Tags::where(['name'=>$val])->delete();
                    }else{
                        Tags::where(['name'=>$val])->setDec('count');
                    }


                }

            }
        }







    }


    public function editTags($key)
    {

        //跟修改前对比
        //如果已经存在的  那么不动
        //如果新增的  如果存在  计数加1, 不存在就创建 计数加1
        //如果删除的  那么计数为0了  那么删除这个tag  如果计数不为0  那么计数减一
    }


}
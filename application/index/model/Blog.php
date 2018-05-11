<?php
/**
 * FILE_NAME:blog.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/7
 * DESC:
 */

namespace app\index\model;

use think\Model;

use think\paginator\driver\Bootstrap;
use think\db\Query;

class Blog extends Model
{
    //设置模型的数据集返回类型的话
    protected $resultSetType = 'collection';

    //设置获取器
    public function getCateNameAttr($value,$data)
    {
        $catelist = model('Cate')->getListAll();
        $cates = array_column($catelist,'cate','id');
        return $cates[$data['cateid']];
    }

    protected function scopeBlogsByTagId($query)
    {
        $query->where('id','in',20)->limit(10);
    }

    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }

    /**
     * @return mixed
     * @author chenss
     * @email  css852438363@163.com
     * @desc    栏目列表
     */
    public function getList()
    {
        $result = [];
        return Blog::where('static',1)->order('id','desc')->paginate(12,true);

    }


    public function getBlogsByCateId($id)
    {
        $where = [
            'static'=>1,
            'cateid'=>$id
        ];
        return Blog::where($where)->order('id','desc')->paginate(12,true);
    }


    public function getDetailsById($id)
    {

        Blog::where(['id'=>$id])->setInc('readed_sum');
        return Blog::get($id);
    }


    /**
     * @author chenss
     * @email  css852438363@163.com
     * @desc    获取公告
     */
    public function getAffiche()
    {
        return Blog::where('cateid','3')->select();
    }

    /**
     * @param $ids
     * @return array
     * @author chenss
     * @email  css852438363@163.com
     * @desc   根据
     */
    public function getBlogsByiIds($ids)
    {
        $blogList  = Blog::where('id','in',$ids)->order(['id'=>'desc'])->paginate(12,true);
        return $blogList;
    }


}
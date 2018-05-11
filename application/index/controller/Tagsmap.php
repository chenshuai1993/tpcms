<?php
/**
 * FILE_NAME:Tagsmap.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/28
 * DESC:
 */

namespace app\index\controller;

use app\index\controller\Base;

class Tagsmap extends  Base
{
    protected  $model = '';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('Tagsmap');

    }

    /**
     * @param $id
     * @return \think\response\View
     * @author chenss
     * @email  css852438363@163.com
     * @desc   根据tagid 获取数据
     */
    public function getBlogsByTagId($id)
    {
        //$blogIds
        $blogIds = [];
        $tagsmap = $this->model->getBlogsByTagId($id);

        if($tagsmap){
            $blogIds = array_column($tagsmap,'blogid');
        }

        //调用blog 方法
       $blogListPage =  action('blog/getBlogsByiIds',[$blogIds]);
       $tagsname =  action('tags/getNameById',[$id]);

       $this->assign('blogListPage',$blogListPage);
       $this->assign('tagsname',$tagsname);
       $this->assign('title','标签'.$tagsname);
       return view('tags');
    }
}
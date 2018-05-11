<?php
namespace app\index\controller;

use app\index\controller\Base;


class Index extends Base
{

    public function index()
    {
        //获取全部文章
        $blogList = action('blog/getBlogList');


        $this->assign('title','博客首页');
        //赋值
        $this->assign('blogList',$blogList);

        return view();
    }


    //七夕
    public function qixi(){
        $this->view->engine->layout(false);
        return view();
    }

}

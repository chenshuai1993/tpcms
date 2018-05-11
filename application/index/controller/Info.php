<?php
/**
 * FILE_NAME:Info.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/27
 * DESC:
 */

namespace app\index\controller;

use app\index\controller\Base;

class Info extends Base
{
    private  $model = '';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('Info');

    }

    public function about()
    {
        $about = $this->model->getAbout();
        $this->assign('about',$about);
        $this->assign('title',$about['title']);
        return view();
    }
}
<?php
/**
 * FILE_NAME:index.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/2
 * DESC:
 */

namespace  app\ping\controller;

use app\ping\controller\Base;

class Index extends Base
{

    /**
     * @return \think\response\View
     * @author chenss
     * @email  css852438363@163.com
     * @desc   登录
     */
    public function index()
    {
        //$this->view->engine->layout('layout/layout');
        return view();
    }


    public function main()
    {
        //$this->view->engine->layout(false);
        return view();
    }






















}
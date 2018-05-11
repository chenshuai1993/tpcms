<?php
/**
 * FILE_NAME:login.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/2
 * DESC:    公共的server
 */

namespace app\ping\controller;


class Login extends \think\Controller
{

    /**
     * @return \think\response\View
     * @author chenss
     * @email  css852438363@163.com
     * @desc    公共的
     */
    public function login()
    {
        //echo __env

        $this->view->engine->layout('layout/unwork');
        return view('login/login');
    }

    public function logout()
    {
        $this->view->engine->layout(false);
        return view();
    }


}
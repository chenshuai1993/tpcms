<?php
/**
 * FILE_NAME:cate.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/5
 * DESC:
 */

namespace app\ping\controller;


use think\Controller;

class Publics extends Controller
{
    private  $model = '';

    public function _initialize()
    {
        $this->model = model('User');
    }


    /**
     * @author chenss
     * @email  css852438363@163.com
     * @desc   检测登录
     */
    public function login()
    {
        $params = request()->param();
        $checkLogin = $this->model->checkLogin($params);
        echo json_encode($checkLogin);
    }


    public function logout()
    {
        $this->view->engine->layout(false);
        return view();
    }



}
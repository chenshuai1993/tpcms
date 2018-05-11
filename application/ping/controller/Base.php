<?php
/**
 * FILE_NAME:Base.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/26
 * DESC:
 */

namespace app\ping\controller;

use think\Controller;
use think\Request;

class Base extends Controller
{
    //操作前方法
    protected $beforeActionList = [];


    /**
     * @author chenss
     * @email  css852438363@163.com
     * @desc   控制器初始化
     */
    public function _initialize()
    {
        //set model
        parent::_initialize();

        //验证登录session
        if(!session('username')){
            $this->redirect('/ping/login/login');
        }


    }


    /**
     * @param $name
     * @return \think\response\View
     * @author chenss
     * @email  css852438363@163.com
     * @desc    空方法
     */
    public function _empty($name)
    {
        $request = request();
        //把所有空操作 指定到这个方法
        return view($request->action());
    }




}
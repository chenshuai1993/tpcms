<?php
/**
 * FILE_NAME:cate.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/23
 * DESC:
 */


namespace app\index\controller;

use app\index\controller\Base;

class cate extends Base
{

    private  $model = '';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('cate');

    }

    public function index($cate)
    {
        return view();
    }


    public function details()
    {
        return view();
    }

    /**
     * @return mixed
     * @author chenss
     * @email  css852438363@163.com
     * @desc    获取导航显示的栏目
     */
    public function getCateList()
    {
        return $this->model->getList();
    }

    /**
     * @return mixed
     * @author chenss
     * @email  css852438363@163.com
     * @desc    获取全部栏目
     */
    public function getCateListAll()
    {
        return $this->model->getListAll();
    }

}
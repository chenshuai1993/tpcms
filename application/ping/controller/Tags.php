<?php
/**
 * FILE_NAME:tags.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/23
 * DESC:
 */

namespace app\ping\controller;

use app\ping\controller\Base;

class Tags extends  Base
{
    private  $model = '';

    public function _initialize()
    {
        $this->model = model('Tags');

    }

    /**
     * @author chenss
     * @email  css852438363@163.com
     * @desc
     */
    public function dealTages($param,$blogInsertId)
    {
        $this->model->dealTags($param,$blogInsertId);

    }

    /**
     * @author chenss
     * @email  css852438363@163.com
     * @desc
     */
    public function dealEditTages($editTags,$oldTags,$blogInsertId)
    {
        $this->model->dealEditTages($editTags,$oldTags,$blogInsertId);
    }


    public function index()
    {
        $name = 'php1';
        $this->model->getname($name);
    }



}
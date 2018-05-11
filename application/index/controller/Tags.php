<?php
/**
 * FILE_NAME:Tags.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/26
 * DESC:
 */

namespace app\index\controller;

use app\index\controller\Base;
class Tags extends Base
{
    protected  $model = '';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('Tags');

    }

    public function getTags()
    {
        $tags = $this->model->getTags();
        return $tags;
    }

    public function getNameById($id)
    {
        return $this->model->getNameById($id);
    }
}
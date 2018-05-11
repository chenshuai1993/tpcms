<?php

/**
 * FILE_NAME:cate.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/5
 * DESC:
 */

namespace app\index\model;

use think\Model;

class Cate extends Model
{
    //设置模型的数据集返回类型的话
    protected $resultSetType = 'collection';


    /**
     * @return mixed
     * @author chenss
     * @email  css852438363@163.com
     * @desc    栏目列表
     */
    public function getList()
    {
        $result = [];
        return Cate::where('static','1')->order('sort','asc')->select()->toArray();

    }

    public function getListAll()
    {
        $result = [];
        return Cate::select()->toArray();

    }





}
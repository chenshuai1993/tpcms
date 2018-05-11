<?php

/**
 * FILE_NAME:cate.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/5
 * DESC:
 */

namespace app\ping\model;

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
    public function getList($pages)
    {
        $params = [
            'page'=>0,
            'limit'=>10
        ];

        $params = array_merge($params,$pages);

        $start = $params['page'] >= 1 ?  ($params['page']-1) * $params['limit'] : 0;

        // 查询数据集
        $list = Cate::where('static','in','0,1,2')
            ->order('id', 'desc')
            ->limit($start,$params['limit'])
            ->select()
            ->toArray();
        return $list;

    }

    public function getListCount($pages)
    {
        $params = [
            'page'=>0,
            'limit'=>10
        ];

        $params = array_merge($params,$pages);

        $start = $params['page'] >= 1 ?  ($params['page']-1) * $params['limit'] : 0;

        // 查询数据集
        $count = Cate::where('static','in','0,1,2')->count();
        return $count;

    }


    /**
     * @return false|static[]
     * @throws \think\exception\DbException
     * @这个方法-向外提供数据
     */
    public function getCateList()
    {
        return Cate::all()->toArray();
    }



    public function cateSave($data = [])
    {
        $cate= new Cate();
        if(!empty($data['id'])){
            // 过滤post数组中的非数据表字段数据
            $id = $data['id'];
            unset($data['id']);
            $cate->allowField(true)->save($data,['id'=>$id]);
            return true;
        }else{
            unset($data['id']);
            $cate->allowField(true)->save($data);
            return $cate->id;
        }

    }

    public function cateDelete($data = [])
    {
        return Cate::destroy($data['id']);

    }
}
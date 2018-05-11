<?php
/**
 * FILE_NAME:cate.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/5
 * DESC:
 */

namespace app\ping\controller;

use app\ping\controller\Base;

class Cate extends Base
{
    private  $model = '';

    public function _initialize()
    {
       $this->model = model('Cate');

    }

    public function index()
    {
        return view();

    }

    /**
     * @return mixed
     * @author chenss
     * @email  css852438363@163.com
     * @desc    获取栏目列表-向外提供服务
     */
    public function getCateList()
    {
        return $this->model->getCateList();
    }

    /**
     * @return mixed
     * @author chenss
     * @email  css852438363@163.com
     * @desc    获取全部栏目
     */
    public function getCateListAll()
    {

        $pages = request()->param();

        $result = [
            'code'=>0,
            'msg'=>'请求成功',
            'count'=>100,
            'data'=>[]
        ];


        //获取数据
        $_cateList  = $this->model->getList($pages);
        $_cateListCount  = $this->model->getListCount($pages);
        $result['data'] = $_cateList;
        $result['count'] = $_cateListCount;

        return $result;
    }


    public function _empty($name)
    {
        $request = request();
        //把所有空操作 指定到这个方法
        return view($request->action());
    }


    /**
     * @author chenss
     * @email  css852438363@163.com
     * @desc   保存一条数据，如果有则是更新 如果没有新增
     */
    public function save()
    {
        $result = [
            'code'=>'200',
            'data'=>[
                'insortId'=>'',
            ]
        ];
        $request = request()->param();
        $info =  $this->model->cateSave($request);
        return $result;
    }


    public function delete()
    {
        $result = [
            'code'=>'200',
            'message'=>'删除成功',
            'data'=>[]
        ];
        $request = request()->param();
        $info =  $this->model->cateDelete($request);
        if(empty($info)){
            $result = [
                'code'=>'500',
                'message'=>'删除失败',
            ];
        }

        return $result;

    }




}
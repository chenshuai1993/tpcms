<?php
/**
 * FILE_NAME:seo.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/22
 * DESC:
 */

namespace app\ping\controller;

use app\ping\controller\Base;

class Seo extends Base
{

    private  $model = '';

    public function _initialize()
    {
        $this->model = model('Seo');

    }

    public function index()
    {
        //查询seo信息
        $seo = $this->model->getSeo();
        $this->assign('seoInfo',$seo);
        return view();
    }


    /**
     * @return mixed
     * @author chenss
     * @email  css852438363@163.com
     * @desc  单独方法 给行为使用
     */
    public function getSeo()
    {
        return $this->model->getSeo();
    }

    /**
     * @author chenss
     * @email  css852438363@163.com
     * @desc   设置配置
     */
    public function seting()
    {
        $return = [
            'code'=>'200',
            'message'=>'设置成功',
            'data'=>[],
        ];
        $param = request()->param();
        $result  = $this->model->secSeting($param);
        return json($return);
    }
}
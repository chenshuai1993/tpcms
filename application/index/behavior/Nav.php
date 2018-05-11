<?php
/**
 * FILE_NAME:seo.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/22
 * DESC:
 */

namespace app\index\behavior;

use app\index\controller\Base;

class Nav extends  Base
{
    public function run(&$params)
    {
        $request = request();
        $controller = $request->controller();
        $action = $request->action();
        $route = $request->route('cate');
        $cur = '';
        $cateList = action('index/cate/getCateList');
        $cateListName = array_column($cateList,'cate','id');

        //print_r($cateListName);

        //var_dump($route);

        if(in_array($route,$cateListName)){
            $cur = $route;
        }else{
            $cur = $action;
        }

        $this->assign('cur',$cur);

    }

}
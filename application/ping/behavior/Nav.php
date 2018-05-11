<?php
/**
 * FILE_NAME:seo.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/22
 * DESC:
 */

namespace app\ping\behavior;

use think\Controller;

class Nav extends  Controller
{
    public function run(&$params)
    {
        $cur = '';
        $request = request();
        $module  =   $request->module();
        $controller = $request->controller();
        $action = $request->action();

        $url = strtolower(DS.$module.DS.$controller.DS.$action);
        $this->assign('url',$url);
    }

}
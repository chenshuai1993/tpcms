<?php
/**
 * FILE_NAME:menu.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/22
 * DESC:
 */

namespace app\ping\behavior;

use think\Controller;

class Menu extends  Controller
{
    public function run(&$params)
    {
        $menu = action('ping/menu/getMenuList');
        $this->assign('menu',$menu);
    }
}
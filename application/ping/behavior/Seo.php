<?php
/**
 * FILE_NAME:seo.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/22
 * DESC:
 */

namespace app\ping\behavior;

use think\Controller;

class Seo extends  Controller
{
    public function run(&$params)
    {

        $seoInfo = action('ping/seo/getSeo');
        $this->assign('seoInfo',$seoInfo);
    }
}
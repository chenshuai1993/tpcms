<?php
/**
 * FILE_NAME:seo.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/22
 * DESC:
 */

namespace app\index\behavior;

use app\index\controller\Base;

class Seo extends  Base
{
    public function run(&$params)
    {
        $seoInfo = action('ping/seo/getSeo');
        $this->assign('seoInfo',$seoInfo);
    }
}
<?php
/**
 * FILE_NAME:seo.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/22
 * DESC:
 */

namespace app\index\behavior;

use app\index\controller\Base;

class Tags extends  Base
{
    public function run(&$params)
    {

        //获取tags
        $tags = action('tags/getTags');
        $this->assign('tags',$tags);
    }
}
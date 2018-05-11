<?php
/**
 * FILE_NAME:Affiche.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/27
 * DESC:
 */

namespace app\index\behavior;

use app\index\controller\Base;

class Affiche extends  Base
{
    public function run(&$params)
    {
        $afficheList = action('blog/getAffiche');
        $this->assign('afficheList',$afficheList);
    }
}
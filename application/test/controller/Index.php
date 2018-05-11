<?php
namespace app\test\controller;

use think\Collection;


class Index extends Collection
{

    public function index()
    {
        //phpinfo();
        //cache('chen','111',['type'=>'memcache','expire'=>10]);
        echo cache('chen');

    }

}

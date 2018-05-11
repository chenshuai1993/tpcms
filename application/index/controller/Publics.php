<?php
namespace app\index\controller;

use app\index\controller\Base;


class publics extends Base
{

    public function miss()
    {
       $this->view->engine->layout(false);
       return view();
    }

}

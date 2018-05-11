<?php
/**
 * FILE_NAME:Menu.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/30
 * DESC:
 */

namespace app\ping\controller;

use app\ping\controller\Base;

class Menu  extends Base
{
    private  $model = '';

    public function _initialize()
    {
        $this->model = model('Menu');

    }

    /**
     * @author chenss
     * @email  css852438363@163.com
     * @desc    获取菜单
     */
    public function getMenuList()
    {
        $menuList = $this->model->getMenuList();

        //deal menu
        return createMeun($menuList);
    }


    /**
     * @author chenss
     * @email  css852438363@163.com
     * @desc   菜单管理
     */
    public function index()
    {

        return view();
    }

    public function getMenuListAll()
    {
        $result = [
            'code'=>0,
            'msg'=>'请求成功',
            'count'=>100,
            'data'=>[]
        ];

        $menuList = $this->model->getMenuList();
        $menu =  createMeun($menuList,true);
        $dealMenu = $this->dealMenu($menu);

        $result['data'] = $dealMenu;

        return $result;

    }

    public function dealMenu($menu)
    {
        $result = [];

        foreach ($menu as $key => $value){
            $result[] = $value;

            if(isset($value['kid'])){
                foreach ($value['kid'] as $k => $v ){
                    $result[] = $v;
                }
            }
        }

        return $result;
    }
}
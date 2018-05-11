<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Request;
// 应用公共文件


/**
 * @author chenss
 * @email  css852438363@163.com
 * @desc   生成菜单
 */
function createMeun($menuList,$flag=false){

    $menu ='';

    $level = array_column($menuList,'level');
    $sort = array_column($menuList,'sort');
    array_multisort($level,SORT_ASC,$sort,SORT_ASC,$menuList);

    //菜单
    $menuLevelOne  = [];
    $menuLevelTwo  = [];
    foreach ($menuList as $key => $value) {
        $level = $value['level'];
        if(1 == $level){
            $menuLevelOne[$value['id']] = $value;
        }else if(2 == $level){
            $menuLevelTwo[$value['id']] = $value;
        }
    }

    foreach ($menuLevelTwo as $k => $v){
        if($v['level'] == 2){
            $pid = $v['pid'];
            $menuLevelOne[$pid]['kid'][] = $v;
        }
    }

    //print_r($menuLevelOne);

    if($flag){
        return $menuLevelOne;
    }else{
        foreach ($menuLevelOne as $key => $value){

            //如果是第一个菜单，默认选中
            if($key == 1){
                $menu_check = '<li class="layui-nav-item layui-nav-itemed">';
            }else{
                $menu_check = '<li class="layui-nav-item">';
            }


            if(empty($value['kid'])){ //没有子菜单
                $menu .= $menu_check;
                $menu .=  '<a id='.$value['id'].'href="javascript:;" data-url="' .$value['url']. '">';
                $menu .=  $value['name'];
                $menu .=  '</a>';
            }else{//有子菜单
                $menu .= $menu_check;
                $menu .=  '<a href="javascript:;">';
                $menu .=  $value['name'];
                $menu .=  '</a>';

                $menu .= '<dl class="layui-nav-child">';

                //二级菜单
                foreach ($value['kid'] as $k => $v){
                    //<dd><a href="javascript:;">列表一</a></dd>
                    $menu .= '<dd><a id='.$v['id'].' href="javascript:;" data-url="' . $v['url'] . '">' . $v['name'] . '</a></dd>';
                }

                $menu .= '</dl>';
            }
            $menu .=  '</li>';
        }

        //$menu .= '</ul>';
        return $menu;
    }




}
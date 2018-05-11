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


function getCateNameById($id){
    $cateList = action('cate/getCateListAll');
    $cateListdo = array_column($cateList,'cate','id');
    print_r($cateListdo);

    return strtoupper($cateListdo[$id]);
}




/**
 * @param $cateId
 * @author chenss
 * @email  css852438363@163.com
 * @desc    根据栏目id 获取设置的默认图
 */
function  getDefaultImgByCateId($cateId){
    $cateList = action('cate/getCateList');
    $cateListdo = array_column($cateList,'cate','id');

    $cate_img_url =  'default'.DS.$cateListdo[$cateId].'.png';
    $cate_img_true_url =  ROOT_PATH.'public'.DS.'uploads'.DS.$cate_img_url;

    //判断是否存在  如果不存在就显示默认
    if(file_exists($cate_img_true_url)){
        return $cate_img_url;
    }else{
        return 'default'.DS.'default.png';
    }

}


// 通过hook方法注入动态方法
//方法注入
Request::hook('user','getUserInfo');
function getUserInfo(Request $request, $userId){
    return $userId;
}

<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::rule('/','index','get'); //首页
Route::rule('/qixi','index/index/qixi','get'); //七夕


//标签
Route::rule('tags/:id$','tagsmap/getBlogsByTagId','get',['id'],['id'=>'\d+','ext'=>'html']);

//关于我
Route::rule('about','info/about','get',['ext'=>'html']);

//Route::rule('ping/blog/details','ping/blog/details','get'); //首页


//路由分组-博客栏目-博客详情
Route::group(':cate',[
    ':id$'   => ['blog/details', [], ['id' => '\d+']],
    '/$' => ['blog/cate', []],
    ],['method'=>'get','ext'=>'html'],['cate'=>'[a-z]+']);

//Route::rule('__miss__','publics/miss','get'); //miss 路由








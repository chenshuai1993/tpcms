<?php
/**
 * FILE_NAME:Blog.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/26
 * DESC:
 */

namespace app\index\valiodate;

use think\Validate;

class Blog extends  Validate
{
    protected $rule = [
        'name'  =>  'require|max:25',
        'email' =>  'email',
    ];

    protected $message = [
        'name.require'  =>  '用户名必须',
        'email' =>  '邮箱格式错误',
    ];

    protected $scene = [
        'add'   =>  ['name','email'],
        'edit'  =>  ['email'],
    ];
}
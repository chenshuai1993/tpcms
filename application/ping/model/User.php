<?php
/**
 * FILE_NAME:User.php
 * AUTHOR:   ChenShuai
 * Date:     2017/7/21
 * DESC:
 */

namespace app\ping\model;

use think\Model;
class User extends  Model
{
    public function checkLogin($param)
    {

        $result = [
            'code'=>'500',
            'message'=>'验证码错误',
            'data'=>[],
        ];

        //验证验证码
        if(!captcha_check($param['vercode'])){
            return $result;
        }

        $userInfo = User::where('username',$param['username'])->find();
        if(!empty($userInfo)){
            $info = $userInfo->data;
            if($info['password_hash'] === md5($param['password'])){
                //验证成功,在这里种个session
                session(null);
                session('username',$param['username']);
                $result = [
                    'code'=>'200',
                    'message'=>'登录成功',
                    'data'=>[],
                ];
            }else{
                $result['message'] = '用户名或者密码错误';
            }
        }else{
            $result['message'] = '用户名或者密码错误';
        }

        return $result;
    }
}
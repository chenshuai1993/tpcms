<?php
namespace app\wx\controller;

use app\wx\controller\WxApi;

class Index extends WxApi
{


    public function _initialize()
    {
        parent::_initialize();
        if(!empty(request()->param('echostr'))){
           $this->valid();
        }

    }

    /**
     * @author chenss
     * @email  css852438363@163.com
     * @desc   处理信息
     */
    public function index()
    {
       $this->responseMsg();
    }


    /**
     * @author chenss
     * @email  css852438363@163.com
     * @desc    生成菜单
     */
    public function wx_create_menu()
    {
        $data = '{
		     "button":[
		      {	
		          "name":"关于我们",
		          "sub_button":[
		            {
		          		"type":"click",
		          		"name":"我们的故事",
		          		"key":"STORY"
		          	},
		          	{
		          		"type":"view",
		          		"name":"官网地址",
		          		"url":"http://www.baidu.com"
		          	}
		          	
		          ]
		      },
		      {
		           "name":"博客->陈帅",
		           "type":"view",
		           "url":"http://www.imshuai.cn"		   
		       }]
		 }';


        $result = $this->menu_create($data);
        print_r($result);
    }
    
    
    /**
     * 查询菜单
     */
    public function wx_select_meun()
    {
        $result = $this->menu_select();
        print_r($result);
    }


    public function wx_delete_menu()
    {
        $result = $this->menu_delete();
        print_r($result);
    }


    /**
     * @return mixed
     * @author chenss
     * @email  css852438363@163.com
     * @desc   获取微信token
     */
    public function wx_access_token()
    {
        return $this->getAccessToken();
    }










}

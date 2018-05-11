<?php
/**
 * FILE_NAME:cate.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/5
 * DESC:
 */

namespace app\ping\controller;


use app\ping\controller\Base;

class Blog extends Base
{
    private  $model = '';

    private  $operate = [
        'on'=>'1'
    ];

    private  $is_comment = [
        'on'=>'1'
    ];

    public function _initialize()
    {
        $this->model = model('Blog');

    }

    public function _empty($name)
    {
        $request = request();
        //把所有空操作 指定到这个方法
        return view($request->action());
    }

    /**
     * @return \think\response\View
     * init
     */
    public function index()
    {
       return view();
    }


    /**
     * @return array
     * @ajax 获取博客数据
     */
    public function getBlogList()
    {

        $pages = request()->param();

        $result = [
            'code'=>0,
            'msg'=>'请求成功',
            'count'=>100,
            'data'=>[]
        ];

        //获取数据
        $_blogList  = $this->model->getList($pages);
        $_blogListCount  = $this->model->getListCount($pages);
        $result['data'] = $_blogList;
        $result['count'] = $_blogListCount;

        return $result;
    }


    /**
     * @author chenss
     * @email  css852438363@163.com
     * @desc    新增文章
     */
    public function insert()
    {
        //获取cate栏目列表
        $cateList = action('cate/getCateList');

        return view('insert',[
            'cateList'=>$cateList
        ]);
    }

    /**
     * @author chenss
     * @email  css852438363@163.com
     * @desc   添加文章
     */
    public function insert_one()
    {
        $result = [
            'code'=>'200',
            'message'=>'新增成功',
            'data'=>[
                'insortId'=>'',
            ]
        ];

        //先判断tags
        $request = request()->param();
        //print_r($request);die;

        //判断 是否置顶 是否可以评论
        if(isset($request['is_comment']) && 'on' == $request['is_comment']){
            $request['is_comment'] = 1;
        }
        if(isset($request['operate']) && 'on' == $request['operate']){
            $request['operate'] = 1;
        }


        $file = request()->file('img');

        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $request['img'] = $info->getSaveName();
            }else{
                $this->error('图片上传失败');
            }

        }else{
            $request['img'] = getDefaultImgByCateId($request['cateid']);
        }

        $blogInsertId =  $this->model->blogSave($request);
        if($blogInsertId){
            //处理tags
            action('tags/dealTages',[$request['tags'],$blogInsertId]);

            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            //$this->success('新增成功', '/ping/blog/index');
            $result['data']['insortId'] = $blogInsertId;
            return $result;
        } else {
            $result = [
                'code'=>'500',
                'message'=>'添加失败'
            ];
        }


    }




    /**
     * @param $id
     * @return \think\response\View
     * @author chenss
     * @email  css852438363@163.com
     * @desc 根据id 获取详情
     */
    public function details($id)
    {
        //获取cate栏目列表
        $cateList = action('cate/getCateList');
        $result =  $this->model->getDetails($id);
        return view('details',['info'=>$result,'cateList'=>$cateList]);
    }

    /**
     * @param $id
     * @return \think\response\View
     * @编辑博客
     */
    public function edit($id)
    {
        //获取cate栏目列表
        $cateList = action('cate/getCateList');
        $result =  $this->model->getDetails($id);
        return view('edit',['info'=>$result,'cateList'=>$cateList]);
    }



    /**
     * @author chenss
     * @email  css852438363@163.com
     * @desc   保存一条数据，如果有则是更新 如果没有新增
     */
    public function save()
    {
        $result = [
            'code'=>'200',
            'message'=>'更新成功'
        ];

        //先判断tags
        $request = request()->param();

        $file = request()->file('img');
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $request['img'] = $info->getSaveName();
            }else{
                $this->error('图片上传失败');
            }

        }else{
            $request['img'] = getDefaultImgByCateId($request['cateid']);
        }

        //先进行tags 处理
        if($request['id']){
            //处理 tags
            //根据id 找到文章的tags
            $details =  $this->model->getDetails($request['id']);
            if(!empty($details['tags'])){
                $oldTags = $details['tags'];
                //处理tags
                action('tags/dealEditTages',[$request['tags'],$oldTags,$request['id']]);
            }else{
                $oldTags = [];
                //处理tags
                action('tags/dealEditTages',[$request['tags'],$oldTags,$request['id']]);
            }


        }


        $blogInsertId =  $this->model->blogSave($request);
        if($blogInsertId){
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            //$this->success('更新成功', '/ping/blog/index');
            return $result;
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            //$this->error('更新失败');
            $result = [
                'code'=>'500',
                'message'=>'更新失败'
            ];
            return $result;

        }

    }



    /**
     * @param $id
     * @author chenss
     * @email  css852438363@163.com
     * @desc    审核文章
     */
    public function check($id)
    {
        $result = [
            'code'=>'200',
            'message'=>'审核成功',
            'data'=>[]
        ];
        $check =  $this->model->check($id);
        if(!$check){
            $result = [
                'code'=>'500',
                'message'=>'审核失败',
                'data'=>[]
            ];
        }

        return $result;
    }


    /**
     * @param $id
     * @author chenss
     * @email  css852438363@163.com
     * @desc    删除文章
     */
    public function delete($id)
    {
        $result = [
            'code'=>'200',
            'message'=>'删除成功',
            'data'=>[]
        ];
        $delete =  $this->model->deleteBlogById($id);
        if(!$delete){
            $result = [
                'code'=>'500',
                'message'=>'删除失败',
                'data'=>[]
            ];
        }

        return $result;
    }




}
<?php
/**
 * FILE_NAME:cate.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/5
 * DESC:
 */

namespace app\index\controller;

use app\index\controller\Base;


class Blog extends Base
{
    private  $model = '';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('Blog');

    }

    /**
     * @param $id
     * @return \think\response\View
     * @author chenss
     * @email  css852438363@163.com
     * @desc   详情
     */
    public function details($cate,$id)
    {
        //查询
        $detaile = $this->model->getDetailsById($id);
        $this->assign('cate',$cate);
        $this->assign('detaile',$detaile);
        $this->assign('title',$detaile['title']);
        return view();
    }


    public function getBlogList()
    {
        $list = $this->model->getList();
        return $list;
    }

    /**
     * @param $id
     * @return \think\response\View
     * @author chenss
     * @email  css852438363@163.com
     * @desc
     */
    public function cate($cate)
    {

        $cateList = action('index/cate/getCateList');
        $cateListName = array_column($cateList,'cate','id');
        $id = 1;
        $id = array_search($cate,$cateListName);
        $blogList = $this->model->getBlogsByCateId($id);
        $this->assign('blogList',$blogList);
        $this->assign('cateid',$id);
        $this->assign('cate',$cate);
        //$this->assign('title','栏目'.$cateListName[$id]);
        $this->assign('title','栏目');
        return view();
    }
    /*public function cate($id)
    {
        $cateList = action('index/cate/getCateList');
        $cateListName = array_column($cateList,'cate','id');

        $blogList = $this->model->getBlogsByCateId($id);
        $this->assign('blogList',$blogList);
        $this->assign('cateid',$id);
        $this->assign('title','栏目'.$cateListName[$id]);
        return view();
    }*/

    /**
     * @author chenss
     * @email  css852438363@163.com
     * @desc    博客公告
     */
    public function getAffiche()
    {
        $affiche = $this->model->getAffiche();
        return $affiche;
    }


    /**
     * @param $Bids
     * @return mixed
     * @author chenss
     * @email  css852438363@163.com
     * @desc    根据博客id查找
     */
    public function getBlogsByiIds($Bids)
    {
        $ids = implode(',',$Bids);
        return  $this->model->getBlogsByiIds($ids);
    }

}
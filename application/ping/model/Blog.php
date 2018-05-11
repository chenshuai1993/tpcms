<?php
/**
 * FILE_NAME:blog.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/7
 * DESC:
 */

namespace app\ping\model;

use think\Model;
use app\ping\model\Cate;


class Blog extends Model
{
    //设置模型的数据集返回类型的话
    protected $resultSetType = 'collection';


    /**
     * @param $value
     * @return mixed
     * @获取器 static
     */
    public function getStaticAttr($value)
    {
        $status = [0=>'未审核',1=>'审核',2=>'软删除'];
        return $status[$value];
    }

    /**
     * @param $value
     * @return mixed
     * @获取器 type
     */
    public function getTypeAttr($value)
    {
        $status = [1=>'原创',2=>'转载'];
        return $status[$value];
    }

    /**
     * @param $value
     * @return mixed
     * @获取器 cataid
     */
    public function getCateidAttr($value)
    {

        $status = Cate::all()->toArray();
        $status = array_column($status,'cate','id');
        return $status[$value];
    }

    public function getList($pages)
    {
        $params = [
            'page'=>0,
            'limit'=>10
        ];

        $params = array_merge($params,$pages);

        $start = $params['page'] >= 1 ?  ($params['page']-1) * $params['limit'] : 0;

        // 查询数据集
        $list = Blog::where('static','in','0,1')
                ->order('id', 'desc')
                ->limit($start,$params['limit'])
                ->select()
                ->toArray();
        return $list;

    }

    public function getListCount($pages)
    {
        $params = [
            'page'=>0,
            'limit'=>10
        ];

        $params = array_merge($params,$pages);

        $start = $params['page'] >= 1 ?  ($params['page']-1) * $params['limit'] : 0;

        // 查询数据集
        $count = Blog::where('static','in','0,1')->count();
        return $count;

    }


    /**
     * @param array $data
     * @return mixed
     * @author chenss
     * @email  css852438363@163.com
     * @desc    更新或保存数据
     */
    public function blogSave($data = [])
    {
        //判断改id 是否存在
        $blog= new Blog();
        if(isset($data['id'])){
            $info = $blog->isUpdate(true)->allowField(true)->save($data);
            return $info;
        }else{
            //allowField  过滤非表单字段
            $info = $blog->allowField(true)->save($data);
            return $blog->id;
        }

    }


    public function getDetails($id)
    {
        $info = Blog::get($id);//->toArray();
        return $info;
    }


    /**
     * @param $id
     * @return $this
     * @author chenss
     * @email  css852438363@163.com
     * @desc    博客审核
     */
    public function check($id)
    {
        return  Blog::where(['id'=>$id])->update(['static' => 1]);
    }

    /**
     * @param $id
     * @return $this
     * @author chenss
     * @email  css852438363@163.com
     * @desc    博客删除
     */
    public function deleteBlogById($id)
    {
        return Blog::destroy($id);
    }
}
<?php
/**
 * FILE_NAME:seo.php
 * AUTHOR:   ChenShuai
 * Date:     2017/6/22
 * DESC:
 */


namespace app\index\model;

use think\Model;


class Seo extends Model
{

    //设置模型的数据集返回类型的话
    protected $resultSetType = 'collection';


    public function getSeo()
    {
        return SEO::get(1)->toArray();
    }


    /**
     * @author chenss
     * @email  css852438363@163.com
     * @desc 设置seo
     */
    public function secSeting($param)
    {
        $Seo = new Seo();
        return $Seo->save($param,['id' => 1]);
    }
}
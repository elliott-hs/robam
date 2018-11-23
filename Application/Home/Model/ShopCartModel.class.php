<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Model;
use Think\Model;

/**
 * 购物车模型
 */
class ShopCartModel extends Model{

	
	protected $_validate = array(
        /* 验证用户名 */
        array('goods_id', 'require', "商品不可为空"),  
       	array('thumb', 'require', "数量不可为空", self::EXISTS_VALIDATE),
       	array('color_id', 'require', "颜色不可为空", self::EXISTS_VALIDATE)
    );

    /* 用户模型自动完成 */
    protected $_auto = array(
        array('user_id','getUser',self::MODEL_BOTH,'callback'),
        array('create_time',NOW_TIME,self::MODEL_INSERT),
        array('update_time',NOW_TIME,self::MODEL_BOTH),
        array('status',1,self::MODEL_INSERT)
    );

    protected function getUser(){
        return  session('user_auth.uid');
    }

   
	public function update($data){
        $data = !empty($data)?$data:$_POST;
        if($this->create($data)){
            if(empty($data['id'])){ //新增数据
                $id = $this->add(); //添加基础内容
                if(!$id){
                    $this->error = '新增出错！';
                    return false;
                }
            }else{ //更新数据
                $status = $this->save(); //更新基础内容
                if(false === $status){
                    $this->error = '更新出错！';
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }

     
    public function info($id=''){
        $map['id'] = $id;
        $map['status'] = 1;
        return $this->where($map)->find();
    }
   
}

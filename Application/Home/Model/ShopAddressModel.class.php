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
 * 地址模型
 */
class ShopAddressModel extends Model{

	
	  protected $_validate = array(
        /* 验证用户名 */
        array('name', 'require', "名称不可为空", self::EXISTS_VALIDATE), //用户名称不可为空
       	array('phone', 'require', "手机不可为空", self::EXISTS_VALIDATE),
       	array('area', 'require', "城市不可为空", self::EXISTS_VALIDATE),
       	array('address', 'require', "地址不可为空", self::EXISTS_VALIDATE)
    );

    /* 用户模型自动完成 */
    protected $_auto = array(
        array('user_id','getUser',self::MODEL_INSERT,'callback'),
        array('create_time',NOW_TIME,self::MODEL_INSERT),
        array('update_time',NOW_TIME,self::MODEL_BOTH),
        array('is_default','getDefault',self::MODEL_INSERT,'callback'),
    );

    protected function getUser(){
        return  session('user_auth.uid');
    }

    protected function getDefault(){
    	$row = $this->def_address(session('user_auth.uid'));
       	return $row?0:1;
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

    public function def_address($uid){
    	$map['status'] = 1;
    	$map['user_id'] = $uid;
    	$map['is_default'] = 1;
       	$row = $this->where($map)->find();
       	return $row;
    }

   
}

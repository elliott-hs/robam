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
 * 分类模型
 */
class OrdersModel extends Model{
	
	protected $_validate = array(
		array('order_id', 'require', '订单号不可为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
	);

	protected $_auto = array(
		array('create_time', NOW_TIME, self::MODEL_INSERT),
		array('update_time', NOW_TIME, self::MODEL_BOTH),
	);

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

    public function info($order_id=''){
        $map['order_id'] = $order_id;
        return $this->where($map)->find();
    }

    public function list_season($user_id,$season_time){
        $map['create_time'] = array('between',$season_time);
        $map['user_id'] = $user_id;
        $map['status'] = 3;
        $result = $this->where($map)->select();
        return $result;
    }
}

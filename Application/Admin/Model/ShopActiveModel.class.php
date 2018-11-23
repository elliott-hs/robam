<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------

namespace Admin\Model;
use Think\Model;
use Admin\Model\AuthGroupModel;

/**
 * 活动模型
 */
class ShopActiveModel extends Model{

    /* 自动验证规则 */
    protected $_validate = array(
        array('title', 'require', '标题不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('title', '1,180', '标题长度不能超过180个字符', self::MUST_VALIDATE, 'length', self::MODEL_BOTH),
    	array('type', array(1,2,3,4), '请选择类型', self::MUST_VALIDATE , 'in', self::MODEL_BOTH),
        array('price_active', 'require', '价格|优惠不可为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('game_start', 'require', '开始时间不正确', self::VALUE_VALIDATE, 'regex', self::MODEL_BOTH),
        array('game_end', 'require', '结束时间不正确', self::EXISTS_VALIDATE , 'regex', self::MODEL_BOTH),
     );

    /* 自动完成规则 */
    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
		array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('game_start','get_strtotime',self::MODEL_BOTH,'callback') , 
        array('game_end','get_strtotime',self::MODEL_BOTH,'callback') , 
		array('status', 1, self::MODEL_INSERT),
    );


    protected function get_strtotime($date){
        return strtotime($date);
    }
    public function update($data){
        $data = !empty($data)?$data:$_POST;
        if($this->create($data)){
            if(empty($data['id'])){ //新增数据
                $id = $this->add(); 
                if(!$id){
                    $this->error = '新增出错！';
                    return false;
                }else{
                    return $id;
                }
            }else{ //更新数据
                $status = $this->save(); //更新数据
                if(false === $status){
                    $this->error = '更新出错！';
                    return false;
                }else{
                    return $data['id'];
                }
            }
            return true;
        } else {
            return false;
        }
    }
}

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
 * 文档基础模型
 */
class ShopGoodsModel extends Model{

    /* 自动验证规则 */
    protected $_validate = array(
      
        array('goods_name', 'require', '标题不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('goods_name', '1,180', '标题长度不能超过180个字符', self::MUST_VALIDATE, 'length', self::MODEL_BOTH),
    	array('category_id', 'require', '分类不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    	//array('thumb', 'require', '缩略图不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    	array('price_market', 'currency', '填写正确的价格', self::VALUE_VALIDATE, 'regex', self::MODEL_BOTH),
    	array('price_sales', 'currency', '填写正确的价格', self::VALUE_VALIDATE, 'regex', self::MODEL_BOTH),
    	array('reward_rate', 'currency', '提成比例只能是数字', self::VALUE_VALIDATE, 'regex', self::MODEL_BOTH),
        array('outlink', 'url', '外链格式不正确', self::VALUE_VALIDATE, 'regex', self::MODEL_BOTH),
        array('description', 'require', '简介不能为空', self::EXISTS_VALIDATE , 'regex', self::MODEL_BOTH),
        array('color', 'require', '分类不能为空', self::EXISTS_VALIDATE , 'regex', self::MODEL_BOTH),
    );

    /* 自动完成规则 */
    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
		array('update_time', NOW_TIME, self::MODEL_BOTH),
    );

    public function update($data){
        $data = !empty($data)?$data:$_POST;
        if($this->create($data)){
            if(empty($data['goods_id'])){ //新增数据
                $id = $this->add(); //添加基础内容
                if(!$id){
                    $this->error = '新增出错！';
                    return false;
                }
            }else{ //更新数据
                $status = $this->where('goods_id='.$data['goods_id'])->save(); //更新基础内容
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

   

 

}

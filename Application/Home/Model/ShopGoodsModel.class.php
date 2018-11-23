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
class ShopGoodsModel extends Model{

	 
 	public function info($goods_id){
 		$map['status'] = 2;
 		if($goods_id){
 			$map['goods_id'] = $goods_id;
 		}
 		return $this->where($map)->find();
 	}

}

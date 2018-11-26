<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace Home\Controller;
use OT\DataDictionary;

/**
 * 购物车控制
 */
class CartController extends HomeController {

	public  function _initialize(){
   		parent::_initialize();
   		$this->user_id = session('user_auth.uid');
   	} 
		
	//购物车首页
	public function index(){
		$map['status'] = 1;
   		$map['user_id'] = $this->user_id;
   		if(!$this->user_id){
   			$this->error('用户身份异常');
   		}
   		$list = D('shop_cart')->where($map)->order('create_time')->select();
   		$this->assign('list',$list);
   		$this->display();
	}

	//加入购物车 
	public function ajax_join(){
		$result = array('code'=>0);
		$goods = D('shop_goods')->info(I('goods_id'));
		if(empty($goods)){
			$result['code'] = 1;
			$result['msg'] = '商品不存在，或下架';
		}
		$model = D('shop_cart');

		$map = array('goods_id'=>I('goods_id'),'status'=>1);
		if(I('color_name')){
			$map['color_name'] = I('color_name');
		}
		if(I('fuel_name')){
			$map['fuel_name'] = I('fuel_name');
		}
		$joined = $model->where($map)->find();
		if($joined){
		 	$ros = $model->where('id='.$joined['id'])->setInc('num',I('num'));
		}else{
			$data = I();
			$data['category_id'] = $goods['category_id'];
			$data['price_sales'] = $goods['price_sales'];
			$data['goods_name'] = $goods['goods_name'];
			$data['thumb'] = $goods['thumb'];
			$data['reward_rate'] = $goods['reward_rate'];
			$ros = $model->update($data);
		}
		if(!$ros){
			$result['code'] = 1;
			$result['msg'] = $model->getError();
		} 
		$this->ajaxReturn($result);
	}	 

	public function  ajax_addNum(){
		if(IS_POST){
			$id = I('id');
			$cart = D('shop_cart')->info($id);
			if($cart){
				$result = D('shop_cart')->where('id='.$id)->setInc('num',1);
			}
			$this->ajaxReturn($result);
		}
	}
	public function  ajax_decNum(){
		if(IS_POST){
			$id = I('id');
			$cart = D('cart')->info($id );
			if($cart){
				$result = D('cart')->where('id='.$id)->setDec('num',1);
			}
			$this->ajaxReturn($result);
		}
	}
}

?>
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
 * 商品控制
 */
class GoodsController extends Home2Controller {

    public function index(){
    	$map['status'] = 2;
    	$id = I('id');
    	if($id){
    		$map['category_id'] = $id;
    	}
    	$search = I('search');
    	if ($search) {
    		$map['goods_name'] = array('LIKE','%'.$search.'%');
    		$this->assign('search',$search);
    	}
    	//商品
    	$goods = D('shop_goods')->where($map)->field('goods_id,goods_name,thumb,price_sales')->order('sort_id')->select();
        //目录
    	$category = D('shop_category')->where('status=1')->select();
       	$this->assign('goods',$goods);
       	$this->assign('category',$category);
       	$this->display();
    }

    //商品详情
    public  function item($id=''){
    	$map['status'] = 2;
    	$map['goods_id'] = $id;
    	$item = D('shop_goods')->where($map)->find();
    	if(!$item){
    		$this->error('此产品已经下线',U('goods/index'));
    	}
        //商品价格定制
        $price = price_active($item['goods_id']);
 		$this->assign('price',$price);
        $this->assign('is_login',is_login());
 		$this->assign('item',$item);
    	$this->display('detail');
    }
}
?>
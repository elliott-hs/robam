<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;

/**
 * 订单控制器
 */
class OrderController extends Home2Controller {

	public  function _initialize(){
		parent::_initialize();
		//parent::login();
		$this->user_id = session('user_auth.uid');
	}


	public function index(){
		$orders = D('orders')->info(I('order_id'));
		if(empty($orders)){
			$this->error('不存在的订单');
		}else{
			//$this->redirect('order/my', array('order_id' => $order_id));
		}
		session('order_id',I('order_id'));
		//地址信息
		$address = D("shop_address")->def_address($this->user_id);
		//商品详情
		$items = D('orders_detail')->where("order_id='".I('order_id')."'")->select();
		$this->assign('orders',$orders);
		$this->assign('items',$items);
		$this->assign('address',$address);
		$this->display('index');
	}


	//下单
	public function join(){

		//订单号
		$order_id = 'ROBAM'.date('mdhis') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
		//数据完整性检测
		if(I('checkbox_name')){
			$map['a.id']  = array('in',implode(',',I('checkbox_name')));
			$items = D('shop_cart')
					->alias('a')
					->join('robam_shop_category b ON a.category_id= b.id')
					->where($map)
					->field('a.*,b.name as category_name')
					->select();

			if(empty($items)||count($items)!==count(I('checkbox_name'))){
				$this->error('系统异常，请重试');
			}
			$price_order = 0;
			$reward_money = 0;
			foreach ($items as $item) {
				$tmp = $item['price_sales']*$item['num'];
				$tmp_reward = floatval(($tmp*$item['reward_rate'])/100);
				$price_order += $tmp;
				$reward_money += $tmp_reward;
				$details[] = array(
					'order_id'=>$order_id,
					'goods_id'=>$item['goods_id'],
					'category_name'=>$item['category_name'],
					'goods_name'=>$item['goods_name'],
					'thumb'=>$item['thumb'],
					'fuel_name'=>$item['fuel_name'],
					'color_name'=>$item['color_name'],
					'unit_price'=>$item['price_sales'],
					'sell_num'=>$item['num'],
					'reward_rate'=>$item['reward_rate'],
					'reward_money'=>$tmp_reward
				);
			}
			$cart_join = 1;
		}elseif(I('goods_id')){
			$item = D('shop_goods')
					->alias('a')
					->join('robam_shop_category b ON a.category_id= b.id')
					->where('a.status=2 and a.goods_id='.I('goods_id'))
					->field('a.*,b.name as category_name')
					->find();
			if(!$item){
				$this->error('此产品已经下线',U('goods/index'));
			}
			//商品价格
			$price_sales = price_active(I('goods_id'));
			if(!$price_sales['price']){
				$this->error('系统价格异常,请重试');
			}
			$price_order = $price_sales['price'] * I('num');
			//提成比例
			$reward_rate = $item['reward_rate'];
			if(!$reward_rate){
				$sult = D('shop_category')->find($item['category_id']);
                $reward_rate = $sult['reward_rate'];
			}
			$reward_money = floatval($price_order*$reward_rate/100);
			$details[] = array(
				'order_id'=>$order_id,
				'goods_id'=>$item['goods_id'],
				'category_name'=>$item['category_name'],
				'goods_name'=>$item['goods_name'],
				'thumb'=>$item['thumb'],
				'fuel_name'=>I('fuel_name'),
				'color_name'=>I('color_name'),
				'unit_price'=>$price_sales['price'],
				'sell_num'=>I('num'),
				'reward_rate'=>$item['reward_rate'],
				'reward_money'=>$reward_money
			);
		}else{
			$this->error('非法访问','home/index');
		}

		//创建订单
		$orders = D('orders');
		$orders_detail = D('orders_detail');
		$orders->startTrans();
		$data = array(
			'order_id'   => $order_id,
			'price_order'=> $price_order,
			'price_express'=>0,
			'user_id'    => session('user_auth.uid'),
			'create_time'=> NOW_TIME,
			'reward_money'=>$reward_money,
			'status'=>1,
			'pay_type'=>1,
		);
		$address = D("shop_address")->def_address($this->user_id);
		if(!empty($address)){
			$data['address_id'] = $address['id'];
		}
		$r1 = $orders->update($data);
		$r2 = $orders_detail->addAll($details);
		if($cart_join){
			$r3 = D('shop_cart')->alias('a')->where($map)->save(array('status'=>0));
		}else{
			$r3=1;
		}
		if(!$r1||!$r2||!$r3){
			$orders->rollback();
			$this->error('系统错误');
		}else{
			$orders->commit();
		}
		$this->redirect('order/index', array('order_id' => $order_id));
	}

	//支付
	public function pay(){
		$pay_type = I('fk');
		$order_id = I('order_id');
		$orders = D('orders')->info($order_id);
		if(empty($orders)){
			$this->error('非法的订单');
		}elseif($orders['status']==0){
			$this->redirect('order/my', array('order_id' => $order_id));
		}
		if($pay_type==1){//微信支付
			Vendor("wxpay.lib.JsApiPay");
            $tools = new \JsApiPay();
            $openId = session('wechatUser.openid');
            $api = new \WxPayApi();
            $input = new \WxPayUnifiedOrder();
            $input->SetBody("购买:" ); //购买标题
            $input->SetAttach('购买');
            $input->SetOut_trade_no($order_id); //订单ID
            $price = $orders['price_order']-$orders['agent_cut'];
            if(!$price){
            	$this->error('支付异常');
            }
            $price = 0.01;//测试价格
            $input->SetTotal_fee($price * 100); //价额
            $input->SetTime_start(date("YmdHis"));
            $input->SetTime_expire(date("YmdHis", time() + 600));
            $input->SetGoods_tag("test3");
            $input->SetNotify_url('http://www.gervhome.cn/index.php?m=home&c=PayNotify&a=notify'); //支付回调地址
            $input->SetTrade_type("JSAPI");
            $input->SetOpenid($openId);
            $order = $api->unifiedOrder($input);
            if ($order['return_code'] == "SUCCESS") {
                $jsapiDATA['jsApiParameters'] = $tools->GetJsApiParameters($order);
                $jsapiDATA['editAddress'] = $tools->GetEditAddressParameters(session('user_access_token'));
                $this->assign('jsApiParameters', $jsapiDATA['jsApiParameters']);
               $this->assign("return_url", U('order/my'));
                $this->assign("cancel_url",$_SERVER['HTTP_REFERER']);
                 $this->assign("order_id",$order_id);
                $this->display('WxPay:wxpay');
            } else {
                $this->assign('message', "支付异常,请重试~"); //商户key错误
                $this->display('WxPay:wxpay-error');
                exit;
            }
		}elseif($pay_type==0){//货到付款
			$orders = D('orders');
			$orders_pay = D('orders_pay');
			$orders->startTrans();
			//更新订单
			$r1 = $orders->where("order_id='".$order_id."'")->save(array('update_time'=>NOW_TIME,'status'=>1,'agent_cut'=>I('agent_cut'),'pay_type'=>$pay_type));
			//更新支付
			$data = array('order_id'=>$order_id,'payment_type'=>3,'pay_platform'=>2);
			$r2 = $orders_pay->update($data);
			if(!$r1||!$r2){
				$orders->rollback();
				$this->error('系统错误');
			}else{
				$orders->commit();
			}
			$this->redirect('order/my', array('status' => 1));
		}
	}

	//我的订单
	public function my(){
		$status = I('status');
		if($status==4){
			$map['status'] = 4;
		}elseif ($status['status']==1) {
			$map['status'] = array('in','1,2,3,5');
		}
		$map['user_id'] = session('user_auth.uid');
		$orders = D('orders')->where($map)->order('create_time desc')->select();
		if($orders){
			foreach ($orders as $key=>  $value) {
				$map1['order_id'] = $value['order_id'];
				$details = D('orders_detail')->where($map1)->select();
				$orders[$key]['details'] = $details;
				//邮寄地址
				$address = D('shop_address')->field('name,phone,address,area')->find($value['address_id']);
				$orders[$key]['address'] = $address;
			}
		}
		$this->assign('orders',$orders);
		$this->display();
	}
}

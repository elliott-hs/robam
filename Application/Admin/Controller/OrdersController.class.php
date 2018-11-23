<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;
use User\Api\UserApi;
use Think\Controller;

/**
 * 后台用户控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class OrdersController extends AdminController {

    /**
     * 订单管理首页
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function index(){
 		$map = array();
    	/* 查询条件初始化 */
        if(preg_match('#ROBAM#',$_GET['title'])){
            $map['a.order_id'] = I('title');
        }elseif($_GET['title']){
        	$uid = D('member')->where('status=1 and nickname like "%'.I('title').'%"')->find();
            $map['a.user_id'] =  $uid['uid'];
        }
        if(isset($_GET['status'])&&$_GET['status']){
            $map['a.status']  = I('status');
        }
        if ( isset($_GET['time-start']) ) {
            $map['a.update_time'][] = array('egt',strtotime(I('time-start')));
        }
        if ( isset($_GET['time-end']) ) {
            $map['a.update_time'][] = array('elt',24*60*60 + strtotime(I('time-end')));
        }

        //数据封装
    	$list = D('orders')
    	->alias('a')
    	->join('robam_shop_address  as b on a.address_id = b.id')
    	->join('robam_member  as c on a.user_id = c.uid')
    	->where($map)
        ->field('a.*,b.*,c.*,a.status as status,a.create_time as create_time')
    	->order('a.create_time desc')
    	->page(I('p',1).',2')
    	->select();

    	foreach ($list as $key => $value) {
    		//商品
    		$list[$key]['goods'] = D('orders_detail')->where("order_id='".$value['order_id']."'")->select();
    		//收货地址
    	}

    	//分页
    	$count = D('orders')->alias('a')->where($map)->count();// 查询满足要求的总记录数
		$Page  = new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数

	 	foreach($map as $key=>$val) {
	 		$key = ltrim($key,'a.');
    		$Page->parameter[$key]   =   urlencode($val);
		}


		$show  = $Page->show();// 分页显示输出
		$this->assign('_page',$show);// 赋值分页输出
    	$this->assign('list',$list);
    	$this->assign('status', I('status'));
    	$this->meta_title="订单列表";
        $this->display();
    }

    //完成订单
    public function complate_order(){
        if(IS_AJAX){
            $data['status'] = I('status');
            $data['order_id'] = I('order_id');
            $model = D('orders');
            $result = $model->update($data);
            $this->ajaxReturn($result);
        }
    }
}

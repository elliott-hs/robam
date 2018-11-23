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
 * 活动控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class MarketingController extends AdminController {
    /**
     * 前端首页
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function index(){
        if(IS_POST){
         	$p = I();
         	$data['banner'] = json_encode($p['thumb']);
         	$data['start'] = json_encode($p['start']);
         	$data['hot'] = json_encode($p['hot']);
         	$data['id'] = I('id',1);
         	$data['update_time'] = NOW_TIME;
         	$data['status'] = 1;
         	$ros = D('shop_home')->save($data);
         	if ($ros) {
         		$this->success('更新成功');
         	}else{
         		$this->error('更新失败');
         	}
        }else{
        	$data = D('shop_home')->where('status=1')->find();
        	$this->thumb = json_decode($data['banner'],true);
        	$this->start = json_decode($data['start'],true);
        	$this->hot = json_decode($data['hot'],true);
        	$this->display();
        }  
    }

     
    
}

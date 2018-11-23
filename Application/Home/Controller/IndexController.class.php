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
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends Home2Controller {
	//系统首页
    public function index(){

    	$home = M('home','robam_shop_')->where('status=1')->find();
    	if(empty($home)){
    		$this->error('系统内部错误');
    	}
    	$home['banner'] = json_decode($home['banner'],true);

    	$home['hot'] = json_decode($home['hot'],true);
    	$home['start'] = json_decode($home['start'],true);
    	$this->assign('home',$home);
    	$this->display('index');
    }

    public function wechatCall(){
         parent::valid();
    }

}
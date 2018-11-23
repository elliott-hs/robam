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
 * 城市控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class CityController extends AdminController {

    /**
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function index(){
 		$list = D('shop_city')->where('status=1')->select();
        foreach ($list as $key => $value) {
            $list[$key]['sends'] = json_decode($value['sends'],true);
        }
        $this->assign('_list',$list);
        $this->display();
    }



    public function add(){
    	if(IS_POST){
    		if(!I('area')){
    			$this->error('区域不可为空');
    		}
    		$data['city'] = I('city');
    		$data['area'] = I('area');
    		$sends = I('data');
            // if(I('sends')){
            //  $data['sends'] = implode(',',I('sends'));
            // }
            foreach ($sends as $key => $value) {

                if(!$value['start']||!$value['end']||$value['start']>=$value['end']){
                    unset($sends[$key]);
                }
            }
            $data['sends'] = json_encode($sends);
    		$data['update_time'] = NOW_TIME;
    		$ros = M('shop_city')->add($data);
    		if($ros){
    			$this->error('新增成功',U('City/index'));
    		}else{
    			$this->success('新增失败');
    		}
    	}else{
    		$this->assign('title','新增区域');
    		$this->display('edit');
    	}
    }

    public function edit(){
    	if(IS_POST){
    		if(!I('area')){
    			$this->error('区域不可为空');
    		}
    		$data['id'] = I('id');
    		$data['city'] = I('city');
    		$data['area'] = I('area');
            $sends = I('data');
    		// if(I('sends')){
    		// 	$data['sends'] = implode(',',I('sends'));
    		// }
            foreach ($sends as $key => $value) {

                if(!$value['start']||!$value['end']||$value['start']>=$value['end']){
                    unset($sends[$key]);
                }
            }
            $data['sends'] = json_encode($sends);
    		$data['update_time'] = NOW_TIME;
    		$ros = M('shop_city')->save($data);
    		if($ros){
    			$this->success('修改成功',U('City/index'));
    		}else{
    			$this->error('修改失败');
    		}
    	}else{
    		$map['id'] = I('id');
    		$city = M('shop_city')->where($map)->find();
    		$city['sends'] = json_decode($city['sends'],true);
    		$this->assign('city',$city);
    		$this->assign('title','编辑区域');
    		$this->display();
    	}
    }

    public function changeStatus(){
    	if (IS_POST) {
    	 	$ids = I('id');
    	 	$map['id'] = array('in',implode(',', $ids));
    	 	$data['status'] = 0;
    	 	$data['update_time'] = NOW_TIME;
    	 	$ros = M('shop_city')->where($map)->save($data);
    	 	if($ros){
    			$this->error('删除成功',U('City/index'));
    		}else{
    			$this->success('删除失败');
    		}
    	}
    }
}

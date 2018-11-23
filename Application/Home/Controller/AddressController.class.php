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
class AddressController extends HomeController {

   	public  function _initialize(){
   		parent::_initialize();
   		parent::login();
   		$this->user_id = session('user_auth.uid');
   	}


   	public function index(){
   		$map['status'] = 1;
   		$map['user_id'] = $this->user_id;
   		$list = D('shop_address')->where($map)->order('create_time')->select();
   		$this->assign('list',$list);
   		$this->display();
   	}
   	public function edit($id=''){
         if($id){
            $result = D('shop_address')->where('status=1 and id='.$id)->find();
            if(empty($result)){
               $this->error('不存在的数据');
            }
            $this->assign('result',$result);
         }
   		$this->assign('title','编辑地址');
   		$this->display('edit');

   	}
   	public function add(){
   		$this->assign('title','新增地址');
   		$this->display('edit');
   	}

      public function del($id){
         $data = array('status'=>0,'id'=>$id);
         $result = D('shop_address')->update($data);
         if($result){
            $this->redirect('address/index');
         }
      }
   	public function ajax_save(){
   		if(IS_POST){
   			$result = D('shop_address')->update();
   			$this->ajaxReturn($result);
   		}
   	}
      public function ajax_setDefault($id){
         if(IS_POST){
            $model = D('shop_address');
            $model->startTrans();
            $map['user_id'] = $this->user_id;
            $map['status'] = 1;
            $r1 = $model->where($map)->save(array('is_default'=>0));
            $map['id'] = $id;
            $r2 = $model->where($map)->save(array('is_default'=>1));
            $r3 = 1;
            if(session('order_id')){
               $r3 = D('orders')->where("order_id='".session('order_id')."'")->save(array('address_id'=>$id));
            }
            if(!$r1||!$r2||!$r3){
               $model->rollback();
               $result = false;
            }else{
               $model->commit();
               $result = true;
            }
            $this->ajaxReturn($result);
         }
      }
}

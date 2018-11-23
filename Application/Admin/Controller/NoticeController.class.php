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
 * 公告控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class NoticeController extends AdminController {

    /**
     * 公告管理首页
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function index(){
 		$list = M('shop_notice')->where('status=1 and user_id=0')->order('create_time')->select();
 		$this->assign('_list',$list);
        $this->display();
    }



    public function add(){
    	if(IS_POST){
    		if(!I('title')){
    			$this->error('标题不可为空');
    		}
    		if(!I('msg')){
    			$this->error('内容不可为空');
    		}
    		$data['title'] = I('title');
    		$data['msg'] = I('msg');
    		$data['create_time'] = $data['update_time'] = NOW_TIME;
    		$ros = M('shop_notice')->add($data);
    		if($ros){
    			$this->error('新增成功',U('notice/index'));
    		}else{
    			$this->success('新增失败');
    		}
    	}else{
    		$this->assign('title','新增公告');
    		$this->display('edit');
    	}
    }

    public function edit(){
    	if(IS_POST){
    		if(!I('title')){
    			$this->error('标题不可为空');
    		}
    		if(!I('msg')){
    			$this->error('内容不可为空');
    		}
    		if(!I('id')){
    			$this->error('不存在的公告');
    		}
    		$data['id'] = I('id');
    		$data['title'] = I('title');
    		$data['msg'] = I('msg');
    		$data['update_time'] = NOW_TIME;
    		$ros = M('shop_notice')->save($data);
    		if($ros){
    			$this->error('修改成功',U('notice/index'));
    		}else{
    			$this->success('修改失败');
    		}
    	}else{
    		$map['id'] = I('id');
    		$notice = M('shop_notice')->where($map)->find();
    		$this->assign('notice',$notice);
    		$this->assign('title','编辑公告');
    		$this->display();
    	}
    }

    public function changeStatus(){
    	if (IS_POST) {
    	 	$ids = I('id');
    	 	$map['id'] = array('in',implode(',', $ids));
    	 	$data['status'] = 0;
    	 	$data['update_time'] = NOW_TIME;
    	 	$ros = M('shop_notice')->where($map)->save($data);
    	 	if($ros){
    			$this->error('删除成功',U('notice/index'));
    		}else{
    			$this->success('删除失败');
    		}
    	}
    }
}

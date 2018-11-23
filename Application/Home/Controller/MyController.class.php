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
 * 我的中心控制
 */
class MyController extends HomeController {
	
	public  function _initialize(){
		parent::_initialize();
		$this->user_id = session('user_auth.uid');
	} 

	public function index(){

		//系统消息
		$map['status'] = 1;
		$map['user_id'] = $this->user_id;
		$map['is_read'] = 0;
		$notice = D('shop_notice')->where($map)->count();
		//微信信息
		$wechat['headimgurl'] ='http://wx.qlogo.cn/mmopen/ajNVdqHZLLCu9vKnrBiac6gOhPGTUwguxRkdp7N9cQnwCXFT71Od6wOwwnc9yzibjVKiaGKZyZg5Bdazic8LS2GibxQ/0';
		$this->assign('notice',$notice);
		$this->assign('wechat',$wechat);
		$this->assign('user_auth',session('user_auth'));
		$this->display();
	}


	//我的任务
	public function task(){
		parent::login();
		//季度时间
		$seasons = season_section_time();
		foreach ($seasons as $key => $season) {
			$orders = D('orders')->list_season($this->user_id,$season['time']);
 			//echo M('')->_sql();
 			$tmp_reward = 0;
 			$tmp_price_order = 0;
 			foreach ($orders as $order) {
 				$tmp_reward +=$order['reward'];
 				$tmp_price_order +=$order['price_order']; 
 			}
 			$seasons[$key]['reward'] = $tmp_reward;
 			$seasons[$key]['price_order'] = $tmp_price_order;
 			//我的任务
 			$task = D('shop_task')->my($this->user_id,$season['season']);
			if($task['task_money']){
				$seasons[$key]['task'] = $task['task_money'];
				$seasons[$key]['rate'] = ($tmp_price_order/$task['task_money'])*100;
				//保留两位小数
				$seasons[$key]['rate'] = sprintf("%.2f",$seasons[$key]['rate']);

				$seasons[$key]['task_reward'] = '审核中';
			}
		} 
		$this->assign('seasons',$seasons);
		$this->display();
	}

	public function notice(){
		parent::login();
		$map['status'] = 1;
		//$map['user_id'] = $this->user_id;
		$map['user_id'] = 0;
		$notice = D('shop_notice')->where($map)->select();
		$this->assign('notice',$notice);
		$this->display();
	}

	public function ajax_notice_read($id){
		parent::login();
		$data['id'] = $id;
		$data['is_read'] =1;
		$result = D('shop_notice')->update($data);
		$this->ajaxReturn($result);
	}

}
?>
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
class AgentController extends AdminController {

    /**
     * 渠道商首页
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function index(){
        $nickname       =   I('nickname');
        $map['b.status']  =   array('egt',0);
        if(is_numeric($nickname)){
            $map['uid|nickname']=   array(intval($nickname),array('like','%'.$nickname.'%'),'_multi'=>true);
        }else{
            $map['nickname']    =   array('like', '%'.(string)$nickname.'%');
        }
        $map['id']=array('GT',1);
        $map['a.status'] = 2;//渠道商
        $list   = D('ucenter_member')
        ->alias('a')
        ->join('robam_member as b on a.id=b.uid')->where($map)->select();
        int_to_string($list);
        $this->assign('_list', $list);
        $this->meta_title = '用户信息';
        $this->display();
    }

    /**
     * 会员状态修改
     * @author 朱亚杰 <zhuyajie@topthink.net>
     */
    public function changeStatus($method=null){
        $id = array_unique((array)I('id',0));
        if( in_array(C('USER_ADMINISTRATOR'), $id)){
            $this->error("不允许对超级管理员执行该操作!");
        }
        $id = is_array($id) ? implode(',',$id) : $id;
        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }
        $map['uid'] =   array('in',$id);
        switch ( strtolower($method) ){
            case 'forbiduser':
                $this->forbid('Member', $map );
                break;
            case 'resumeuser':
                $this->resume('Member', $map );
                break;
            case 'deleteuser':
                $this->delete('Member', $map );
                break;
            default:
                $this->error('参数非法');
        }
    }

    public function add(){
        if(IS_POST){
            $p = I();
            /* 检测密码 */
            if($p['password'] != $p['repassword']){
                $this->error('密码和重复密码不一致！');
            }
            if(!$p['leader']||!$p['leader_phone']){
                $this->error('负责人,负责人电话必填');
            }
            /* 调用注册接口注册用户 */
            $User   =   new UserApi;
            $uid    =   $User->register($p['username'],$p['password'],$p['email'],$p['mobile'],2);
            if(0 < $uid){ //注册成功
                $user = array('uid' => $uid, 'nickname' => $p['nickname'], 'status' => 1);
                $user['company'] = $p['company'];
                $user['type'] = $p['type'];
                $user['area'] = $p['area'];
                $user['bank_name'] = $p['bank_name'];
                $user['bank_open_name'] = $p['bank_open_name'];
                $user['bank_card'] = $p['bank_card'];
                $user['leader'] = $p['leader'];
                $user['leader_phone'] = $p['leader_phone'];
                if(!M('Member')->add($user)){
                    $this->error('用户添加失败！');
                } else {
                    $this->success('用户添加成功！',U('index'));
                }
            } else { //注册失败，显示错误信息
                $this->error($this->showRegError($uid));
            }
        } else {
            $this->meta_title = '新增用户';
            $this->display();
        }
    }

    public function edit(){
        if(IS_POST){
            $p = I();
            /* 检测密码 */
            if($p['password'] != $p['repassword']){
                $this->error('密码和重复密码不一致！');
            }
             if(!$p['leader']||!$p['leader_phone']){
                $this->error('负责人,负责人电话必填!');
            }
            /* 调用注册接口更新用户 */
            $member =  array('username'=>$p['username'],'email'=>$p['email'],'mobile'=>$p['mobile'],'update_time'=>NOW_TIME);
            if(!empty(I('password'))) $member['password'] = I('password');
            $User   =   new UserApi;
            $uid    =   $User->updateInfo($p['uid'],$p['password'],$member);
            if($uid){ //注册成功
                $user = array('nickname' => $p['nickname'], 'status' => 1);
                $user['company'] = $p['company'];
                $user['type'] = $p['type'];
                $user['area'] = $p['area'];
                $user['bank_name'] = $p['bank_name'];
                $user['bank_open_name'] = $p['bank_open_name'];
                $user['bank_card'] = $p['bank_card'];
                $user['update_time'] = NOW_TIME;
                $user['leader'] = $p['leader'];
                $user['leader_phone'] = $p['leader_phone'];
                if(!M('Member')->where('uid='.$p['uid'])->save($user)){
                    $this->error('用户修改失败！');
                } else {
                    $this->success('用户修改成功！',U('index'));
                }
            } else { //注册失败，显示错误信息
                $this->error($this->showRegError($uid));
            }

        }else{
            $map['id'] = I('uid');
            $user   = D('ucenter_member')
            ->alias('a')
            ->join('robam_member as b on a.id=b.uid')->where($map)->find();
            $this->assign('user', $user);
            $this->display();
        }
    }

    /**
     * 获取用户注册错误信息
     * @param  integer $code 错误编码
     * @return string        错误信息
     */
    private function showRegError($code = 0){
        switch ($code) {
            case -1:  $error = '用户名长度必须在16个字符以内！'; break;
            case -2:  $error = '用户名被禁止注册！'; break;
            case -3:  $error = '用户名被占用！'; break;
            case -4:  $error = '密码长度必须在6-30个字符之间！'; break;
            case -5:  $error = '邮箱格式不正确！'; break;
            case -6:  $error = '邮箱长度必须在1-32个字符之间！'; break;
            case -7:  $error = '邮箱被禁止注册！'; break;
            case -8:  $error = '邮箱被占用！'; break;
            case -9:  $error = '手机格式不正确！'; break;
            case -10: $error = '手机被禁止注册！'; break;
            case -11: $error = '手机号被占用！'; break;
            default:  $error = '未知错误';
        }
        return $error;
    }


   /************ 业务模块BEGIN ************/

    //设置任务
    public function task(){
        if(IS_POST){
            $agent_id = I('agent_id');
            $data = I('data');
            $result  = array();
            $model = D('shop_task');
            $model->startTrans();
            for ($i=1; $i <=5 ; $i++) {
                $tmp = array();
                $count_reward = count($data['reward'.$i]);
                $count_task = count($data['task'.$i]);
                if($count_reward <> $count_task){
                    $this->error('数据异常');
                    break;
                }
                for ($j=0; $j < $count_task ; $j++) {
                    $tmp[$data['task'.$i][$j]] = $data['reward'.$i][$j];
                }
                $map['year'] = date("Y");
                $map['season'] = $i;
                $map['user_id'] = $agent_id;
                $map['status'] = 1;
                $data2 = $map;
                $data2['task'] = json_encode($tmp);
                $data2['update_time'] = NOW_TIME;
                if($id = $model->where($map)->find()){
                    $ros = $model->where('id='.$id['id'])->save($data2);
                }else{
                    $data['create_time'] = NOW_TIME;
                    $ros = $model->add($data2);
                }
                if(!$ros){
                    $model->rollback();
                    $this->error('设置失败');
                    break;
                }
            }
            $model->commit();
            $this->success('设置成功！');
        }else{
            $map['year'] = date("Y");
            $map['user_id'] = I('agent_id');
            $map['status'] = 1;
            $list  = D('shop_task')->field('season,task')->where($map)->order('season')->select();
            foreach ($list as $key => $value) {
                $data = json_decode($value['task'],true);
                foreach ($data as $k => $v) {
                    $result[$value['season']]['task'][] = $k;
                    $result[$value['season']]['reward'][] = $v;
                }
            }
            $this->assign('task',$result);
            $this->display();
        }
    }

    public function categoryRate(){
        if(IS_POST){
            $categoryRate = I('category');
            $model = D('shop_category');
            $model->startTrans();
            foreach ($categoryRate as $key => $value) {
                if($value>100){
                    $this->error('比例超过100,要亏死了');
                }
                $data = array('update_time'=>NOW_TIME,'reward_rate'=>$value);
                $ros = $model->where('id='.$key)->save($data);
                if(!$ros){
                    $model->rollback();
                    break;
                    $this->error('修改失败');
                }
            }
            $model->commit();
            $this->success('修改成功');
        }else{
            $list = D('shop_category')->where('status=1')->select();
            $this->assign('list',$list);
            $this->display();
        }

    }

    //任务明细
    public function taskDetail($uid){
        $result = array();
        //季度时间
        $seasons = seasonDB();
        foreach ($seasons as $key => $season) {

            //我的任务
            $tmp_task  = D("shop_task")->info($uid,$key);
            $task = json_decode($tmp_task['task'],true);
            $result[$key]['task'] = format_task_array($task);

            //我的销售
            $map = array();
            $map['user_id'] = $uid;
            $map['status'] = 3;
            if($key!=5){
                $time = season_section_time($key);
                $map['create_time'] = array('between',$time[0]['time']);
            }
            $result[$key]['orders'] = $price_order = D('orders')->where($map)->sum('price_order');
            //我的返利
            $result[$key]['rebate'] = D('orders')->where($map)->sum('reward_money');
            //达成率
            $reward = format_reward($task,$price_order);

            $result[$key]['reach_rate'] = $reward['reach_rate'];
            //我的奖励
            $result[$key]['reward'] = $reward['reward'];

        }
        return $result;
    }

}

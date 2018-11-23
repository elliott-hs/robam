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
class GoodsController extends AdminController {

    /**
     * 商品管理首页
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function index(){
    	$p = $_GET['p']?$_GET['p']:1;
    	$search = I('srh_goods_name');
        $status = I('status');
    	if($search){
    		$map['goods_name'] = array("LIKE","%$search%");
    	}
    	$goods_type = I('srh_goods_type');
    	if($goods_type>0){
    		$map['category_id'] = $goods_type;
    	}
        $map['status'] = $status;
    	$count      = D('shop_goods')->where($map)->count();// 查询满足要求的总记录数
    	$list = D('shop_goods')->where($map)->page($p.',10')->order('create_time desc,category_id')->select();

    	//分页显示
    	$Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		//分类
		$types = D('shop_category')->where('status=1')->select();


    	$this->assign('_page',$show);// 赋值分页输出
    	$this->assign('list',$list);
    	$this->assign('types',$types);
        $this->meta_title = '商品列表';
        Cookie('__forward__',$_SERVER['REQUEST_URI']);
        $this->display();
    }


    public function deleteRecord(){
    	if(IS_AJAX){
    		$data = array('status'=>0,'update_time'=>NOW_TIME);
    		$result = D('shop_goods')->where("goods_id=".I('id'))->save($data);
    		echo M()->_sql();;
    			print_r($result);
    	}
    }

    public function edit(){
    	if(IS_POST){
    		$data = I();
    		$data['fuel'] = implode(',', $data['fuel']);
            //活动价格设置
            if($data['game_start']||$data['game_end']||$data['price_game']){
                if(!$data['game_start']||!$data['game_end']||!$data['price_game']){
                    $this->error('请设置完成的活动价格和时间');
                }

                if($data['game_start']>=$data['game_end']){
                    $this->error('活动时间错误');
                }
                $data['game_start'] = strtotime($data['game_start']);
                $data['game_end'] = strtotime($data['game_end']);
            }

    		//实例模型
    		$model = D('shop_goods');
    		$result = $model->update($data);

    		if($result){
    			$this->success('操作成功',Cookie('__forward__'));
    		}else{
    			$this->error($model->getError());
    		}
    	}else{
    		$goods_id = I('goods_id');
    		$data = D('shop_goods')->where('goods_id='.$goods_id)->find();
            $data['game_start'] = $data['game_start']? date("Y-m-d H:i",$data['game_start']):'';
            $data['game_end'] = $data['game_end']?date("Y-m-d H:i",$data['game_end']):'';
            $data['price_game'] = $data['price_game']?$data['price_game']:'';
            if($data['game_start']&&$data['game_end']&&$data['price_game']){
                $data['game'] = 1;
            }
            $this->assign('data',$data);
    		$this->display();
    	}
    }

    public function index_price(){
        $p = $_GET['p']?$_GET['p']:1;
        $search = I('srh_goods_name');
        $status = I('status');
        if($search){
            $map['goods_name'] = array("LIKE","%$search%");
        }
        $goods_type = I('srh_goods_type');
        if($goods_type>0){
            $map['category_id'] = $goods_type;
        }
        $map['status'] = $status;
        $count      = D('shop_goods')->where($map)->count();// 查询满足要求的总记录数
        $list = D('shop_goods')->where($map)->page($p.',10')->order('create_time desc,category_id')->select();

        //分页显示
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        //分类
        $types = D('shop_category')->where('status=1')->select();


        $this->assign('_page',$show);// 赋值分页输出
        $this->assign('list',$list);
        $this->assign('types',$types);
        $this->meta_title = '商品列表';
        Cookie('__forward__',$_SERVER['REQUEST_URI']);
        $this->display();
    }

      public function edit_price(){
        if(IS_POST){
            $data = I();
            $data['fuel'] = implode(',', $data['fuel']);
            //活动价格设置
            if($data['game_start']||$data['game_end']||$data['price_game']){
                if(!$data['game_start']||!$data['game_end']||!$data['price_game']){
                    $this->error('请设置完成的活动价格和时间');
                }

                if($data['game_start']>=$data['game_end']){
                    $this->error('活动时间错误');
                }
                $data['game_start'] = strtotime($data['game_start']);
                $data['game_end'] = strtotime($data['game_end']);
            }

            //实例模型
            $model = D('shop_goods');
            $result = $model->save($data);

            if($result){
                $this->success('操作成功',$this->success('操作成功',Cookie('__forward__')));
            }else{
                $this->error($model->getError());
            }
        }else{
            $goods_id = I('goods_id');
            $data = D('shop_goods')->where('goods_id='.$goods_id)->find();
            $data['game_start'] = $data['game_start']? date("Y-m-d H:i",$data['game_start']):'';
            $data['game_end'] = $data['game_end']?date("Y-m-d H:i",$data['game_end']):'';
            $data['price_game'] = $data['price_game']?$data['price_game']:'';
            if($data['game_start']&&$data['game_end']&&$data['price_game']){
                $data['game'] = 1;
            }
            if(!$data['reward_rate']){
                $s = D('shop_category')->find($data['category_id']);
                $data['reward_rate'] = $s['reward_rate'];
            }
            $this->assign('data',$data);
            $this->display();
        }
    }

}

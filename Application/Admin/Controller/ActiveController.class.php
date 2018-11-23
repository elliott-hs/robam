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
class ActiveController extends AdminController {

    /**
     * 单品活动
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function item(){
        $map['type']  = array('in',array(1,2));
        $map['status'] = 1;
 		$list = M('shop_active')->where($map)->order('create_time')->select();
        $this->assign('title','单品活动列表');
        $this->assign('_list',$list);
        $this->display('itemList');
    }

    /**
     * 订单活动
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function orders(){
        $map['type']  = array('in',array(4));
        $map['status'] = 1;
        $list = M('shop_active')->where($map)->order('create_time')->select();
        $this->assign('title','订单活动列表');
        $this->assign('_list',$list);
        $this->display('ordersList');
    }


    public function promotion(){
        echo "促销活动价格后期迭代";
    }

    public function editItem(){
        if(I('id')){
            $active = D('shop_active')->find(I('id'));
            $active_item = D('shop_active_goods')->where('active_id='.I('id'))->field('item_id')->select();
        }
        if($active_item){
            foreach ($active_item as $key => $value) {
               $active_item[$key] = $value['item_id'];
            }
        }
        $result = $this->selectItems();
        $this->assign('_item',$result);
        $this->assign('active',$active);
        $this->assign('checked',$active_item);
        $this->display();
    }

    public function editOrders(){
        $this->display();
    }
    


    public function update(){
        $data = I();
        $items = $data['item'];
        unset($data['item']);
        if($data['type']==4){
            $data['price_active'] = $data['price_active'][0].":".$data['price_active'][1];
        }
        $model = D('shop_active');
        $model2 = M('shop_active_goods');
        $model->startTrans();
        $active_id = $model->update($data);
        if(!$active_id){
            $model->rollback();
            $this->error($model->getError());
        }
        //活动商品封装
        if(!empty($items)){
            $model2->where('active_id='.$active_id)->delete();
            foreach ($items as  $value) {
                $dataList[] = array('active_id'=>$active_id,'item_id'=>$value,'status'=>1,'create_time'=>NOW_TIME,'update_time'=>NOW_TIME);
            }
            
            $ros = $model2->addAll($dataList);
            if($ros){
                $model->commit();
                $this->success('操作成功',U('active/item'));
            }else{
                $model->rollback();
                $this->error('操作失败');
            }
        }else{
            $model->commit();
            $this->success('操作成功',U('active/item'));
        }
       
    }

    public function edit(){
    	if(IS_POST){
    		$data = I();
    		$items = $data['items'];
    		unset($data['items']);
    		$model = D('shop_active');
    		$model->startTrans();

    		$id = $model->update($data);
    		if(!$id){
    			$model->rollback();
    			$this->error($model->getError());
    		}

    		$model2 = M('shop_active_goods');
    		$model2->where('active_id='.$data['id'])->delete();
    	 
    		if(!empty($items)){
    			foreach ($items as  $value) {
    				$dataList[] = array('active_id'=>$data['id'],'item_id'=>$value,'status'=>1,'create_time'=>NOW_TIME,'update_time'=>NOW_TIME);
    			}
    		
    			$ros = $model2->addAll($dataList);
    			if($ros){
    				$model->commit();
    				$this->success('操作成功',U('active/price'));
    			}else{
    				$model->rollback();
    				$this->error('操作失败');
    			}
    		}else{
    			$model->commit();
    			$this->success('操作成功',U('active/price'));
    		}
    	}else{
    		$map['id']  = $active_id = I('id');
    		$active = M('shop_active')->where($map)->find();
    		$this->assign('active',$active);
    		//已经选择商品
    		$items_selected = $this->items_selected($active_id);
    		$this->assign('items_selected',$items_selected);
    		$this->assign('title','编辑批量价格');
    		$this->display();
    	}
    }

    public function changeStatus(){
    	if(IS_POST) {
    	 	$ids = I('id');
    	 	$map['id'] = array('in',implode(',', $ids));
    	 	$data['status'] = 0;
    	 	$data['update_time'] = NOW_TIME;
    	 	$ros = D('shop_active')->where($map)->save($data);
    	 	if($ros){
    			$this->error('删除成功',U('Active/price'));
    		}else{
    			$this->success('删除失败');
    		}
    	}
    }

    private function selectItems(){
        $map['status'] = 2;
        $items = M('shop_goods')->where($map)->field('category_id,goods_id,goods_name')->select();
        $result = array();
        if(!empty($items)){
            foreach ($items as $key => $value) {
                $category_id = $value['category_id'];
                $result[$category_id][] = $value;
            }
        }
        return $result;
    }




    public function  items_selected($active_id='',$category_id=''){
    		//活动id
    	    if($active_id){
    	    	$items  = M('shop_active_goods')->where('active_id='.$active_id.' and status=1')->field('item_id')->select();
    	    	if(!empty($items)){
    	    		foreach ($items as $key => $value) {
    	    			$items[$key] = $value['item_id'];
    	    		}
    	    	}
    	    }
    		$map['status'] = 2;
    		if($category_id){
    			$map['category_id'] = $category_id;
    		}
    		$list = M('shop_goods')->where($map)->field('goods_id,goods_name')->select();
     
    		$result = '';
    		if(!empty($list)){
    			foreach ($list as $key => $value) {
    				$result .= '<label class="checkbox"><input type="checkbox" value="'.$value['goods_id'].'" name="items[]"';
    				if(in_array($value['goods_id'],$items)){
    					$result .="checked ";
    				}
    				$result .='>'.$value['goods_name'].'</label>';
    			}
    		}
    		if(IS_POST){
    			$this->success($result);
    		}else{
    			return ($result);
    		}	
    }
}

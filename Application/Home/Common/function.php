<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

/**
 * 前台公共库文件
 * 主要定义前台公共函数库
 */

/**
 * 检测验证码
 * @param  integer $id 验证码ID
 * @return boolean     检测结果
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function check_verify($code, $id = 1){
	$verify = new \Think\Verify();
	return $verify->check($code, $id);
}

/**
 * 获取列表总行数
 * @param  string  $category 分类ID
 * @param  integer $status   数据状态
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function get_list_count($category, $status = 1){
    static $count;
    if(!isset($count[$category])){
        $count[$category] = D('Document')->listCount($category, $status);
    }
    return $count[$category];
}

/**
 * 获取段落总数
 * @param  string $id 文档ID
 * @return integer    段落总数
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function get_part_count($id){
    static $count;
    if(!isset($count[$id])){
        $count[$id] = D('Document')->partCount($id);
    }
    return $count[$id];
}

/**
 * 获取导航URL
 * @param  string $url 导航URL
 * @return string      解析或的url
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function get_nav_url($url){
    switch ($url) {
        case 'http://' === substr($url, 0, 7):
        case '#' === substr($url, 0, 1):
            break;
        default:
            $url = U($url);
            break;
    }
    return $url;
}

function order_status($status){
    switch ($status) {
        case '1':
            return '未支付';
            break;
        case '2':
            return '已付款';
            break;
        case '3':
            return '已发货';
            break;
        case '4':
            return '已完成';
            break;
        case '5':
            return '已退货';
            break;
        case '6':
            return '已结算';
            break;
        default:
            return '未知';
            break;
    }
}

function pay_status($status){
      switch ($status) {
        case '0':
            return '货到付款';
            break;
        case '1':
            return '微信支付';
            break;
        case '2':
            return '支付宝支付';
            break;
        case '3':
            return '网银支付';
            break;
        default:
            return '未知';
            break;
    }
}


function format_date($time){
    return date("Y-m-d H:i:s",$time);
}

function thumb_link($link){

    if(!preg_match("#http://(.*)#",$link)&&!preg_match("#https://(.*)#",$link)){
        $link = U('goods/item',array('id'=>$link));
    }
    return $link;
}


function price_active($goods_id){
    $data = array('price'=>0,'active'=>1);
    if($goods_id){
        //1.本身销售价格
        $item = M('shop_goods')->field('price_market,price_sales,price_game,game_start,game_end')->find($goods_id);
        $price_market = $item['price_market'];//市场价格
        $price_sale = $item['price_sale'];//销售价格
        //2.促销价格
        $map['item_id'] = $goods_id;
        $map['game_end'] = array('gt',NOW_TIME);
        $map['game_start'] = array('lt',NOW_TIME);
        $active = M('shop_active')->alias('a')->join('robam_shop_active_goods b on a.id=b.active_id')->where($map)->order('a.id desc')->find();
        if($active){//促销价格
            if($active['type']==1){
                $data['price'] = $active['price_active'];
            }elseif($active['type']==2){
                $data['price'] = floatval($price_sale*$active['price_active']/100);
            }
        }else{
            if($item['game_start']<NOW_TIME&&$item['game_end']>NOW_TIME){
                $data['price'] = $item['price_game'];
            }else{
                $data['price'] = $item['price_sales'];
                $data['active'] = 0;
            }
        }
        return $data;
    }
}
?>
<?php
namespace Home\Controller;
use Think\Controller;
/**
 * @abstract  微信支付
 * @param datatype paramname
 * @author forcent
 */

class PayNotifyController extends Controller {

    //回调函数
    function notify() {
        file_put_contents('b_'.date("H-i-s"), date("H-i-s"));
        Vendor("wxpay.lib.WxPayNotify");
        $notify = new \WxPayNotify();
        $wxDATA = $notify->Handle(false); //微信支付数组

        $payments_id = $wxDATA['out_trade_no'];
       //查询订单ID
        if ($wxDATA['return_code'] == 'SUCCESS') {
            $wxDATA['post_time'] = date('Y-m-d H:i:s');
            $payLogPath = "./paylogs/" . date('Ymd') . '/';
            $pathBool = \Common\Helper\CommonHelper::createDir($payLogPath);
            if ($pathBool) {
                file_put_contents($payLogPath .'quick_order_'. $wxDATA['transaction_id'] . ".txt", var_export($wxDATA, true), FILE_APPEND);
            }

            if($state){
                $payArr = array(
                    'pay_platform' => "微信:" . $wxDATA['bank_type'],
                    'trade_no' => $wxDATA['transaction_id'],
                    'trade_status' => $wxDATA['result_code'],
                    'pay_time' => strtotime($wxDATA['time_end']),
                    'total_fee' => $wxDATA['total_fee'] / 100,
                );
                $model->updateOrdersPay($payments_id, $payArr);//更新支付信息
            }
        }
    }

    public function notify2(){
        if(1){
            $order_id = I('order_id');
            $orders = D('orders');
            $orders_pay = D('orders_pay');
            $orders->startTrans();
            //更新订单
            $r1 = $orders->where("order_id='".$order_id."'")->save(array('update_time'=>NOW_TIME,'status'=>2,'pay_type'=>2));
            //更新支付
            $data = array('order_id'=>$order_id,'payment_type'=>3,'pay_platform'=>1);
            //echo M()->_sql();
            $r2 = $orders_pay->update($data);
           // echo M()->_sql();
            if(!$r1||!$r2){
                $orders->rollback();
                $this->error('系统错误');
            }else{
                $orders->commit();
                $this->ajaxReturn(1);
            }
        }
    }

}

?>
<?php
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);
/**
 * 
 * 回调基础类
 * @author widyhu
 *
 */
 
require_once "WxPayApi.php";


class WxPayNotify extends WxPayNotifyReply {

    /**
     * 
     * 回调入口
     * @param bool $needSign  是否需要签名输出
     */
    final public function Handle($needSign = true) {
        $msg = "OK";
        //当返回false的时候，表示notify中调用NotifyCallBack回调失败获取签名校验失败，此时直接回复失败
        $result = WxpayApi::notify(array($this, 'NotifyCallBack'), $msg);
        if ($result == false) {
			//file_put_contents("./11.txt", var_export($result, true),FILE_APPEND);
            $this->SetReturn_code("FAIL");
            $this->SetReturn_msg($msg);
			$this->ReplyNotify(false);
            return;
        } else {
			//file_put_contents("./22.txt", var_export($result, true),FILE_APPEND);
            //该分支在成功回调到NotifyCallBack方法，处理完成之后流程
            $this->SetReturn_code("SUCCESS");
            $this->SetReturn_msg("OK");
			$this->ReplyNotify($needSign);
            return $this->xml_data();
        }
        
    }

    //微信xml
    private function xml_data() {
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        //如果返回成功则验证签名
        try {
            $result = WxPayResults::Init($xml);
			//file_put_contents("./33.txt", var_export($result, true),FILE_APPEND);
        } catch (WxPayException $e) {
            $msg = $e->errorMessage();
			//file_put_contents("./44.txt", var_export($msg, true),FILE_APPEND);
            return false;
        }
		
        return $result;
    }



    /**
     * 
     * notify回调方法，该方法中需要赋值需要输出的参数,不可重写
     * @param array $data
     * @return true回调出来完成不需要继续回调，false回调处理未完成需要继续回调
     */
    final public function NotifyCallBack($data) {

        if ($data['result_code'] == 'SUCCESS') {
            $this->SetReturn_code("SUCCESS");
            $this->SetReturn_msg("OK");
        } else {
            $this->SetReturn_code("FAIL");
            $this->SetReturn_msg("ERROR");
        }
	
        return true;
    }

    /**
     * 
     * 回复通知
     * @param bool $needSign 是否需要签名输出
     */
    final private function ReplyNotify($needSign = true) {
        //如果需要签名
        if ($needSign == true &&
                $this->GetReturn_code($return_code) == "SUCCESS") {
            $this->SetSign();
        }
		//file_put_contents("./55.txt", var_export($this->ToXml(), true),FILE_APPEND);
        WxpayApi::replyNotify($this->ToXml());
    }

}

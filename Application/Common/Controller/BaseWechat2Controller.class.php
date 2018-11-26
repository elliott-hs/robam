<?php

namespace Common\Controller;

use Think\Controller;

/**
 * 公共模块入口
 * @author yong.sun
 */
class BaseWechat2Controller extends Controller {

    //微信接入
    public function valid(){
        $wechat = new \Common\Model\WechatModel();
        $echoStr = $_GET["echostr"];
        //valid signature , option
        if($wechat->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    public function _initialize() {
        // $v = $this->isWeixinBrowser();
        // if (!$v) {
        //     exit('open in wechat');
        // }
        // $this->openid = session('wechatUser.openid');
        $this->openid = 'o7tZVwnz_iwkEcAkejfW-p3oQUf8';
        if (empty($this->openid)) {
            $wechat = new \Common\Model\WechatModel();
            $wechat->getOpenId();
            if(!session('wechatUser.openid')){
                exit('重新打开连接');
            }
        }

    }

    //判断是否是在微信浏览器里---微信5.0之后引入微信支付
    //与老项目不冲突
    function isWeixinBrowser() {
        $agent = $_SERVER['HTTP_USER_AGENT'];
        if (!strpos($agent, "icroMessenger")) {
            return false;
        } else {
            $version = substr($agent, strpos($agent, 'icroMessenger') + 14, 5);
            return $version;
        }
    }

    /**
     * //更新Session里的用户信息
     * @param type $user_id
     */
    public function renewUserSession($user_id) {
        $user = session('user');
        $data = M('User')->where(array('user_id' => $user_id))->find();
        $user['subscribe'] = $data['subscribe'];
        session('user', $user);
    }

}

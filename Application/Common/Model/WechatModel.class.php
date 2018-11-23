<?php
namespace Common\Model;
/**
 * 微信公用模型
 * @author yong.sun
 */
class WechatModel {

	private $appId;
	private $appSecret;
	private $access_token_name = 'cache_access';
	private $jsapi_ticket_name = 'cache_jsapi';

	public function __construct($appId = '', $appSecret = '') {
		$this->appId = !empty($appId) ? $appId : C('weixin.appId');
		$this->appSecret = !empty($appSecret) ? $appSecret : C('weixin.appSecret');
		if (!$this->appId || !$this->appSecret) {
			return false;
		}
	}

	/**
	 * 获取用户列表
	 * @param type $next_openid   第一个拉取的OPENID，不填默认从头开始拉取
	 * @return  array()
	 */
	public function getUserList($current=false) {
		$result = array();
		do {
			$url = C('URL_WECHAT.USE_GET') . '?access_token=' . $this->getAccessToken($current) . '&next_openid=' . $next_openid ;
			$data = json_decode($this->curl($url), true);
			$next_openid = $data['next_openid'];
			$result =  array_merge($result,$data['data']['openid']);
		} while ($data['count']==10000);
		$data['data']['openid'] = $result;
		return $data;
	}

	/**
	 * 获取用户openid(用户入口，用户信息处理)
	 * @param type $scope   授权类型，snsapi_base(静默), snsapi_userinfo(弹框)
	 * @return  array()
	 */
	public function getOpenId($scope = 'snsapi_userinfo', $redirect = '') {
		//通过code获得openid
		if (!isset($_GET['getOpenId'])) {
			//触发微信返回code码
			$baseUrl = $this->__callback() . 'getOpenId=1';
		    $url = $this->__CreateOauthUrlForCode($baseUrl, $scope);
		    Header("Location: $url");
			exit();
		} elseif ($_GET['code']) {
			//获取code码，以获取openid
			$code = $_GET['code'];
	        $url = $this->__CreateOauthUrlForOpenid($code);
			$user_access_token = json_decode($this->curl($url));
			if ($user_access_token->openid) {  //网页授权获取信息失败
				//E($user_access_token->errcode);
				$wx_user = $this->getWechaUserByAuth($user_access_token->openid,$user_access_token->access_token);
			}
			session('wechatUser', $wx_user); //网页授权接口调用凭证
		}
	}


	/**
	 *
	 * 构造获取code的url连接
	 * @param string $redirectUrl 微信服务器回跳的url，需要url编码
	 *
	 * @return 返回构造好的url
	 */
	private function __CreateOauthUrlForCode($redirectUrl, $score = 'snsapi_base') {
		$urlObj["appid"] = $this->appId;
		$urlObj["redirect_uri"] = "$redirectUrl";
		$urlObj["response_type"] = "code";
		$urlObj["scope"] = "$score";
		$urlObj["state"] = "imaker" . "#wechat_redirect";
		return C('URL_WECHAT.AUTHORIZE') . '?' . http_build_query($urlObj);
	}

	/**
	 *
	 * 构造获取openid和access_toke的url地址
	 * @param string $code，微信跳转带回的code
	 *
	 * @return 请求的url
	 */
	private function __CreateOauthUrlForOpenid($code) {
		$urlObj["appid"] = $this->appId;
		$urlObj["secret"] = $this->appSecret;
		$urlObj["code"] = $code;
		$urlObj["grant_type"] = "authorization_code";
		return C('URL_WECHAT.USER_ACCESS_TOKEN') . '?' . http_build_query($urlObj);
	}

	/**
	 *  拉取微信用户基本信息—公共
	 * @param type $openid  微信openid
	 * @return  array()
	 */
	public function getWechaUser($openid) {
		$data = false;
		if ($openid) {
			echo $url = C('URL_WECHAT.USER_INFO') . '?access_token=' . $this->getAccessToken() . '&openid=' . $openid . '&lang=zh_CN';
			$data = json_decode($this->curl($url), true);
		}
		return $data;
	}

	/**
	 * 拉取微信用户基本信息—用户网页授权
	 * @param string  $openid   微信openid
	 * @param string $auth_access_token   授权access_token
	 * @return  array()
	 */
	public function getWechaUserByAuth($openid, $auth_access_token) {
		$data = false;
		if (!empty($openid) && !empty($auth_access_token)) {
			$url = C('URL_WECHAT.JS_USER_INFO') . '?access_token=' . $auth_access_token . '&openid=' . $openid . '&lang=zh_CN';
			$data = json_decode($this->curl($url), true);
		}
		return $data;
	}

	public function getSignPackage() {
		$jsapiTicket = $this->getJsApiTicket();

		// 注意 URL 一定要动态获取，不能 hardcode.
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		$timestamp = time();
		$nonceStr = $this->createNonceStr();

		// 这里参数的顺序要按照 key 值 ASCII 码升序排序
		$string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

		$signature = sha1($string);

		return array(
			"appId" => $this->appId,
			"nonceStr" => $nonceStr,
			"timestamp" => $timestamp,
			"url" => $url,
			"signature" => $signature,
			"rawString" => $string
		);
	}

	public function getJsApiTicket() {
		// jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
		$data = S($this->jsapi_ticket_name);
		if (!$data) {
			$accessToken = $this->getAccessToken();
			// 如果是企业号用以下 URL 获取 ticket
			// $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
			$url = C('URL_WECHAT.JSAPI_TICKET') . "?type=jsapi&access_token=$accessToken";
			$res = json_decode($this->curl($url));
			$ticket = $res->ticket;
			if ($ticket) {
				S($this->jsapi_ticket_name, $ticket, 6000);
			}
		} else {
			$ticket = $data;
		}
		return $ticket;
	}

	/**
	 *  获取AccessToken
	 * @param  boolean  是否重新获取AccessToken
	 * @return   string
	 */
	public function getAccessToken($current = false) {
		if (!$current) {
			$data = S($this->access_token_name);
		}
		if ($current || !$data) {
			//如果是企业号用以下URL获取access_token
			//$url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
			$url = C('URL_WECHAT.ACCESS_TOKEN') . '?grant_type=client_credential&appid=' . $this->appId . '&secret=' . $this->appSecret;
			$res = json_decode(self::curl($url));
			$access_token = $res->access_token;
			if ($access_token) {
				S($this->access_token_name, $access_token, 6000);
			}
		} else {
			$access_token = $data;
		}
		return $access_token;
	}

	/**
	 *  创建二维码ticket
	 * @param  string    $scene    场景值    临时只能为字符串，永久可为数字或字符串
	 * @param  string    $seconds  该二维码有效时间，以秒为单位。 最大不超过604800（即7天）。
	 * @return   array
	 */
	public function getQrcodeTicket($scene, $seconds = 0) {
		if ($seconds > 0 && !empty($seconds)) {//临时性二维码
			$data['expire_seconds'] = $seconds;
			$data['action_name'] = 'QR_SCENE';
                        $data['action_info'] = array('scene' => array('scene_id' => $scene));
		} else {//永久性二维码
			$data['action_name'] = 'QR_LIMIT_STR_SCENE';
                        $data['action_info'] = array('scene' => array('scene_str' => $scene));
		}
		$url = C('URL_WECHAT.QRCODE') . '?access_token=' . $this->getAccessToken();
		$res = $this->curl($url, json_encode($data));
		return json_decode($res, true);
	}

	/**
	 *  获取二维码图片
	 * @param  string    $ticket    获取的二维码ticket，凭借此ticket可以在有效时间内换取二维码。
	 * @return   string
	 */
	public function getQrcode($ticket) {
		$url = C('URL_WECHAT.SHOWQRCODE') . '?ticket=' . $ticket;
		return $this->curl($url);
	}

	/**
	 *  发送红包
	 * @param  string    $ticket    获取的二维码ticket，凭借此ticket可以在有效时间内换取二维码。
	 * @return   string
	 */
	public function sendMondy($openid, $money, $wishing = 'red', $act_name = 'red') {
		Vendor("wxpay.lib.JsApiPay");
		$api = new \WxPayApi();
		//数据封装
		$data['mch_billno'] = '12360' . date('ymd') . $this->str_rand(); // 订单号
		$data['mch_id'] = C('weixin.mchid'); //商户号
		$data['wxappid'] = C('weixin.appId'); //公众号id
		$data['send_name'] = $act_name; //发送者名称
		$data['re_openid'] = $openid; // 用户openid
		$data['total_amount'] = $money; //发送金额 单位:分
		$data['total_num'] = 1; // 发送红包总人数
		$data['wishing'] = $wishing; //红包祝福
		$data['client_ip'] = get_client_ip(); //'43.254.54.113' ;// 调用接口的机器Ip地址
		$data['act_name'] = $act_name; //活动名称
		$data['remark'] = '备注'; //备注信息
		$data['nonce_str'] = $this->createNonceStr(); //随机字符串
		$data['sign'] = $this->getSign($data); //签名
		ksort($data);
		$post = $this->data_to_xml($data);
		return $api->postXmlCurl($post, C('URL_WECHAT.RED_MONEY'), true, 30);
	}

	/**
	 *  下载多媒体文件
	 * @param  string    $media_id     微信媒体id
	 * @return   data      字符流
	 */
	public function getMedia($media_id) {
		$data = false;
		if (!empty($media_id)) {
			$url = C('URL_WECHAT.MEDIA_GET') . '?access_token=' . $this->getAccessToken() . '&media_id=' . $media_id;
			$data = file_get_contents($url);
		}
		return $data;
	}

	private function data_to_xml($data, $item = 'item', $id = 'id') {
		$xml = '<xml>';
		$attr = '';
		foreach ($data as $key => $val) {
			if (is_numeric($key)) {
				$id && $attr = " {$id}=\"{$key}\"";
				$key = $item;
			}
			$xml .= "<{$key}{$attr}>";
			$xml .= (is_array($val) || is_object($val)) ? data_to_xml($val, $item, $id) : '<![CDATA[' . $val . ']]>';
			$xml .= "</{$key}>";
		}
		$xml .="</xml>";
		return $xml;
	}

	private function getSign($data) {
		ksort($data);
		$stringA = '';
		foreach ($data as $key => $value) {
			$stringA .= $key . '=' . $value . "&";
		}
		$strB = trim($stringA, '&') . '&key=' . C('weixin.key');
		return strtoupper(md5($strB));
	}

	private function str_rand() {
		$arr = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
		shuffle($arr);
		$str_num = '';
		foreach ($arr as $v) {
			$str_num .= $v;
		}
		return $str_num;
	}

	private function createNonceStr($length = 16) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for ($i = 0; $i < $length; $i++) {
			$str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $str;
	}

	private function __callback() {
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$callback = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		if (strpos($callback, "&") !== false || strpos($callback, "?") !== false) {
			$callback .= '&';
		} else {
			$callback .='?';
		}
		$str = strchr($callback, 'getOpenId=1', true);
		if ($str){
			$callback = $str;
			$callback = rtrim($callback,"&"); // add by songsang
			$callback = rtrim($callback,"?"); // add by songsang
		}
		return $callback;
	}

	/**
	 *  CURL模拟请求 (后期扩展),抛弃异常处理
	 * @param  string   微信请求地址
	 * @return   data
	 */
	public function curl($url, $post=array()) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_TIMEOUT, 500);
		// 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
		// 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_URL, $url);
		if ($post) {
			//post提交方式
			curl_setopt($curl, CURLOPT_POST, TRUE);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
		}
		$res = curl_exec($curl);
		return $res;
	}
	public function checkSignature(){
        // you must define TOKEN by yourself

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

		$token = C('weixin.token');
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );

		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}

}

?>
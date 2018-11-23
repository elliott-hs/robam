<?php
return array(
	'weixin' => array(
		'token'  =>  'omJNpZEhZeHj1ZxFECKkP48B5VFbk1HP', //填写你设定的key
		'appId'  =>  'wx61e4822551b8d12c', //填写高级调用功能的app id,
		'appSecret'   =>  'a66d6bd4015b0cf25659f57d811ee6ce', //密钥
		'mchid' =>'1445096902',//商户号
		'key'=>'c634d30fc5d81ab01c81d22330f8c4bf'
	),
	//模板信息id
	'tempMsg' => array(
		'fightFailure' => 'OPuSNssIqJjKXyHCoLPFg6oeICDGz3ld-SSbAG-PpKg', //拼团退款提醒
		'collotionSand' => 'OqUYFcsFZnqmydCBSzkKs54zJijXhTWUHzrsyeFpGWg', //开团提醒
		'orderSand' => '_2suw3EIGvsfFRRtMcxGV7ZWbMa-i_az6A-jPawgfyM', //订单发货通知
		'paySuccess' => 'c6_980JVatVjoDOw_3Xfqjd9GNfhgykDqNiyaFk2giw', //商品支付成功通知
		'fightSuccess' => 'vtUYZoG733PtVigi65JudgdNObLJt_3CHK7hb1uNwSQ', //拼团成功通知
        'orderComplete' => 'P0JlJRrnSfs5t7mbu8WfUhbn_ns65qGDV-RrRL-sqKc',//订单完成通知
	),
	'URL_WECHAT' => array(
		'USER_INFO' => 'https://api.weixin.qq.com/cgi-bin/user/info', //请求获得用户息息
		'JS_USER_INFO' => 'https://api.weixin.qq.com/sns/userinfo', //网页授权获得用户信息
		'AUTHORIZE' => 'https://open.weixin.qq.com/connect/oauth2/authorize', //引导授权获取code
		'JSAPI_TICKET' => 'https://api.weixin.qq.com/cgi-bin/ticket/getticket', //请求获得jsapi_ticket
		'ACCESS_TOKEN' => 'https://api.weixin.qq.com/cgi-bin/token', //请求获得全局access_token
		'USER_ACCESS_TOKEN' => 'https://api.weixin.qq.com/sns/oauth2/access_token', //请求获取网页(用户)授权access_token
		'QRCODE'=>'https://api.weixin.qq.com/cgi-bin/qrcode/create',
		'SHOWQRCODE'=>'https://mp.weixin.qq.com/cgi-bin/showqrcode',
		'RED_MONEY'=>'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack',
		'MEDIA_UPLOAD'=>'http://file.api.weixin.qq.com/cgi-bin/media/upload',
		'MEDIA_GET'=>'http://file.api.weixin.qq.com/cgi-bin/media/get',
		'MEDIA_GET_ALL'=>'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=',
		'MENU_CREATE'=>'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=',
		'MENU_GET'=>'https://api.weixin.qq.com/cgi-bin/menu/get?access_token=',
		'CUSTOM_SAND'=>'https://api.weixin.qq.com/cgi-bin/message/custom/send',
		'USE_GET'=>'https://api.weixin.qq.com/cgi-bin/user/get'
	)
);

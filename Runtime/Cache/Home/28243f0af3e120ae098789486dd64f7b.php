<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<!-- 临时禁用缓存，避免css缓存 -->
<title>个人中心</title>
<link href="/Public/Home/css/bootstrap.min.css" rel="stylesheet">
<link href="/Public/Home/css/base.css" rel="stylesheet">
<link href="/Public/Home/css/user.css" rel="stylesheet">
<script src="/Public/Home/js/jquery.min.js"></script>
<script src="/Public/Home/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  
  
  
  <!--lb_user begin 2-->
  <div id="lb_user" class="row lb_pro">
	<div class="col-sm-3 col-xs-3 text-center">
		<div>
			<img  style="width:60px;height:60px;"class="img-circle" src="<?php echo ($wechat["headimgurl"]); ?>"/> 
		</div>
	</div>
	<div class="col-sm-7 col-xs-7 text-left">
		<div  class="user_name">
			<?php if($user_auth['uid'] > 0): ?>用户名：<?php echo ($user_auth["nickname"]); ?>
			<?php else: ?>
			微信名：<?php echo ($wechat["nickname"]); endif; ?>
	  	</div> 

	</div>

	
		<div class="col-sm-2 col-xs-2">
			<?php if($user_auth['uid'] <= 0): ?><a href="<?php echo U('user/login');?>" class="btn btn-default btn-lg" role="button">
			<i class="glyphicon glyphicon-chevron-right"></i></a>
			<?php else: ?>
				<div  class="user_name">
					<a href="<?php echo U('user/logout');?>" class="btn btn-danger" role="button">退出
					</a>
				</div><?php endif; ?>
		</div>
	
  </div>
  <!--lb_user end 2--> 
  <!--lb_task begin 3-->
  <div id="lb_task" class="row lb_pro lb_common">
	<div class="col-sm-2 col-xs-3 text-center">
		<h3><i class="glyphicon glyphicon-tasks"></i></h3>
	</div>
	<div class="col-sm-8 col-xs-6 text-left">
		<div  class="user_name">
			<a href="<?php echo U('my/task');?>">我的任务</a>
		</div>
	</div>
	<div class="col-sm-2 col-xs-3">
			
	</div>
  </div>
  <!--lb_task end 3-->
  <!--lb_order begin 4-->
  <div id="lb_order" class="row lb_pro lb_common">
	<div class="col-sm-2 col-xs-3 text-center">
		<h3><i class="glyphicon glyphicon-ok-sign"></i></h3>
	</div>
	<div class="col-sm-8 col-xs-6 text-left">
		<div  class="user_name">
			<a href="<?php echo U('order/my');?>">我的订单</a>
		</div>
	</div>
	<div class="col-sm-2 col-xs-3">
			
	</div>
  </div>
  <!--lb_order end 4-->
  <!--lb_notice begin 5-->
  <div id="lb_notice" class="row lb_pro lb_common">
	<div class="col-sm-2 col-xs-3 text-center">
		<h3><i class="glyphicon glyphicon-cloud"></i></h3>
	</div>
	<div class="col-sm-8 col-xs-6 text-left">
		<div  class="user_name">
			<a href="<?php echo U('my/notice');?>">系统通知</a>
			<?php if($notice > 0): ?><i style="color:red;" class="glyphicon glyphicon-info-sign"></i><?php endif; ?>
		</div>
	</div>
	<div class="col-sm-2 col-xs-3">
			
	</div>
  </div>
  <!--lb_notice end 5-->
  <!--lb_nav begin 6-->
  <div id="lb_nav" class="row lb_fix_bottom">
	  <ul class="nav nav-pills text-center" role="tablist" >
		<li role="presentation">
			<a href="<?php echo U('index/index');?>">
			<i class="glyphicon glyphicon-home"></i><br>首页</a></li>
		<li role="presentation">
			<a href="<?php echo U('goods/index');?>">
			<i class="glyphicon glyphicon-th-large"></i><br>分类</a></li>
		<li role="presentation">
			<a href="<?php echo U('cart/index');?>">
			<i class="glyphicon glyphicon-shopping-cart"></i><br>购物车</a></li>    
		<li role="presentation">
			<a href="<?php echo U('my/index');?>">
			<i class="glyphicon glyphicon-user"></i><br>我的</a></li>     
	  </ul>  
  </div>
  <!--lb_nav end 6-->
</div>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<!-- 临时禁用缓存，避免css缓存 -->
<title>ROBAM老板</title>
<link href="/Public/Home/css/bootstrap.min.css" rel="stylesheet">
<link href="/Public/Home/css/base.css" rel="stylesheet">
<link href="/Public/Home/css/index.css" rel="stylesheet">
<script src="/Public/Home/js/jquery.min.js"></script>
<script src="/Public/Home/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  
 
  <!--banner begin 2-->
  <div id="lb_banner" class="row">
		<section class="awSlider">
		  <div id="BoeCarousel"  class="carousel slide" data-ride="carousel"> 
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<?php if(is_array($home["banner"])): foreach($home["banner"] as $k=>$vo): ?><li data-target=".carousel" data-slide-to="<?php echo ($k); ?>" class="active"></li><?php endforeach; endif; ?>
			</ol>
			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<?php if(is_array($home["banner"])): foreach($home["banner"] as $k=>$vo): ?><div class="item <?php if($k == 1): ?>active<?php endif; ?>"><a href="<?php echo (thumb_link($vo["thumb_link"])); ?>"><img tag="0" src="<?php echo ($vo["thumb"]); ?>" ></a>
					</div><?php endforeach; endif; ?>
			  </div>
			</div>
			<!-- Controls --> 
			<a class="left carousel-control" href=".carousel" role="button" data-slide="prev"> 
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only"></span> </a> 
			<a class="right carousel-control" href=".carousel" role="button" data-slide="next"> 
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> 
			<span class="sr-only"></span> </a> 
			</div>
		</section>
		
	<!--<a href="#"><img src="images/banner_1.png" class="img-responsive" alt=""/></a>-->
	
  </div>
  <!--banner end 2-->  
  <!--lb_star begin 3-->
  <div id="lb_star" class="row lb_pro" style="margin-top:5px;">
	<div class="pro_title2">
		<div class="col-sm-12 col-xs-12 text-center">
		<a href="#">明星产品</a>
		</div>
	</div>
  </div>
  <!--lb_star end 3-->
  <!--lb_star_pro begin 4-->
  <div id="lb_star_pro" class="row">
  	<?php if(is_array($home["start"])): foreach($home["start"] as $k=>$vo): ?><div class="col-sm-6 col-xs-6 text-center" style="padding: 5px;">
			<a href="<?php echo (thumb_link($vo["thumb_link"])); ?>">
			<div class="pro_bg"  >
			<img src="<?php echo ($vo["thumb"]); ?>"/>
			</div>
		 
			</a>
		</div><?php endforeach; endif; ?>
  </div>
  <!--lb_star_pro end 4-->
  <!--lb_hot_pro begin 5-->
  <div id="lb_hot" class="row lb_pro">
	<div class="pro_title2">
		<div class="col-sm-12 col-xs-12 text-center"><a href="">热销推荐</a></div>
	</div>
	<div class="hot_pro">
		<a href="<?php echo (thumb_link($home['hot'][1]['thumb_link'])); ?>"><img src="<?php echo ($home['hot'][1]['thumb']); ?>" class="img-responsive" alt=""/></a>
	</div> 
  </div>
  <div id="lb_hot2"  class="row">
		<div class="col-sm-4 col-xs-4 text-center hot_pro1 hot_mar hot_pro2">
		<a href="<?php echo (thumb_link($home['hot'][2]['thumb_link'])); ?>"><img src="<?php echo ($home['hot'][2]['thumb']); ?>"/></a></div>
		<div class="col-sm-4 col-xs-4 hot_mar">
			<div>
				<div class="lo">
					<a href="<?php echo (thumb_link($home['hot'][3]['thumb_link'])); ?>">
					<div class="col-sm-12 col-xs-12 text-center pro_bg hot_pro3">
						 <img src="<?php echo ($home['hot'][3]['thumb']); ?>"/>
					</div>
					<div class="col-sm-12 col-xs-12 text-center pro_bg hot_pro3 pro_title">
						<!-- 老板新品<br>
						赠老板电压力锅<br>
						<font color="#FF0000">¥ 5580.00</font> -->
					</div>
					</a> 
				</div>
				<div class="lo" >
					<a href="<?php echo (thumb_link($home['hot'][4]['thumb_link'])); ?>">
					<div class="col-sm-12 col-xs-12 text-center hot_mar pro_bg hot_pro3">
						 <img src="<?php echo ($home['hot'][4]['thumb']); ?>"/>
					</div>
					<div class="col-sm-12 col-xs-12 text-center pro_bg hot_pro3 pro_title">
						<!-- 老板新品<br>
						赠老板电压力锅<br>
						<font color="#FF0000">¥ 5580.00</font> -->
					</div>
					</a>
				</div> 
			</div>   
		</div>
		<div class="col-sm-4 col-xs-4 hot_mar"  >
			<div>
				<div class="lo" >
					<a href="<?php echo (thumb_link($home['hot'][5]['thumb_link'])); ?>">
					<div class="col-sm-12 col-xs-12 text-center pro_bg hot_pro3">
						 <img src="<?php echo ($home['hot'][5]['thumb']); ?>"/>
					</div>
					<div class="col-sm-12 col-xs-12 text-center pro_bg hot_pro3 pro_title">
						<!-- 老板新品<br>
						赠老板电压力锅<br>
						<font color="#FF0000">¥ 5580.00</font> -->
					</div>
					</a> 
				</div>
				<div class="lo" >
					<a href="<?php echo (thumb_link($home['hot'][6]['thumb_link'])); ?>">
					<div class="col-sm-12 col-xs-12 text-center hot_mar pro_bg hot_pro3">
						 <img src="<?php echo ($home['hot'][6]['thumb']); ?>"/>
					</div>
					<div class="col-sm-12 col-xs-12 text-center pro_bg hot_pro3 pro_title">
						<!-- 老板新品<br>
						赠老板电压力锅<br>
						<font color="#FF0000">¥ 5580.00</font> -->
					</div>
					</a>
				</div>
			</div>
		</div>
	</div>
  <!--lb_hot_pro end 5-->
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
<script src="js/ie10-viewport-bug-workaround.js"></script>
<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<!-- 临时禁用缓存，避免css缓存 -->
<title>产品详细</title>
<link href="/Public/Home/css/bootstrap.min.css" rel="stylesheet">
<link href="/Public/Home/css/base.css" rel="stylesheet">
<link href="/Public/Home/css/pro_detail.css" rel="stylesheet">
<script src="/Public/Home/js/jquery.min.js"></script>
<script src="/Public/Home/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
img{
	max-width: 100%;
}
</style>
<body>
<div class="container">
  <div class="fix">
	<!--head begin 1-->
	<div id="lb_head" class="row">
	  <div class="col-sm-1 col-xs-2 head_fdj">
	  <a onclick="back()" class="btn btn-default btn-lg" role="button">
	  <i class="glyphicon glyphicon-chevron-left"></i></a>
	  </div>
	  <div class="col-sm-10 col-xs-8 head_title">产品详情</div>
	  <div class="col-sm-1 col-xs-2 head_jia"></div>
	</div>
	<!--head end 1-->
  </div>
  <!--lb_pro_detail begin 2-->
  <form id="items"   action="<?php echo U('');?>" method="post">
  <div id="lb_pro_detail" class="row lb_pro lb_common">
	<div id="pro_pic" class="col-sm-5 col-xs-5 text-center">
	<img src="<?php echo ($item["thumb"]); ?>"/> </div>

	<div class="col-sm-7 col-xs-7 pro_title">
		<div class="col-sm-12 col-xs-12">
			<div class="col-sm-2 col-xs-4 text-left">商品名称:</div>
			<div class="col-sm-10 col-xs-8 text-left" style="padding-left:10px;">
				<font><?php echo ($item["goods_name"]); ?></font>

			</div>
		</div>
		<div class="col-sm-12 col-xs-12">
			<div class="col-sm-2 col-xs-4 text-left">市场价格:</div>
			<div class="col-sm-10 col-xs-8 text-left" style="padding-left:10px;">
				<font><s>¥ <?php echo ($item["price_market"]); ?></s></font>
			</div>
		</div>

		<?php if($price['active']): ?><div class="col-sm-12 col-xs-12">
			    <div class="col-sm-2 col-xs-4 text-left">活动价格:</div>
				<div class="col-sm-10 col-xs-8 text-left" style="padding-left:10px;">

						<font color="#FF0000">¥ <?php echo ($price["price"]); ?></font>

				  <input type="hidden" name="goods_id" value="<?php echo ($item["goods_id"]); ?>">
				</div>
			</div>
		<?php else: ?>
			<div class="col-sm-12 col-xs-12">
			 	<div class="col-sm-2 col-xs-4 text-left">销售价格:</div>
				<div class="col-sm-10 col-xs-8 text-left" style="padding-left:10px;">

						<font color="#FF0000">¥ <?php echo ($price["price"]); ?></font>

				  <input type="hidden" name="goods_id" value="<?php echo ($item["goods_id"]); ?>">
				</div>
			</div><?php endif; ?>


	  <?php if(($item["category_id"] == 2)): ?><div class="col-sm-12 col-xs-12">
			<div class="col-sm-2 col-xs-4 text-left">燃料种类:</div>
			<div class="col-sm-10 col-xs-8 text-left" style="padding-left:10px;">
				<?php $_result=goods_shop_fuel($item['fuel']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><button style="margin-right:5px;" type="button"  id="fuel<?php echo ($vo["id"]); ?>" onclick="fuel_select($(this))" class="btn btn-default btn-xs"><?php echo ($vo["fuel_name"]); ?></button><?php endforeach; endif; else: echo "" ;endif; ?>
				<input type="hidden" data-pro="" data-type="2" name="fuel_name" value="">
			</div>
		</div><?php endif; ?>
		<div class="col-sm-12 col-xs-12" style="padding-top:5px;">
			<div class="col-sm-2 col-xs-4 text-left">数量:</div>
			<div class="col-sm-10 col-xs-8 text-left" style="padding-left:10px;">
			<button type="button" onclick="num_cut()" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-minus"></i></button>
			<input type="text" id="pro_num" name="num" value="1" size="2" class="text-center btn">
			<button type="button" onclick="num_add()"    class="btn btn-xs btn-default"><i class="glyphicon glyphicon-plus"></i></button>
			</div>
		</div>
		<div class="col-sm-12 col-xs-12" style="padding-top:5px;">
			<div class="col-sm-2 col-xs-6 text-center">
			<button onclick="joinCart()" type="button" class="btn btn-sm btn-info">加购物车</button>
			</div>
			<div class="col-sm-2 col-xs-6 text-center">
			<button  onclick="buy()" type="button" class="btn btn-sm btn-info">立即购买</button>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-xs-12" style="padding:10px;">
		<?php echo ($item["description"]); ?>
	</div>
  </div>
  </form>
  <!--lb_pro_detail end 2-->
</div>
</body>
<script >
function num_add(){
  var n = $('#pro_num').val();
  n++;
  $('#pro_num').val(n);
}
function num_cut(){
  var n = $('#pro_num').val();
  n--;
  if(n>0){
	$('#pro_num').val(n);
  }
}
function color_select(ob){
	var hide = $("input[name='color_name']");
	if(hide.attr('data-pro')){
		$("#"+hide.attr('data-pro')).removeClass('btn-primary').addClass('btn-default');
	}
	ob.removeClass('btn-default').addClass('btn-primary');
  	hide.attr('data-pro',ob.attr('id')).val(ob.html());
}
function fuel_select(ob){
	var hide = $("input[name='fuel_name']");
	if(hide.attr('data-pro')){
		$("#"+hide.attr('data-pro')).removeClass('btn-primary').addClass('btn-default');
	}
	ob.removeClass('btn-default').addClass('btn-primary');
  	hide.attr('data-pro',ob.attr('id')).val(ob.html());
}
//加入购物车
function joinCart(){
	if(_init()!=false){
		$.post("<?php echo U('cart/ajax_join');?>",$("#items").serialize(), function(data){if(data.code==1){alert(data.msg)}else{alert('加入成功,在购物车等亲~~~')}})
	}
}
//立刻购买
function buy(){
  if(_init()!=false){
	$('#items').attr('action',"<?php echo U('order/join');?>").submit();
  }
}
function _init(){
  var login = <?php  echo $is_login?>;
  if(login==0){
	window.location.href="<?php echo U('user/login');?>";
	return false;
  }
  var color = $("input[name='color_name']").val();
  if(color==''){
	alert('选择颜色');
	return false;
  }
  var fuel = $("input[name='fuel_name']");
  if(fuel.attr('data-type')==2&&fuel.val()==''){
	alert('选择燃料类型');
	return false;
  }
}
function back(){
	window.history.go(-1);
}
</script>
</html>
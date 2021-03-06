<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<!-- 临时禁用缓存，避免css缓存 -->
<title>购物车</title>
<link href="/Public/Home/css/bootstrap.min.css" rel="stylesheet">
<link href="/Public/Home/css/base.css" rel="stylesheet">
<link href="/Public/Home/css/cart.css" rel="stylesheet">
<script src="/Public/Home/js/jquery.min.js"></script>
<script src="/Public/Home/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
   <div class="fix">
    <!--head begin 1-->
    <div id="lb_head" class="row">
      <div class="col-sm-1 col-xs-2 ">
      <a href="<?php echo ($_SERVER['HTTP_REFERER']); ?>" class="btn btn-lg" role="button" style="color: black">
      <i class="glyphicon glyphicon-chevron-left"></i></a>
      </div>
      <div class="col-sm-10 col-xs-8 head_title">购物车</div>
      <div class="col-sm-1 col-xs-2 head_jia"></div> 
    </div>
    <!--head end 1-->
  </div> 
 
  <!--lb_cart begin 3-->
  <div id="lb_carts" class="row"  style="margin-top:60px;">
	<form class="form-horizontal" role="form" action="" method="post"  name="product_order" id="product_order">

	<?php if(is_array($list)): foreach($list as $key=>$vo): $total +=$vo['price']; ?>
	<div class="lb_cart form-group cart_mar">
		<div class="col-sm-1 col-xs-2 text-left" style="padding-top:30px;padding-left:10px;">
			<input type="checkbox"  name="checkbox_name[]" value="<?php echo ($vo["id"]); ?>">
		</div>
		<div class="col-sm-2 col-xs-4 text-left" style="padding-top:20px;">
		<img style="max-height:60px;" src="<?php echo ($vo["thumb"]); ?>"/> </div>
		<div class="col-sm-9 col-xs-6 text-left" style="padding-top:20px;">
			<div class="col-sm-12 col-xs-12 text-left" style="padding-right:10px;">
			<?php echo ($vo["goods_name"]); ?></div>
			<div class="col-sm-12 col-xs-12 text-left pro_title">
				<div class="col-sm-2 col-xs-3 text-left">
					<font color="#FF0000">¥ <?php echo (floatval($vo["price_sales"])); ?></font>
				</div>
				<div class="col-sm-3 col-xs-10 text-left">
					<button type="button" onclick="num_cut(<?php echo ($vo["id"]); ?>)" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-minus"></i></button>
					<input type="text" id="pro_<?php echo ($vo["id"]); ?>"   value="<?php echo ($vo["num"]); ?>" size="2" class="text-center btn">
					<button type="button" onclick="num_add(<?php echo ($vo["id"]); ?>)"    class="btn btn-xs btn-default"><i class="glyphicon glyphicon-plus"></i></button>
				</div>
			 </div>
		</div>
	</div><?php endforeach; endif; ?>
	
	
	
 
	<div id="lb_cart_end"></div>
 
	<div class="lb_cart form-group lb_fix_order">
		<div class="col-sm-2 col-xs-4 text-left" style=" padding-top:10px;padding-left:10px;">
			<label for="lb_id_all"><input type="checkbox" id="lb_id_all" value="all">
			&nbsp;&nbsp;全选</label>
		</div>
		<div class="col-sm-10 col-xs-8 text-left">
			<div class="col-sm-12 col-xs-12 text-left" style="line-height:45px;">
				<div class="col-sm-5 col-xs-8 text-left" >
					总计：<font color="#FF0000">¥ <?php echo (floatval($total)); ?></font>
				</div>
				<div class="col-sm-7 col-xs-4 text-left">
					<a  onclick="account()" class="btn btn-primary btn-lg active" role="button">结算</a>
				</div>
			 </div>
		</div>
	</div>
	</form>
  </div>
  <!--lb_star end 3-->
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
<script type="text/javascript">
function num_add(id){
 	var ob = $('#pro_'+id);
 	var n = ob.val();
  	n++;
  	$.post("<?php echo U('cart/ajax_addNum');?>",{'id':id}, function(data){if(data){ob.val(n);}else{alert('系统异常，请重试')}})
  
}
function num_cut(id){
	var ob = $('#pro_'+id);
	var n = ob.val();
  	n--;
  	if(n>0){
  		$.post("<?php echo U('cart/ajax_decNum');?>",{'id':id}, function(data){if(data){ob.val(n);}else{alert('系统异常，请重试')}})
  	}
}

 
$("#lb_id_all").click(function(){
 
  if($(this).attr("checked")){ //check all
  	$(this).attr('checked',false);
	$(this).prop('checked',false);
   $("input[name='checkbox_name[]']").each(function(){
    $(this).attr("checked",false);$(this).prop('checked',false);
   });
  }else{
  	$(this).attr('checked',true);
	$(this).prop('checked',true);
   $("input[name='checkbox_name[]']").each(function(){
   	 $(this).attr("checked",true);$(this).prop('checked',true);
    
   });
  }
 });

function account(){
	var id_array=new Array();  
	$("input[name='checkbox_name[]']:checked").each(function(){  
   		 id_array.push($(this).val());//向数组中添加元素  
	});  
	var idstr=id_array.join(',');//将数组元素连接起来以构建一个字符串  
	if(idstr=='') {
		alert('请选择商品');
		return false;
	}else{
		$("#product_order").attr('action',"<?php echo U('order/join');?>").submit();
	}
	
}
</script>
</body>
</html>
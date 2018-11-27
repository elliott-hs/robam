<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ((isset($meta_title) && ($meta_title !== ""))?($meta_title):"后台管理"); ?></title>
    <link href="/Public/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/module.css">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/<?php echo (C("COLOR_STYLE")); ?>.css" media="all">
     <!--[if lt IE 9]>
    <script type="text/javascript" src="/Public/static/jquery-1.10.2.min.js"></script>
    <![endif]--><!--[if gte IE 9]><!-->
    <script type="text/javascript" src="/Public/static/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/jquery.mousewheel.js"></script>
    <!--<![endif]-->
    
</head>
<body>
    <!-- 头部 -->
    <div class="header">
        <!-- Logo -->
        <span class="logo"></span>
        <!-- /Logo -->

        <!-- 主导航 -->
        <ul class="main-nav">
            <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>"><a href="<?php echo (u($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!-- /主导航 -->

        <!-- 用户栏 -->
        <div class="user-bar">
            <a href="javascript:;" class="user-entrance"><i class="icon-user"></i></a>
            <ul class="nav-list user-menu hidden">
                <li class="manager">你好，<em title="<?php echo session('user_auth.username');?>"><?php echo session('user_auth.username');?></em></li>
                <li><a href="<?php echo U('User/updatePassword');?>">修改密码</a></li>
                <li><a href="<?php echo U('User/updateNickname');?>">修改昵称</a></li>
                <li><a href="<?php echo U('Public/logout');?>">退出</a></li>
            </ul>
        </div>
    </div>
    <!-- /头部 -->

    <!-- 边栏 -->
    <div class="sidebar">
        <!-- 子导航 -->
        
            <div id="subnav" class="subnav">
                <?php if(!empty($_extra_menu)): ?>
                    <?php echo extra_menu($_extra_menu,$__MENU__); endif; ?>
                <?php if(is_array($__MENU__["child"])): $i = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><!-- 子导航 -->
                    <?php if(!empty($sub_menu)): if(!empty($key)): ?><h3><i class="icon icon-unfold"></i><?php echo ($key); ?></h3><?php endif; ?>
                        <ul class="side-sub-menu">
                            <?php if(is_array($sub_menu)): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li>
                                    <a class="item" href="<?php echo (u($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul><?php endif; ?>
                    <!-- /子导航 --><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        
        <!-- /子导航 -->
    </div>
    <!-- /边栏 -->

    <!-- 内容区 -->
    <div id="main-content">
        <div id="top-alert" class="fixed alert alert-error" style="display: none;">
            <button class="close fixed" style="margin-top: 4px;">&times;</button>
            <div class="alert-content">这是内容</div>
        </div>
        <div id="main" class="main">
            
            <!-- nav -->
            <?php if(!empty($_show_nav)): ?><div class="breadcrumb">
                <span>您的位置:</span>
                <?php $i = '1'; ?>
                <?php if(is_array($_nav)): foreach($_nav as $k=>$v): if($i == count($_nav)): ?><span><?php echo ($v); ?></span>
                    <?php else: ?>
                    <span><a href="<?php echo ($k); ?>"><?php echo ($v); ?></a>&gt;</span><?php endif; ?>
                    <?php $i = $i+1; endforeach; endif; ?>
            </div><?php endif; ?>
            <!-- nav -->
            

            


	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/base.css" media="all">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/common.css" media="all">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/module.css">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/<?php echo (C("COLOR_STYLE")); ?>.css" media="all">

	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<!--<script src="/Public/Admin/js/bootstrap.min.js"></script>-->
	<!-- 新 Bootstrap 核心 CSS 文件 -->
  <!--   <link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css"> -->
	<link href="/Public/static/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
	<?php if(C('COLOR_STYLE')=='blue_color') echo '<link href="/Public/static/datetimepicker/css/datetimepicker_blue.css" rel="stylesheet" type="text/css">'; ?>
	<link href="/Public/static/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="/Public/static/datetimepicker/js/bootstrap-datetimepicker.js"></script>
	<script type="text/javascript" src="/Public/static/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script src="/Public/Admin/js/jquery.PrintArea.min.js"></script>



	<style>
		#detailTable tr th:nth-child(1){
			width: 10%
		}
		#detailTable tr th:nth-child(2){
			width: 30%
		}
		#detailTable tr th:nth-child(3){
			width: 15%
		}
		#detailTable tr th:nth-child(4){
			width: 10%
		}
		#detailTable tr th:nth-child(5){
			width: 20%
		}
		#detailTable tr th:nth-child(6){
			width: 25%
		}
		#detailTable table td{
			background-color: #f2f2f2;
		}
		#detailTable table td:nth-child(3){
			width: 10%;
		}
		#goodsdetail{
			width: 100%;
		}
		.inline-block{
			display: inline-block
		}
		.bb1{border-bottom: 1px solid #353535;}
		.goodslogo{width: 50px;}
		#goodsdetail{width: 100px}
		.smallfont{
			font-size:12px;
			border-bottom:1px solid #bbb;
		}
		.smallfont > * {
			background-color: #f2f2f2;
		}
		.list_select{
			margin-top: -25px;
 			height: 35px;
 			background-color:#fff;
 		}
	</style>
	<!-- 标题栏 -->
	<div class="main-title">
		<!--<h2>拼团订单列表</h2>-->
		<h2><?php echo ($meta_title); ?></h2>
	</div>

	<!-- 按钮工具栏 -->
	<div class="cf">

		<!-- 高级搜索 -->
		<div class="search-form fr cf">
			<div class="sleft">
				<div class="drop-down">
					<span id="sch-sort-txt" class="sort-txt" data="<?php echo ($status); ?>"><?php echo get_status_order($status);?></span>
					<i class="arrow arrow-down"></i>
					<ul id="sub-sch-menu" class="nav-list hidden">
						<li><a href="javascript:;" value="0">所有</a></li>
						<li><a href="javascript:;" value="1">未付款</a></li>
						<li><a href="javascript:;" value="2">已付款</a></li>
						<li><a href="javascript:;" value="3">已发货</a></li>
						<li><a href="javascript:;" value="4">已完成</a></li>
						<li><a href="javascript:;" value="5">已退货</a></li>
						<li><a href="javascript:;" value="6">已结算</a></li>
					</ul>
				</div>
				<input type="text" name="title" class="search-input" value="<?php echo I('title');?>" placeholder="输入订单号或渠道商名称">
				<a class="sch-btn" href="javascript:;" id="search" url="<?php echo U('orders/index');?>"><i class="btn-search"></i></a>
			</div>
            <div class="btn-group-click adv-sch-pannel fl">
                <button class="btn">高 级<i class="btn-arrowdown"></i></button>
                <div class="dropdown cf">
                	<div class="row">
                		<label>创建时间：</label>
                		<input type="text" id="time-start" name="time-start" class="text input-2x" value="" placeholder="起始时间" /> -
                        <div class="input-append date" id="datetimepicker"  style="display:inline-block">
                            <input type="text" id="time-end" name="time-end" class="text input-2x" value="" placeholder="结束时间" />
                            <span class="add-on"><i class="icon-th"></i></span>
                        </div>
                	</div>
                </div>
            </div>
		</div>
	</div>
	<!-- 数据列表 -->
	<div class="data-table">
		<table id="detailTable">
			<thead>
				<tr>
				    <th>商品品类</th>
					<th>商品信息</th>
					<th>实收款</th>
					<th>渠道商</th>
					<th>客户收货地址</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($list)): if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr style="background: #fff">
							<td colspan="5"><div>订单编号：<?php echo ($vo["order_id"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;下单时间：<?php echo (time_format($vo["create_time"])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单金额：<?php echo (floatval($vo["price_order"])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;付款方式：
								<?php switch($vo["pay_type"]): case "0": ?>货到付款<?php break;?>
								    <?php case "1": ?>微信支付<?php break;?>
								    <?php case "2": ?>支付宝支付<?php break;?>
								    <?php case "3": ?>网银支付<?php break;?>
								    <?php default: ?>未知<?php endswitch;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单状态：
								<?php switch($vo["status"]): case "1": ?>未付款<?php break;?>
								    <?php case "2": ?>已付款<?php break;?>
								    <?php case "3": ?>已发货(安装)<?php break;?>
								    <?php case "4": ?>已完成<?php break;?>
								    <?php case "5": ?>已退货<?php break;?>
								    <?php case "6": ?>已结算<?php break;?>
								    <?php default: ?>未知<?php endswitch;?>


							</div></td>
							<td>
						
								<?php if(UID == 1): ?><a class="btn"  style="background-color:red;margin-top: 2px;" onclick="order_complant('<?php echo ($vo["order_id"]); ?>',2)">确认付款</a>
									<a class="btn "  style="background-color:red;margin-top: 2px;width: 20%;" onclick="order_complant('<?php echo ($vo["order_id"]); ?>',3)">确认发货</a>
									<a class="btn " style="background-color:red;margin-top: 2px;width: 20%;"  onclick="order_complant('<?php echo ($vo["order_id"]); ?>',4)">确认完成</a>
									<a class="btn " style="background-color:red;margin-top: 2px;width: 20%;"  onclick="order_complant('<?php echo ($vo["order_id"]); ?>',5)">确认退货</a>
									<a class="btn  " style="background-color:red;margin-top: 2px;width: 20%;"  onclick="order_complant('<?php echo ($vo["order_id"]); ?>',6)">确认结算</a>
								
								<?php else: ?>
									<?php if($vo['status'] == 1): ?><a class="btn"  style="background-color:red;margin-top:10px;width: 20%;" onclick="order_complant('<?php echo ($vo["order_id"]); ?>',2)">确认付款</a><?php endif; ?>
									<?php if($vo['status'] == 2): ?><a class="btn"  style="background-color:red;margin-top:10px;width: 20%;" onclick="order_complant('<?php echo ($vo["order_id"]); ?>',3)">确认发货</a><?php endif; ?>
								<!-- 	<input  class="btn"  onclick="print(<?php echo ($k); ?>)" type="button" value="打印" ></input> -->
	    							<?php if($vo['status'] == 3): ?><a class="btn" style="background-color:red;margin-top:10px;width: 20%;"  onclick="order_complant('<?php echo ($vo["order_id"]); ?>',4)">确认完成</a><?php endif; ?>
									<?php if($vo['status'] == 4): ?><a class="btn" style="background-color:red;margin-top:10px;width: 20%;"  onclick="order_complant('<?php echo ($vo["order_id"]); ?>',5)">确认退货</a>
										<a class="btn" style="background-color:red;margin-top:10px;width: 20%;"  onclick="order_complant('<?php echo ($vo["order_id"]); ?>',6)">确认结算</a><?php endif; endif; ?>
							</td>
						</tr>
						<?php if(is_array($vo['goods'])): $i = 0; $__LIST__ = $vo['goods'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g): $mod = ($i % 2 );++$i;?><tr class="smallfont">
								<td><?php echo ($g["category_name"]); ?></td>
								<td>
									<table>
										<tr>
											<td rowspan="2">
												<img src="<?php echo ($g["thumb"]); ?>" style="width:80px;">
											</td>
											<td><?php echo ($g["goods_name"]); ?></td>
											<td rowspan="2">×<?php echo ($g["sell_num"]); ?></td>
										</tr>
										<tr>
											<td>
												燃料：<?php echo ($g["fuel_name"]); ?>&nbsp;&nbsp;&nbsp;
												<!-- 颜色：<?php echo ($g["color_name"]); ?> -->
											</td>
										</tr>
									</table>
								</td>
								<td>
									<div>售价：<font color="#FF0000">¥<?php echo (floatval($g["unit_price"])); ?></font></div>
								</td>
								<td><?php echo ($vo["nickname"]); ?></td>
								<td>
									<div>姓名：<?php echo ($vo["name"]); ?></div>
									<div>电话：<?php echo ($vo["phone"]); ?></div>
									<div>地址：<?php echo ($vo["area"]); echo ($vo["address"]); ?></div>

								</td>
								<td style="width:180px;">
									<div>提成比：<?php echo (floatval($g["reward_rate"])); ?></div>
									<div>总计：<font color="#FF0000">¥<?php echo (floatval($g["reward_money"])); ?></font></div>
								</td>
							</tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
					<?php else: ?>
					<td colspan="99" class="text-center"> aOh! 暂时还没有内容! </td><?php endif; ?>
			</tbody>
		</table>
	</div>



		<?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="hidden" id="print<?php echo ($k); ?>" style="text-align: center;">
						<div><hr></div>
						<div>
							 订单编实时号：<?php echo ($vo["order_id"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;下单时间：<?php echo (time_format($vo["order_time"])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

						</div>
						<div>
							订单金额：<?php echo (floatval($vo["price_order"])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							付款方式：
								<?php switch($vo["pay_type"]): case "0": ?>货到付款<?php break;?>
								    <?php case "1": ?>微信支付<?php break;?>
								    <?php case "2": ?>支付宝<?php break;?>
								    <?php case "3": ?>网银支付<?php break;?>
								    <?php default: ?>未知方式<?php endswitch;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;状态：
								<?php switch($vo["status"]): case "1": ?>未付款<?php break;?>
								    <?php case "2": ?>货到付款</a><?php break;?>
								    <?php case "3": ?>完成<?php break;?>
								    <?php default: ?>未知方式<?php endswitch;?>




						</div>
							<div><hr></div>
						<?php if(is_array($vo['goods'])): $i = 0; $__LIST__ = $vo['goods'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g): $mod = ($i % 2 );++$i;?><div>

								<td>种类：<?php echo ($g["category_name"]); ?>&nbsp;&nbsp;&nbsp;</td>

								<td>名称：<?php echo ($g["goods_name"]); ?>&nbsp;&nbsp;&nbsp;</td>
								<td>数量：<?php echo ($g["sell_num"]); ?>&nbsp;&nbsp;&nbsp;</td>

								<td>
									燃料：<?php echo ($g["fuel_name"]); ?>&nbsp;&nbsp;&nbsp;

								</td>
								<td>售价：
									<font color="#FF0000">¥<?php echo (floatval($g["unit_price"])); ?></font>
								</td>

							</tr>

							</div>

							<div>
								<td>收货地址：&nbsp;&nbsp;&nbsp;</td>
								<td>姓名：<?php echo ($vo["name"]); ?></td>
								<td>电话：<?php echo ($vo["phone"]); ?></td>
								<td>地址：<?php echo ($vo["area"]); echo ($vo["address"]); ?></td>
							</div>
							<div><hr></div><?php endforeach; endif; else: echo "" ;endif; ?>
	 				</div><?php endforeach; endif; else: echo "" ;endif; ?>


	<div class="page">
		<?php echo ($_page); ?>
	</div>

        </div>
        <div class="cont-ft">
            <div class="copyright">
                <div class="fl">感谢使用<a href="http://www.onethink.cn" target="_blank">OneThink</a>管理平台</div>
                <div class="fr">V<?php echo (ONETHINK_VERSION); ?></div>
            </div>
        </div>
    </div>
    <!-- /内容区 -->
    <script type="text/javascript">
    (function(){
        var ThinkPHP = window.Think = {
            "ROOT"   : "", //当前网站地址
            "APP"    : "/index.php", //当前项目地址
            "PUBLIC" : "/Public", //项目公共目录地址
            "DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
            "MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
            "VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
        }
    })();
    </script>
    <script type="text/javascript" src="/Public/static/think.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/common.js"></script>
    <script type="text/javascript">
        +function(){
            var $window = $(window), $subnav = $("#subnav"), url;
            $window.resize(function(){
                $("#main").css("min-height", $window.height() - 130);
            }).resize();

            /* 左边菜单高亮 */
            url = window.location.pathname + window.location.search;
            url = url.replace(/(\/(p)\/\d+)|(&p=\d+)|(\/(id)\/\d+)|(&id=\d+)|(\/(group)\/\d+)|(&group=\d+)/, "");
            $subnav.find("a[href='" + url + "']").parent().addClass("current");

            /* 左边菜单显示收起 */
            $("#subnav").on("click", "h3", function(){
                var $this = $(this);
                $this.find(".icon").toggleClass("icon-fold");
                $this.next().slideToggle("fast").siblings(".side-sub-menu:visible").
                      prev("h3").find("i").addClass("icon-fold").end().end().hide();
            });

            $("#subnav h3 a").click(function(e){e.stopPropagation()});

            /* 头部管理员菜单 */
            $(".user-bar").mouseenter(function(){
                var userMenu = $(this).children(".user-menu ");
                userMenu.removeClass("hidden");
                clearTimeout(userMenu.data("timeout"));
            }).mouseleave(function(){
                var userMenu = $(this).children(".user-menu");
                userMenu.data("timeout") && clearTimeout(userMenu.data("timeout"));
                userMenu.data("timeout", setTimeout(function(){userMenu.addClass("hidden")}, 100));
            });

	        /* 表单获取焦点变色 */
	        $("form").on("focus", "input", function(){
		        $(this).addClass('focus');
	        }).on("blur","input",function(){
				        $(this).removeClass('focus');
			        });
		    $("form").on("focus", "textarea", function(){
			    $(this).closest('label').addClass('focus');
		    }).on("blur","textarea",function(){
			    $(this).closest('label').removeClass('focus');
		    });

            // 导航栏超出窗口高度后的模拟滚动条
            var sHeight = $(".sidebar").height();
            var subHeight  = $(".subnav").height();
            var diff = subHeight - sHeight; //250
            var sub = $(".subnav");
            if(diff > 0){
                $(window).mousewheel(function(event, delta){
                    if(delta>0){
                        if(parseInt(sub.css('marginTop'))>-10){
                            sub.css('marginTop','0px');
                        }else{
                            sub.css('marginTop','+='+10);
                        }
                    }else{
                        if(parseInt(sub.css('marginTop'))<'-'+(diff-10)){
                            sub.css('marginTop','-'+(diff-10));
                        }else{
                            sub.css('marginTop','-='+10);
                        }
                    }
                });
            }
        }();
    </script>
    
<link href="/Public/static/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
<?php if(C('COLOR_STYLE')=='blue_color') echo '<link href="/Public/static/datetimepicker/css/datetimepicker_blue.css" rel="stylesheet" type="text/css">'; ?>
<link href="/Public/static/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/Public/static/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/Public/static/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript">
$(function(){
	//搜索功能
	$("#search").click(function(){
		var url = $(this).attr('url');
		var status = $("#sch-sort-txt").attr("data");
        var query  = $('.search-form').find('input').serialize();
        query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g,'');
        query = query.replace(/^&/g,'');

		if(status != ''){
			query = 'status=' + status + "&" + query;
        }
        if( url.indexOf('?')>0 ){
            url += '&' + query;
        }else{
            url += '?' + query;
        }

		window.location.href = url;
	});

	/* 状态搜索子菜单 */
	$(".search-form").find(".drop-down").hover(function(){
		$("#sub-sch-menu").removeClass("hidden");
	},function(){
		$("#sub-sch-menu").addClass("hidden");
	});
	$("#sub-sch-menu li").find("a").each(function(){
		$(this).click(function(){
			var text = $(this).text();
			$("#sch-sort-txt").text(text).attr("data",$(this).attr("value"));
			$("#sub-sch-menu").addClass("hidden");
		})
	});

    //回车自动提交
    $('.search-form').find('input').keyup(function(event){
        if(event.keyCode===13){
            $("#search").click();
        }
    });

    $('#time-start').datetimepicker({
        format: 'yyyy-mm-dd',
        language:"zh-CN",
	    minView:2,
	    autoclose:true
    });

    $('#datetimepicker').datetimepicker({
       format: 'yyyy-mm-dd',
        language:"zh-CN",
        minView:2,
        autoclose:true,
        pickerPosition:'bottom-left'
    })

})

function order_complant(id,status){
	$.post("<?php echo U('orders/complate_order');?>",{"order_id":id,'status':status},function(data){
		if(data==true){
			window.location.reload();
		}else{
			alert('确认失败,请联系管理员');
		}
	})
}

function print(id){
    $("#print"+id).removeClass('hidden').printArea();
    $("#print"+id).addClass('hidden');
}


</script>

</body>
</html>
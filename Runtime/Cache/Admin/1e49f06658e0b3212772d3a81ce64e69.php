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
            

            
	<style type="text/css">
	.attr-color{color:#fff;background-color:#f60;}
	</style>
	<script type="text/javascript" src="/Public/static/uploadify/jquery.uploadify.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/bootstrap_alert.js"></script>
	<div class="main-title cf">
		<h2>首页设置</h2>
	</div>
	<!-- 表单 -->
	<form id="form" action="<?php echo U();?>" method="post" class="form-horizontal">
		<div class="form-item cf">
			<label class="item-label">首页轮播图<span class="check-tips">（1080*347）</span></label>
			<?php $__FOR_START_2114794616__=1;$__FOR_END_2114794616__=4;for($i=$__FOR_START_2114794616__;$i < $__FOR_END_2114794616__;$i+=1){ ?><div class="controls" style="">
				<input type="file" id="upload_picture_thumb_<?php echo ($i); ?>">
				<input type="hidden" name="thumb[<?php echo ($i); ?>][thumb]" id="cover_id_thumb_<?php echo ($i); ?>" value="<?php echo ($thumb[$i]['thumb']); ?>"/>
				<div class="upload-img-box">
					<?php if(!empty($thumb[$i]['thumb'])): ?><div class="upload-pre-item">
							<img src="<?php echo ($thumb[$i]['thumb']); ?>"/>
						</div><?php endif; ?>
				</div>
				<div class="controls">外链：<input type="text" class="text input-large" name="thumb[<?php echo ($i); ?>][thumb_link]" placeholder="输入商品UID或者完整的网页地址" value="<?php echo ($thumb[$i]['thumb_link']); ?>"></div>
				</div>
				<script type="text/javascript">
				//上传图片
				/* 初始化上传插件 */
				$("#upload_picture_thumb_<?php echo ($i); ?>").uploadify({
					"height":30,
					"swf":"/Public/static/uploadify/uploadify.swf",
					"fileObjName"     : "download",
					"buttonText"      : "轮播图<?php echo ($i); ?>",
					"uploader"        : "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
					"width"           : 120,
					'removeTimeout'	  : 1,
					'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
					"onUploadSuccess" : uploadPicturethumb,
					'onFallback' : function() {
						// alert('未检测到兼容版本的Flash.');
					}
				});
				function uploadPicturethumb(file, data){
					var data = $.parseJSON(data);
					var src = '';
					if(data.status){
						src = data.url || '' + data.path
						$("#cover_id_thumb_<?php echo ($i); ?>").val(src);
						$("#cover_id_thumb_<?php echo ($i); ?>").parent().find('.upload-img-box').html(
							        		'<div class="upload-pre-item"><img src="' + src + '"/></div>'
							        	);
						} else {
							updateAlert(data.info);
							setTimeout(function(){
							$('#top-alert').find('button').click();
							$(that).removeClass('disabled').prop('disabled',false);
							            },1500);
							        }
						}
				</script><?php } ?>
		</div>
		<hr>
		<div class="form-item cf">
			<label class="item-label">明星产品<span class="check-tips"> </span></label>
			<?php $__FOR_START_1779193426__=1;$__FOR_END_1779193426__=3;for($i=$__FOR_START_1779193426__;$i < $__FOR_END_1779193426__;$i+=1){ ?><div class="controls" style="">
				<input type="file" id="upload_picture_start_<?php echo ($i); ?>">
				<input type="hidden" name="start[<?php echo ($i); ?>][thumb]" id="cover_id_start_<?php echo ($i); ?>" value="<?php echo ($start[$i]['thumb']); ?>"/>
				<div class="upload-img-box">
					<?php if(!empty($start[$i]['thumb'])): ?><div class="upload-pre-item">
							<img src="<?php echo ($start[$i]['thumb']); ?>"/>
						</div><?php endif; ?>
				</div>
				<div class="controls">外链：<input type="text" class="text input-large" name="start[<?php echo ($i); ?>][thumb_link]" placeholder="输入商品UID或者完整的网页地址" value="<?php echo ($start[$i]['thumb_link']); ?>"></div>
				</div>
				<script type="text/javascript">
				//上传图片
				/* 初始化上传插件 */
				$("#upload_picture_start_<?php echo ($i); ?>").uploadify({
					"height":30,
					"swf":"/Public/static/uploadify/uploadify.swf",
					"fileObjName"     : "download",
					"buttonText"      : "明星产品<?php echo ($i); ?>",
					"uploader"        : "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
					"width"           : 120,
					'removeTimeout'	  : 1,
					'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
					"onUploadSuccess" : uploadPicturethumb,
					'onFallback' : function() {
						// alert('未检测到兼容版本的Flash.');
					}
				});
				function uploadPicturethumb(file, data){
					var data = $.parseJSON(data);
					var src = '';
					if(data.status){
						src = data.url || '' + data.path
						$("#cover_id_start_<?php echo ($i); ?>").val(src);
						$("#cover_id_start_<?php echo ($i); ?>").parent().find('.upload-img-box').html(
							        		'<div class="upload-pre-item"><img src="' + src + '"/></div>'
							        	);
						} else {
							updateAlert(data.info);
							setTimeout(function(){
							$('#top-alert').find('button').click();
							$(that).removeClass('disabled').prop('disabled',false);
							            },1500);
							        }
						}
				</script><?php } ?>
			 
		</div>
		<hr>
		<div class="form-item cf">
			<label class="item-label">热销推荐<span class="check-tips"> </span></label>
			<?php $__FOR_START_439907998__=1;$__FOR_END_439907998__=7;for($i=$__FOR_START_439907998__;$i < $__FOR_END_439907998__;$i+=1){ ?><div class="controls" style="">
				<input type="file" id="upload_picture_hot_<?php echo ($i); ?>">
				<input type="hidden" name="hot[<?php echo ($i); ?>][thumb]" id="cover_id_hot_<?php echo ($i); ?>" value="<?php echo ($hot[$i]['thumb']); ?>"/>
				<div class="upload-img-box">
					<?php if(!empty($hot[$i]['thumb'])): ?><div class="upload-pre-item">
							<img src="<?php echo ($hot[$i]['thumb']); ?>"/>
						</div><?php endif; ?>
				</div>
				<div class="controls">外链：<input type="text" class="text input-large" name="hot[<?php echo ($i); ?>][thumb_link]" placeholder="输入商品UID或者完整的网页地址" value="<?php echo ($hot[$i]['thumb_link']); ?>"></div>
				</div>
				<script type="text/javascript">
				//上传图片
				/* 初始化上传插件 */
				$("#upload_picture_hot_<?php echo ($i); ?>").uploadify({
					"height":30,
					"swf":"/Public/static/uploadify/uploadify.swf",
					"fileObjName"     : "download",
					"buttonText"      : "热销推荐<?php echo ($i); ?>",
					"uploader"        : "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
					"width"           : 120,
					'removeTimeout'	  : 1,
					'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
					"onUploadSuccess" : uploadPicturethumb,
					'onFallback' : function() {
						// alert('未检测到兼容版本的Flash.');
					}
				});
				function uploadPicturethumb(file, data){
					var data = $.parseJSON(data);
					var src = '';
					if(data.status){
						src = data.url || '' + data.path
						$("#cover_id_hot_<?php echo ($i); ?>").val(src);
						$("#cover_id_hot_<?php echo ($i); ?>").parent().find('.upload-img-box').html(
							        		'<div class="upload-pre-item"><img src="' + src + '"/></div>'
							        	);
						} else {
							updateAlert(data.info);
							setTimeout(function(){
							$('#top-alert').find('button').click();
							$(that).removeClass('disabled').prop('disabled',false);
							            },1500);
							        }
						}
				</script><?php } ?>
			 
		</div>
		<div class="form-item">
			<button type="submit" class="btn submit-btn ajax-post" target-form="form-horizontal">确 定</button>
			<button class="btn btn-return" onclick="javascript:history.back(-1);return false;">返 回</button>
		</div>
	</form>
 

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

<script type="text/javascript" charset="utf-8">
	Think.setValue('type',<?php echo ((isset($type) && ($type !== ""))?($type):1); ?>);
    //导航高亮
    highlight_subnav('<?php echo U('goods/index');?>');

$('#submit').click(function(){
	$('#form').submit();
});

 
$("[name='category_id']").on("change", function(){
	$("[name='reward_rate']").val($(this).children('option:selected').attr('data-rate'));
});

function addcolor(){
	var color = $("#price_sales").val();
	if(color){
		$("#color_area").append('<label class="checkbox" onclick="$(this).remove()"><span class="attr-color">'+color+'</span><input type="hidden" name="color[]" value="'+color+'"></label>');
		$("#price_sales").val('').focus();
	}
 	
 
}

</script>

</body>
</html>
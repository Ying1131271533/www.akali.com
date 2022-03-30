<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:67:"D:\Web\www.akali.com\public/../application/wed\view\user\index.html";i:1489825012;s:69:"D:\Web\www.akali.com\public/../application/wed\view\layout\index.html";i:1605784317;s:70:"D:\Web\www.akali.com\public/../application/wed\view\layout\header.html";i:1567406591;s:70:"D:\Web\www.akali.com\public/../application/wed\view\layout\footer.html";i:1553067673;}*/ ?>
<!DOCTYPE html>

<html>

	<head>

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
		
		<link rel="icon" href="__PUBLIC__img/chuyin.ico"/>
		
		<!--------------------- css ----------------------->

		<link rel="stylesheet" href="__PUBLIC__css/bootstrap.css">
			
		<?php if(\think\Request::instance()->controller() == 'Home'): ?>
		
		<!-- 首页 -->	
			<?php if(\think\Request::instance()->action() == 'index'): ?>
		
			<link rel="stylesheet" href="__PUBLIC__css/index.css">
			
			<?php endif; endif; ?>
		
		<!-- 品牌介绍 -->
		
		<?php if(\think\Request::instance()->controller() == 'About'): if(\think\Request::instance()->action() == 'index'): ?>
		
			<link rel="stylesheet" href="__PUBLIC__css/about_us.css">
			
			<?php endif; endif; ?>
		
		
		<!-- 联系我们 -->
		
		<?php if(\think\Request::instance()->controller() == 'Message'): if(\think\Request::instance()->action() == 'index'): ?>
		
			<link rel="stylesheet" href="__PUBLIC__css/contact_us.css">
			
			<?php endif; endif; ?>
		
		<!-- 新闻中心 -->
		
		<?php if(\think\Request::instance()->controller() == 'Article'): if(\think\Request::instance()->action() == 'index'): ?>
		
			<link rel="stylesheet" href="__PUBLIC__css/news.css">
			
			<?php endif; if(\think\Request::instance()->action() == 'details'): ?>
		
			<link rel="stylesheet" href="__PUBLIC__css/news_center.css">
			
			<?php endif; endif; if(\think\Request::instance()->controller() == 'Goods'): ?>
		
			<!-- 产品中心 -->
			<?php if(\think\Request::instance()->action() == 'index'): ?>
			
			<link rel="stylesheet" href="__PUBLIC__css/idangerous.swiper.css">

			<link rel="stylesheet" href="__PUBLIC__css/product.css" />
			
			<?php endif; if(\think\Request::instance()->action() == 'product_center'): ?>

			<link rel="stylesheet" href="__PUBLIC__css/product_center.css" />
			
			<?php endif; endif; if(\think\Request::instance()->controller() == 'Cart'): if(input('step') == ''): ?>

			<link rel="stylesheet" href="__PUBLIC__css/shopping_cart.css" />
			
			<?php endif; if(input('step') == '2'): ?>

			<link rel="stylesheet" href="__PUBLIC__css/confirm_order.css" />
			
			<?php endif; if(input('step') == '3'): ?>

			<link rel="stylesheet" href="__PUBLIC__css/address.css" />
			
			<?php endif; if(input('step') == '4'): ?>

			<link rel="stylesheet" href="__PUBLIC__css/pay.css" />			
			
			<?php endif; endif; ?>
		
		<!--  用户中心 -->
		<?php if(\think\Request::instance()->controller() == 'User'): if(\think\Request::instance()->action() == 'address'): ?>

			<link rel="stylesheet" href="__PUBLIC__css/address.css" />
			
			<?php endif; endif; ?>
		
		<!--------------------- javascipt ----------------------->
		
		
		<script type="text/javascript" src="__PUBLIC__js/jquery-1.11.0.js"></script>

		<script type="text/javascript" src="__PUBLIC__js/bootstrap.js"></script>
		
		<script type="text/javascript" src="__PUBLIC__js/common.js"></script>
		
		<script type="text/javascript" src="__PUBLIC__js/layer.js"></script>
	
		<!-- 产品中心 -->
		
		<?php if(\think\Request::instance()->controller() == 'Goods'): if(\think\Request::instance()->action() == 'index'): ?>
			
			<script type="text/javascript" src="__PUBLIC__js/product.js"></script>
		
			<script type="text/javascript" src="__PUBLIC__js/idangerous.swiper.min.js"></script>
			
			<?php endif; endif; ?>
		
		<!-- 新闻中心 -->
		
		<?php if(\think\Request::instance()->controller() == 'Article'): if(\think\Request::instance()->action() == 'details'): ?>
			
			<script type="text/javascript" src="__PUBLIC__js/new_center.js"></script>
			
			<?php endif; endif; ?>
		
		<!-- 联系我们 -->
		
		<?php if(\think\Request::instance()->controller() == 'Message'): if(\think\Request::instance()->action() == 'index'): ?>
			
			<script type="text/javascript" src="__PUBLIC__js/contact_us.js"></script>
			
			<?php endif; endif; ?>
		
		<!-- 购物车 -->
		
		<?php if(\think\Request::instance()->controller() == 'Cart'): if(\think\Request::instance()->action() == 'index'): ?>
			
			<!-- <script type="text/javascript" src="__PUBLIC__js/shopping_cart-2.js"></script> -->
			
			<?php endif; if(input('step') == '2'): ?>
			
			<script type="text/javascript" src="__PUBLIC__js/confirm_order-2.js"></script>
			
			<?php endif; if(input('step') == '3'): ?>
			
			<script type="text/javascript" src="__PUBLIC__js/address.js"></script>
			
			<?php endif; if(input('step') == '4'): ?>
			
			<script type="text/javascript" src="__PUBLIC__js/address.js"></script>
			
			<?php endif; endif; ?>
		
		<!-- 用户中心 -->
		
		<?php if(\think\Request::instance()->controller() == 'User'): if(\think\Request::instance()->action() == 'index'): ?>
			
			<link rel="stylesheet" href="__PUBLIC__css/member.css" />
			
			<link rel="stylesheet" href="__PUBLIC__css/idangerous.swiper.css" />
			
			<script type="text/javascript" src="__PUBLIC__js/idangerous.swiper.min.js"></script>
			
			<script type="text/javascript" src="__PUBLIC__js/member.js"></script>
			
			<?php endif; endif; ?>
		
		<script type="text/javascript" src="__PUBLIC__js/nav_logo.js"></script>
		
		
		<title>首页</title>

	</head>

	<body>

		<!--header-->

		<div class="header">

			<div class="header_top">

				<div class="container">

					<ul class="nav nav-pills">

						<li><a href="<?php echo url('wed/logins/index'); ?>">登录</a></li>

						<li><a href="<?php echo url('wed/logins/reg'); ?>">免费注册</a></li>

						<li><a href="<?php echo url('wed/logins/logout'); ?>">退出登录</a></li>

					</ul>

				</div>

			</div>

		</div>

		<!--header end-->

		

		<!--content-->

		<div class="content">

			<div class="container">

				<div class="logo">

					<a href="index.html">
					
						<img src="__PUBLIC__img/logo.png" alt="logo" class="img-responsive" />
						
					</a>

				</div>

				<div class="sm_nav navbar-header">

			        <button type="button" class="btn navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">

				        <span class="icon-style"></span>

				        <span class="icon-style"></span>

				        <span class="icon-style"></span>

			        </button>

			    </div>

				<div class="nav_first collapse navbar-collapse" id="example-navbar-collapse">
					
				
					<div class="nav_logo">
					
						<a href="/">
						
							<?php if(\think\Request::instance()->controller() == 'Home'): ?>
							
							<img src="__PUBLIC__img/logo.png" alt="logo" class="img-responsive" />
							
							<?php endif; if(\think\Request::instance()->controller() == 'Goods'): if(\think\Request::instance()->action() == 'index'): ?>
							
								<img src="__PUBLIC__img/logo_03.png" alt="logo_03" class="img-responsive" />
								
								<?php endif; if(\think\Request::instance()->action() == 'product_center'): ?>
							
								<img src="__PUBLIC__img/logo_02.png" alt="logo_02" class="img-responsive" />
								
								<?php endif; if(\think\Request::instance()->action() == 'cart'): ?>
							
								<img src="__PUBLIC__img/logo_05.png" alt="logo_05" class="img-responsive" />
							
								<?php endif; endif; if(\think\Request::instance()->controller() == 'Cart'): if(input('step') == ''): ?>
							
								<img src="__PUBLIC__img/logo_05.png" alt="logo_03" class="img-responsive" />
								
								<?php endif; if(input('step') == '3'): ?>
							
								<img src="__PUBLIC__img/logo_02.png" alt="logo_02" class="img-responsive" />
								
								<?php endif; if(input('step') == '4'): ?>
							
								<img src="__PUBLIC__img/logo_02.png" alt="logo_02" class="img-responsive" />
								
								<?php endif; endif; if(\think\Request::instance()->controller() == 'User'): if(\think\Request::instance()->action() == 'index'): ?>
							
								<img src="__PUBLIC__img/logo_05.png" alt="logo_03" class="img-responsive" />
								
								<?php endif; if(\think\Request::instance()->action() == 'address'): ?>
							
								<img src="__PUBLIC__img/logo_02.png" alt="logo_03" class="img-responsive" />
								
								<?php endif; endif; if(\think\Request::instance()->controller() == 'About'): if(\think\Request::instance()->action() == 'index'): ?>
								
								<img src="__PUBLIC__img/logo_02.png" alt="logo_02" class="img-responsive" />
								
								<?php endif; endif; if(\think\Request::instance()->controller() == 'Article'): ?>
								
								<img src="__PUBLIC__img/logo_02.png" alt="logo_02" class="img-responsive" />
								
							<?php endif; if(\think\Request::instance()->controller() == 'Message'): ?>
								
								<img src="__PUBLIC__img/logo_02.png" alt="logo_02" class="img-responsive" />
								
							<?php endif; ?>
							
						</a>
						
						
					</div>

					<ul class="nav navbar-nav">

						<li><a <?php if(\think\Request::instance()->controller() == 'Home'): ?>class="default"<?php endif; ?> href="\">首页</a></li>

						<li><a <?php if(\think\Request::instance()->controller() == 'About'): ?>class="default"<?php endif; ?> href="<?php echo url('wed/about/index'); ?>">品牌介绍</a></li>

						<li><a <?php if(\think\Request::instance()->controller() == 'Article'): ?>class="default"<?php endif; ?> href="<?php echo url('wed/article/index'); ?>">新闻中心</a></li>
						
						<li><a <?php if(\think\Request::instance()->controller() == 'Goods'): ?>class="default"<?php endif; ?> class="" href="<?php echo url('wed/goods/index'); ?>">产品中心</a></li>

						<li><a <?php if(\think\Request::instance()->controller() == 'Contact'): ?>class="default"<?php endif; ?> href="<?php echo url('wed/message/index'); ?>">联系我们</a></li>

						<li><a <?php if(\think\Request::instance()->controller() == 'User'): ?>class="default"<?php endif; ?> href="<?php echo url('wed/user/index'); ?>">个人中心</a></li>

					</ul>
					
				</div>
				<style>
				
					.ali{
						position:absolute;
						left: 90%;
						top: 40px;
					}
					
					.ali a:link{
						text-decoration:none;
					}
					
					.ali a:hover{
						text-decoration:none;
					}


					.ali span{
						//font-family:'宋体'; 
						//font-weight:bold;
						font-size:16px;
						position:relative;
						//color:#ff0062;
						color:#f74747;
						left:59px;
						top:-79px;
						display:block;
						width:35px;
						height:26px;
						line-height:26px;
						text-align:center;
					}

				</style>
				
				<div class="ali">
					<a href="<?php echo url('wed/cart/index'); ?>">
						
						<?php if(input('step') == '3'): ?>
						
						<img src="__PUBLIC__img/cart2.png" width="100px" height="80px" />
						
						<?php elseif(\think\Request::instance()->controller() == 'Article'): ?>
						
						<img src="__PUBLIC__img/cart2.png" width="100px" height="80px" />
						
						<?php elseif(\think\Request::instance()->controller() == 'Message'): ?>
						
						<img src="__PUBLIC__img/cart2.png" width="100px" height="80px" />
						
						<?php elseif(input('step') == '4'): ?>
						
						<img src="__PUBLIC__img/cart2.png" width="100px" height="80px" />
						
						<?php else: ?>
						
						<img src="__PUBLIC__img/cart.png" width="100px" height="80px" />
						
						<?php endif; ?>
						
						<span>0<span>
					</a>
				</div>
				
				<script>
				
					$(function(){
						$.post("<?php echo url('wed/cart/ajaxGetCount'); ?>", {}, function(data){
							$('.ali span').html(data.count);
						}, 'json');
					});
					
				</script>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				

	<div class="member_center">
		<div class="row">
			<div class="subnav col-sm-2">
				<ul class="text_list">
					<li class="title">全部功能</li>
					<li><a href="<?php echo url('wed/cart/index'); ?>">我的购物车</a></li>
					<li><a href="javascript:;" onclick="purchase(this, 1)">已买到的服装</a></li>
					<li class="move_color"><a href="<?php echo url('wed/user/personal'); ?>">个人信息</a></li>
					<li><a href="<?php echo url('wed/user/address'); ?>">收货地址</a></li>
					<li><a href="<?php echo url('wed/user/personal'); ?>">修改密码</a></li>
				</ul>
			</div>
			<div class="col-sm-10">
				<div class="single_message">
					<a class="portrait" href="javascript:;"><img class="img-responsive" src="<?php echo $data['image']; ?>" alt="single_portrait" /></a>
					<div class="right_text">
						<h4><?php echo $data['username']; ?></h4>
						<p>手机已绑定 <?php echo $data['phone']; ?> <a href="<?php echo url('wed/user/personal'); ?>" style="color:#f74747;">修改</a></p>
						<a href="<?php echo url('wed/user/address'); ?>">我的收货地址</a>
					</div>
				</div>
				<div class="other_text">
					<a href="javascript:;" onclick="obligation(this, 0)">待付款</a>
					<a href="javascript:;" onclick="obligation(this, 1)">待发货</a>
					<a href="javascript:;" onclick="obligation(this, 2)">待收货</a>
					<a href="javascript:;" onclick="obligation(this, 3)">待评价</a>
					<a href="javascript:;" onclick="obligation(this, 4)">退款</a>
				</div>
				<div class="seen">
					<p>我看过的</p>
					<div class="listpic">
					
						<ul>
						
							<?php if(is_array($seenData) || $seenData instanceof \think\Collection || $seenData instanceof \think\Paginator): if( count($seenData)==0 ) : echo "" ;else: foreach($seenData as $key=>$seenValue): ?>
							
							<li>
							
								<a href="<?php echo url('wed/goods/product_center', ['id' => $seenValue['id']]); ?>">
								
									<img class="img-responsive"src="\<?php echo $seenValue['image']; ?>" alt="seen_product" style="width:156px;height:175px;"/>
									
								</a>
								
							</li>
							
							<?php endforeach; endif; else: echo "" ;endif; ?>
							
						</ul>
						
					</div>
					<a class="prev_switch" href="###"><img class="img-responsive"src="__PUBLIC__img/prev_switch.png" alt="prev_switch" /></a>
					<a class="next_switch" href="###"><img class="img-responsive"src="__PUBLIC__img/next_switch.png" alt="next_switch" /></a>
				</div>
			</div>
			<div class="like col-sm-12">
				<p>我可能喜欢的</p>
				<ul>
				
					<?php if(is_array($likeData) || $likeData instanceof \think\Collection || $likeData instanceof \think\Paginator): if( count($likeData)==0 ) : echo "" ;else: foreach($likeData as $key=>$likeValue): ?>
					
					<li><a href="<?php echo url('wed/goods/product_center', ['id' => $likeValue['id']]); ?>"><img class="img-responsive"src="\<?php echo $likeValue['image']; ?>" alt="seen_product" style="width:186px;height:176px;" /></a></li>
					
					<?php endforeach; endif; else: echo "" ;endif; ?>
					
				</ul>
			</div>
		</div>
	</div>
</div>
</div>
<!--content end-->


<script>

	// 待
	function obligation(obj, status)
	{
		
		$.post("<?php echo url('wed/user/obligation'); ?>", {status : status}, function(data){
		
			if(data.code === 0)
			{
				layer.msg(data.msg);
				return false;
			}
			
			$('.seen p').html(data.title);
			
			$('.listpic ul').html(data.html);
		
		});
	}
	
	// 买
	function purchase(obj, status)
	{
		
		$.post("<?php echo url('wed/user/purchase'); ?>", {status : status}, function(data){
		
			if(data.code === 0)
			{
				layer.msg(data.msg);
				return false;
			}
			
			$('.seen p').html(data.title);
			
			$('.listpic ul').html(data.html);
		
		});
	}

	$('.text_list li').click(function(){
	
		$(this).addClass('move_color').siblings().removeClass('move_color');
	
	});
	
</script>






















		<!--footer-->

		<div class="footer">

			<div class="container">

				
				<div class="row">

					<div class="text_position list_text col-xs-4 col-sm-4 col-md-3">

						<h4>公司地址</h4>

						<p><?php echo $companyData['address']; ?></p>

					</div>

					<div class="list_text col-xs-2 col-sm-2 col-md-2">

						<h4>公司电话</h4>

						<p><?php echo $companyData['phone']; ?></p>

					</div>

					<div class="list_text col-xs-3 col-sm-3 col-md-2">

						<h4>公司emali</h4>

						<p><?php echo $companyData['email']; ?></p>

					</div>

					<div class="list_text col-xs-3 col-sm-3 col-md-2">

						<h4>jhv自媒体平台</h4>

						<ul>

							<li class="pull-left"><a href="###"><img src="__PUBLIC__img/icon_01.png" alt="icon_01" /></a></li>

							<li class="pull-left"><a href="###"><img src="__PUBLIC__img/icon_02.png" alt="icon_01" /></a></li>

						</ul>

					</div>

					<div class="col-xs-12 col-sm-12 col-md-3">

						<span class="footer_text">© JHV中国官网. All rights reserved.</span>

					</div>

				</div>


			</div>

		</div>

		<!--footer end-->

	</body>

	<?php if(\think\Request::instance()->controller() == 'Goods'): ?>
		
		<!-- 产品中心 -->
		<?php if(\think\Request::instance()->action() == 'cart'): ?>

		<script type="text/javascript" src="__PUBLIC__js/shopping_cart-2.js"></script>
		
		<?php endif; endif; ?>
	
	
	<!--[if lte IE 9]>

		<script src="js/respond.min.js"></script>

		<script src="js/html5shiv.min.js"></script>

	<![endif]-->

</html>


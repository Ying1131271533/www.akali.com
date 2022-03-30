<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:67:"D:\Web\www.akali.com\public/../application/wed\view\home\index.html";i:1513065302;s:69:"D:\Web\www.akali.com\public/../application/wed\view\layout\index.html";i:1605784317;s:70:"D:\Web\www.akali.com\public/../application/wed\view\layout\header.html";i:1567406591;s:70:"D:\Web\www.akali.com\public/../application/wed\view\layout\footer.html";i:1553067673;}*/ ?>
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
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				

	<div class="text">

		<div class="row">

			<div class="text-left col-sm-3">

				<ul class="nav">

					<li><a href="<?php echo url('wed/goods/index'); ?>" style="background-color: rgb(192, 180, 162);">产品推介</a></li>

					<li class="default" style="background-color: rgb(58, 109, 132);"><a href="<?php echo url('wed/about/index'); ?>">关于JHV</a></li>

					<li><a href="<?php echo url('wed/article/index'); ?>" style="background-color: rgb(58, 109, 132);">旗下品牌</a></li>

					<li><a href="<?php echo url('wed/message/index'); ?>" style="background-color: rgb(115, 55, 55);">招商加盟</a></li>

					<li><a href="<?php echo url('wed/about/index'); ?>" style="background-color: rgb(115, 55, 55);">社会责任</a></li>

					<li><a href="<?php echo url('wed/user/index'); ?>" style="background-color: rgb(192, 180, 162);">个人中心</a></li>

				</ul>

			</div>

			<div class="col-sm-9 col-xs-12">

				<a href="<?php echo url('wed/goods/index'); ?>"><img class="img-responsive" src="__PUBLIC__img/banner.png" alt="banner"></a>

			</div>

		</div>

	</div>

</div>

<div class="search">

	<form name="form" action="<?php echo url('wed/goods/index'); ?>" method="get">

		<div class="search_text input-group">

			<span class="input-group-btn dropup">

				<button class="btn btn-default dropdown-toggle btn-md" data-toggle="dropdown" type="button">搜品牌</button>

				<ul class="dropdown-menu akali" role="menu">

					<?php if(is_array($brand_name) || $brand_name instanceof \think\Collection || $brand_name instanceof \think\Paginator): if( count($brand_name)==0 ) : echo "" ;else: foreach($brand_name as $key=>$value): ?>
					
					<li><a href="javascript:;" onclick="brand(this)"><?php echo $value; ?></a></li>
					
					<?php endforeach; endif; else: echo "" ;endif; ?>

				</ul>

			</span>

			<input type="text" class="form-control input-md" name="keywords"/>

			<span class="input-group-btn">

				<button class="btn btn-default btn-md search_button" type="sbumit" style="color:#fff;">搜索</button>

			</span>

		</div>

	</form>

</div>

</div>

<!--content end-->

<script>
	
	function brand(obj)
	{
		var brand_name = $(obj).html();
		
		$('input[name="keywords"]').val(brand_name);
	}
	
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


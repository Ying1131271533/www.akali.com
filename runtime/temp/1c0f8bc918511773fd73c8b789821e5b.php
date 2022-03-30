<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:68:"D:\Web\www.akali.com\public/../application/wed\view\goods\index.html";i:1489582526;s:69:"D:\Web\www.akali.com\public/../application/wed\view\layout\index.html";i:1605784317;s:70:"D:\Web\www.akali.com\public/../application/wed\view\layout\header.html";i:1567406591;s:70:"D:\Web\www.akali.com\public/../application/wed\view\layout\footer.html";i:1553067673;}*/ ?>
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
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
			<div class="place">

					<p>当前位置</p>

					<img src="__PUBLIC__img/icon_place.png" />

					<p><a href="product.html">产品中心</a></p>

				</div>
				
				<div class="product">

					<div class="row">

						<div class="col-md-9">
							
							<div class="subnav">

								<ul class="akali">

									<?php if(is_array($categoryNav) || $categoryNav instanceof \think\Collection || $categoryNav instanceof \think\Paginator): if( count($categoryNav)==0 ) : echo "" ;else: foreach($categoryNav as $key=>$cateValue): ?>
									
									<li <?php if(! empty($delai_cate_id) && $cateValue['id'] == $delai_cate_id): ?> class="default_styel" <?php endif; ?> >
									
										<a date-cate_id="<?php echo $cateValue['id']; ?>" href="javascript:;"><?php echo $cateValue['cate_name']; ?></a>
										<input type="hidden" value="<?php echo $cateValue['id']; ?>">
										
									</li>
									
									<?php endforeach; endif; else: echo "" ;endif; ?>

								</ul>

							</div>
				
							<script></script>
							
							<style>
								.dropdown > ul > li{
									position:relative;
								}
								
								.dropdown > ul > li ul > li{
									position:relative;
								}
								
								.dropdown-menu li a{
									display: block;
									padding: 3px 20px;
									clear: both;
									font-weight: normal;
									line-height: 1.42857143;
									color: #333;
									white-space: nowrap;
								}
								
								.dropdown > ul > li ul{
									position:absolute;
									left:172px;
									top:0;
									display: none;
								}
								
								.product .xs_nav li a{
									background:#ccc;
								}

							</style>

							<div class="xs_nav input-group">

								<span class="input-group-btn dropdown ruiwen">
								
									<button class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button">服装类型</button>
									
									<?php echo $headerNavHtml; ?>
									
								</span>

							</div>

							<div class="swiper-container">

	  							<div class="swiper-wrapper">
								
									<div class="swiper-slide"><a href="<?php echo url('wed/goods/product_center'); ?>"><img src="__PUBLIC__img/product_pic_05.png" alt="product_pic_05.png" /></a></div>

								    <div class="swiper-slide"><a href="<?php echo url('wed/goods/product_center'); ?>"><img src="__PUBLIC__img/product_pic_03.png" alt="product_pic_03.png" /></a></div>

								    <div class="swiper-slide"><a href="<?php echo url('wed/goods/product_center'); ?>"><img src="__PUBLIC__img/product_pic_02.png" alt="product_pic_02.png" /></a></div>

							  	</div>

							</div>

							<div class="show_image">

								<ul>
								
									<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$goodsValue): ?>
									
									<li>

										<a href="<?php echo url('wed/goods/product_center', ['id' => $goodsValue['id']]); ?>">

										<img class="img-responsive" src="/<?php echo $goodsValue['image']; ?>" alt="<?php echo $goodsValue['image']; ?>" />

										</a>
										
									</li>
									
									<?php endforeach; endif; else: echo "" ;endif; ?>

								</ul>

								<a class="pre_show" href="###"><img src="__PUBLIC__img/icon_pre.png" alt="icon_pre" /></a>

								<a class="next_show" href="###"><img src="__PUBLIC__img/icon_next.png" alt="icon_next" /></a>

							</div>

							<a class="add" href="<?php echo url('wed/goods/cart'); ?>">加入购物车</a>

						</div>

						<div class="col-md-3">

							<img src="__PUBLIC__img/product_pic_01.png" alt="profuct_pic_01" />

						</div>

					</div>

				</div>

			</div>

		</div>	

		<!--content end-->
		
		<script>
		
		$('.akali a').click(function(){
			
			var cate_id = $(this).next().val();
			
			//alert(cate_id);
		
			$.post('<?php echo url("ajaxgoodsimge"); ?>', {cate_id : cate_id}, function(data){
				$('.show_image ul').html(data);
			}, 'html');
			
		});
		
		$('.dropdown a').click(function(){
			
			var cate_id = $(this).next().val();
			
			//alert(cate_id);
		
			$.post('<?php echo url("ajaxgoodsimge"); ?>', {cate_id : cate_id}, function(data){
				$('.show_image ul').html(data);
			}, 'html');
			
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


<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:77:"D:\Web\www.akali.com\public/../application/wed\view\goods\product_center.html";i:1489469704;s:69:"D:\Web\www.akali.com\public/../application/wed\view\layout\index.html";i:1605784317;s:70:"D:\Web\www.akali.com\public/../application/wed\view\layout\header.html";i:1567406591;s:70:"D:\Web\www.akali.com\public/../application/wed\view\layout\footer.html";i:1553067673;}*/ ?>
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

			<img src="__PUBLIC__img/icon_place_02.png" alt="icon_place_02" />

			<p><a href="<?php echo url('wed/goods/index'); ?>">产品中心</a></p>
			
			<?php if(! empty($cateParent)): ?>
			
			<img src="__PUBLIC__img/icon_place_02.png" alt="icon_place_02" />

			<p><a href="<?php echo url('wed/goods/index', ['category_id' => $cateParent['cid']]); ?>"><?php echo $cateParent['cate_name']; ?></a></p>
			
			<?php endif; ?>
			
			<img src="__PUBLIC__img/icon_place_02.png" alt="icon_place_02" />

			<p><?php echo $goods['goods_name']; ?></p>

		</div>

		<div class="center_show">

			<div class="row">

				<div class="col-md-2 col-xs-12">

					<div class="subnav">
						
						<ul>
						
							<?php if(is_array($categoryNav) || $categoryNav instanceof \think\Collection || $categoryNav instanceof \think\Paginator): if( count($categoryNav)==0 ) : echo "" ;else: foreach($categoryNav as $k=>$value): ?>
							
							<li <?php if(! empty($cateParent) && $cateParent['cid'] == $value['id']): ?> class="default_style" <?php endif; ?> ><a href="<?php echo url('wed/goods/index', ['category_id' => $value['id']]); ?>"><?php echo $value['cate_name']; ?></a></li>
							
							<?php endforeach; endif; else: echo "" ;endif; ?>

						</ul>

					</div>
					

				</div>
				
				<form action="" method="post" name="form">
				
					<div class="col-md-10 col-sm-12 col-xs-12">

						<div class="product_show" style="height:430px;">

							<div class="show_top">

								<div class="show_img">

									<img src="/<?php echo $goods['image']; ?>" alt="<?php echo $goods['image']; ?>" />

								</div>

								<div class="show_text">

									<h4><?php echo $goods['goods_name']; ?></h4>

									<div class="price">

										<p>价格 ¥ &nbsp;<strike><?php echo $goods['market_price']; ?></strike></p>

										<span>

											<i>1342</i><br />

											交易成功

										</span>

										<h2><i>¥</i>&nbsp;&nbsp;<?php echo $goods['shop_price']; ?></h2>

									</div>
									
									
									<?php foreach($spec as $specKey => $specValue): ?>
									
									<p class="spec-item">

										<i><?php echo $specKey; ?></i>
										
										<?php foreach($specValue as $itemKey => $itemValue): ?>
										
										<span <?php if($itemKey == '0'): ?>class="akali"<?php endif; ?>><?php echo $itemValue['item_name']; ?></span>
										
										<input type="hidden" name="spec_<?php echo $itemValue['spec_id']; ?>" value="<?php echo $itemValue['item_id']; ?>">
										
										<?php endforeach; ?>
										
									</p>
									
									<?php endforeach; ?>
									
									<!-- <p>

										<i><?php echo htmlspecialchars_decode($goods['desc']['content']); ?></i>
										
									</p> -->
									
									<div class="cart_div">
										<span class="numSub"></span>
										<input type="" class="numValue" name="cart_number" value="1">
										<span class="numAdd"></span>
									</div>
									<div style="overflow:hidden;">
										<a class="shopping" href="javascript:;" onclick="buy(<?php echo $goods['id']; ?>)" >立即购买</a>
										
										<a class="shopping akali_cart" href="javascript:;" onclick="add_cart(<?php echo $goods['id']; ?>)" >加入购物车</a>
									</div>	
									
								</div>

							</div>
<!-- 
							<p class="title">自由搭配</p>

							<div class="show_bottom">

								<div class="image">

									<ul>
										
										<?php if(is_array($goods['imgs']) || $goods['imgs'] instanceof \think\Collection || $goods['imgs'] instanceof \think\Paginator): if( count($goods['imgs'])==0 ) : echo "" ;else: foreach($goods['imgs'] as $key=>$photoValue): ?>
											
											<li><a href="product_center.html"><img src="/<?php echo $photoValue['path']; ?>" alt="<?php echo $photoValue; ?>" width="123px" height="109px" /></a></li>
											
										<?php endforeach; endif; else: echo "" ;endif; ?>
										
									</ul>

								</div>

								<div class="button">

									<a class="pay" href="shopping_cart.html">立即购买</a>

									<a class="add" href="javascript:;" onclick="add_cart(<?php echo $goods['id']; ?>)" >加入购物车</a>

								</div>

							</div>

							<div class="xs_button">

								<a class="xs_pay" href="shopping_cart.html">立即购买</a>

								<a class="xs_pay" href="javascript:;" onclick="add_cart(<?php echo $goods['id']; ?>)" >加入购物车</a>

							</div>
 -->
						</div>

					</div>
				
				</form>
				
			</div>

		</div>

	</div>

</div>

<!--content end-->

<script>
	
	$(function(){
			
		get_spec_price();
			
		$('.spec-item span').click(function(){
		
			$(this).addClass('akali').siblings().removeClass('akali');
			
				get_spec_price();
			
		});
		
	});
	
	// 立即购买
	function buy(goods_id)
	{
		var number = $('.numValue').val();
		var item_id = get_item_id();
		
		$.post("<?php echo url('wed/cart/add'); ?>", {goods_id : goods_id, item_id : item_id, number : number}, function(data){
			
			if(data.code == 0)
			{
				layer.msg(data.msg, {icon:2});
				return false;
			}
			
			window.location.href = "<?php echo url('wed/cart/index'); ?>";
			
		}, 'json');
	}
	
	// 添加购物车
	function add_cart(goods_id)
	{
		var number = $('.numValue').val();
		var item_id = get_item_id();
		
		$.post("<?php echo url('wed/cart/add'); ?>", {goods_id : goods_id, item_id : item_id, number : number}, function(data){
			
			if(data.code == 0)
			{
				layer.msg(data.msg, {icon:2});
				return false;
			}
			
			layer.msg('购物车添加成功', {icon:1});
			$('.ali span').html(data.count);
			
		}, 'json');
	}
	
	function get_item_id()
	{
		var item_id = [];
		$('.spec-item .akali').next().each(function(){
			item_id.push($(this).val());
		});
		
		return item_id.join('_');
	}
	
	function get_spec_price()
	{
		var item_id = get_item_id()
		
		//item_id = item_id.split('_');//字符串分割数组
		
		$.post("<?php echo url('wed/goods/ajaxgetspecprice'); ?>", {item_id : item_id, goods_id : <?php echo $goods['id']; ?>}, function(data){
			
			if(data.code == 1)
			{
				$('.price h2').html("<i>¥</i>&nbsp;&nbsp;" + data.spec_price);
			}
			
		},'json');
	}
	
	$('.numSub').click(function(){
		var inp_number = $('.numValue').val();
		inp_number--;
		if($('.numValue').val() > 1)
		{
			$('.numValue').val(inp_number);
		}
		
	});
	
	$('.numAdd').click(function(){
		var inp_number = $('.numValue').val();
		inp_number++;
		if($('.numValue').val() < 999)
		{
			$('.numValue').val(inp_number);
		}
		
	});
	
	
/*	
	$('.spec-item span').hover(function(){
		$(this).addClass('akali');
	},function(){
		$(this).removeClass('akali');
		
		var akali = $(this).siblings().hasClass('aklai');
		alert(akali);
		var thisaklai = $(this).hasClass('aklai');
		alert(thisaklai);
		if(akali == false && thisaklai == false)
		{
			$(this).addClass('akali');
		}
	});
*/
	
	
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


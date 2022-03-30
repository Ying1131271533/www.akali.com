<?php
//000000000000s:13059:"<!DOCTYPE html>

<html>

	<head>

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
		
		<link rel="icon" href="/static/wed/img/chuyin.ico"/>
		
		<!--------------------- css ----------------------->

		<link rel="stylesheet" href="/static/wed/css/bootstrap.css">
			
				
		<!-- 品牌介绍 -->
		
				
		
		<!-- 联系我们 -->
		
				
		<!-- 新闻中心 -->
		
				
			<!-- 产品中心 -->
			
			<link rel="stylesheet" href="/static/wed/css/product_center.css" />
			
					
		<!--  用户中心 -->
				
		<!--------------------- javascipt ----------------------->
		
		
		<script type="text/javascript" src="/static/wed/js/jquery-1.11.0.js"></script>

		<script type="text/javascript" src="/static/wed/js/bootstrap.js"></script>
		
		<script type="text/javascript" src="/static/wed/js/common.js"></script>
		
		<script type="text/javascript" src="/static/wed/js/layer.js"></script>
	
		<!-- 产品中心 -->
		
				
		<!-- 新闻中心 -->
		
				
		<!-- 联系我们 -->
		
				
		<!-- 购物车 -->
		
				
		<!-- 用户中心 -->
		
				
		<script type="text/javascript" src="/static/wed/js/nav_logo.js"></script>
		
		
		<title>首页</title>

	</head>

	<body>

		<!--header-->

		<div class="header">

			<div class="header_top">

				<div class="container">

					<ul class="nav nav-pills">

						<li><a href="http://www.akali.com/logins/index.html">登录</a></li>

						<li><a href="http://www.akali.com/logins/reg.html">免费注册</a></li>

						<li><a href="http://www.akali.com/logins/logout.html">退出登录</a></li>

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
					
						<img src="/static/wed/img/logo.png" alt="logo" class="img-responsive" />
						
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
						
														
								<img src="/static/wed/img/logo_02.png" alt="logo_02" class="img-responsive" />
								
															
						</a>
						
						
					</div>

					<ul class="nav navbar-nav">

						<li><a  href="\">首页</a></li>

						<li><a  href="http://www.akali.com/about/index.html">品牌介绍</a></li>

						<li><a  href="http://www.akali.com/article/index.html">新闻中心</a></li>
						
						<li><a class="default" class="" href="http://www.akali.com/goods/index.html">产品中心</a></li>

						<li><a  href="http://www.akali.com/message/index.html">联系我们</a></li>

						<li><a  href="http://www.akali.com/user/index.html">个人中心</a></li>

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
					<a href="http://www.akali.com/cart/index.html">
						
												
						<img src="/static/wed/img/cart.png" width="100px" height="80px" />
						
												
						<span>0<span>
					</a>
				</div>
				
				<script>
				
					$(function(){
						$.post("http://www.akali.com/cart/ajaxgetcount.html", {}, function(data){
							$('.ali span').html(data.count);
						}, 'json');
					});
					
				</script>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
	
		<div class="place">

			<p>当前位置</p>

			<img src="/static/wed/img/icon_place_02.png" alt="icon_place_02" />

			<p><a href="http://www.akali.com/goods/index.html">产品中心</a></p>
			
						
			<img src="/static/wed/img/icon_place_02.png" alt="icon_place_02" />

			<p><a href="http://www.akali.com/goods/index/category_id/18.html">女装</a></p>
			
						
			<img src="/static/wed/img/icon_place_02.png" alt="icon_place_02" />

			<p>红色</p>

		</div>

		<div class="center_show">

			<div class="row">

				<div class="col-md-2 col-xs-12">

					<div class="subnav">
						
						<ul>
						
														
							<li  class="default_style"  ><a href="http://www.akali.com/goods/index/category_id/18.html">女装</a></li>
							
														
							<li  ><a href="http://www.akali.com/goods/index/category_id/19.html">男装</a></li>
							
														
							<li  ><a href="http://www.akali.com/goods/index/category_id/22.html">哥特式</a></li>
							
														
							<li  ><a href="http://www.akali.com/goods/index/category_id/26.html">韩式</a></li>
							
														
							<li  ><a href="http://www.akali.com/goods/index/category_id/27.html">潮流前线</a></li>
							
							
						</ul>

					</div>
					

				</div>
				
				<form action="" method="post" name="form">
				
					<div class="col-md-10 col-sm-12 col-xs-12">

						<div class="product_show" style="height:430px;">

							<div class="show_top">

								<div class="show_img">

									<img src="/uploads/20170318/f377cf4de09167eadf81290fdff9f924.jpg" alt="uploads/20170318/f377cf4de09167eadf81290fdff9f924.jpg" />

								</div>

								<div class="show_text">

									<h4>红色</h4>

									<div class="price">

										<p>价格 ¥ &nbsp;<strike>3800</strike></p>

										<span>

											<i>1342</i><br />

											交易成功

										</span>

										<h2><i>¥</i>&nbsp;&nbsp;3500</h2>

									</div>
									
									
																		
									<p class="spec-item">

										<i>颜色</i>
										
																				
										<span class="akali">黑色</span>
										
										<input type="hidden" name="spec_7" value="3">
										
																				
										<span >白色</span>
										
										<input type="hidden" name="spec_7" value="4">
										
																				
									</p>
									
																		
									<!-- <p>

										<i><p>										</p><p>..</p><p>										</p></i>
										
									</p> -->
									
									<div class="cart_div">
										<span class="numSub"></span>
										<input type="" class="numValue" name="cart_number" value="1">
										<span class="numAdd"></span>
									</div>
									<div style="overflow:hidden;">
										<a class="shopping" href="javascript:;" onclick="buy(13)" >立即购买</a>
										
										<a class="shopping akali_cart" href="javascript:;" onclick="add_cart(13)" >加入购物车</a>
									</div>	
									
								</div>

							</div>
<!-- 
							<p class="title">自由搭配</p>

							<div class="show_bottom">

								<div class="image">

									<ul>
										
																					
											<li><a href="product_center.html"><img src="/uploads/20170215/59dada2039e755f8bf47134dc6575d59.jpg" alt="{"id":98,"path":"uploads\/20170215\/59dada2039e755f8bf47134dc6575d59.jpg","goods_id":13}" width="123px" height="109px" /></a></li>
											
																					
											<li><a href="product_center.html"><img src="/uploads/20170215/d05219499e151c5d72186ae9dd40c20d.jpg" alt="{"id":99,"path":"uploads\/20170215\/d05219499e151c5d72186ae9dd40c20d.jpg","goods_id":13}" width="123px" height="109px" /></a></li>
											
																					
											<li><a href="product_center.html"><img src="/uploads/20170215/393fa621954c851333c270178743ee6d.jpg" alt="{"id":100,"path":"uploads\/20170215\/393fa621954c851333c270178743ee6d.jpg","goods_id":13}" width="123px" height="109px" /></a></li>
											
																				
									</ul>

								</div>

								<div class="button">

									<a class="pay" href="shopping_cart.html">立即购买</a>

									<a class="add" href="javascript:;" onclick="add_cart(13)" >加入购物车</a>

								</div>

							</div>

							<div class="xs_button">

								<a class="xs_pay" href="shopping_cart.html">立即购买</a>

								<a class="xs_pay" href="javascript:;" onclick="add_cart(13)" >加入购物车</a>

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
		
		$.post("http://www.akali.com/cart/add.html", {goods_id : goods_id, item_id : item_id, number : number}, function(data){
			
			if(data.code == 0)
			{
				layer.msg(data.msg, {icon:2});
				return false;
			}
			
			window.location.href = "http://www.akali.com/cart/index.html";
			
		}, 'json');
	}
	
	// 添加购物车
	function add_cart(goods_id)
	{
		var number = $('.numValue').val();
		var item_id = get_item_id();
		
		$.post("http://www.akali.com/cart/add.html", {goods_id : goods_id, item_id : item_id, number : number}, function(data){
			
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
		
		$.post("http://www.akali.com/goods/ajaxgetspecprice.html", {item_id : item_id, goods_id : 13}, function(data){
			
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

						<p>北京市海淀区北洼路9号院2号楼</p>

					</div>

					<div class="list_text col-xs-2 col-sm-2 col-md-2">

						<h4>公司电话</h4>

						<p>010-88583263</p>

					</div>

					<div class="list_text col-xs-3 col-sm-3 col-md-2">

						<h4>公司emali</h4>

						<p>JHV168@163.com</p>

					</div>

					<div class="list_text col-xs-3 col-sm-3 col-md-2">

						<h4>jhv自媒体平台</h4>

						<ul>

							<li class="pull-left"><a href="###"><img src="/static/wed/img/icon_01.png" alt="icon_01" /></a></li>

							<li class="pull-left"><a href="###"><img src="/static/wed/img/icon_02.png" alt="icon_01" /></a></li>

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

			
		<!-- 产品中心 -->
			
	
	<!--[if lte IE 9]>

		<script src="js/respond.min.js"></script>

		<script src="js/html5shiv.min.js"></script>

	<![endif]-->

</html>

";
?>
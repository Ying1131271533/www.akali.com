<?php
//000000000000s:12214:"<!DOCTYPE html>

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
						
			<link rel="stylesheet" href="/static/wed/css/idangerous.swiper.css">

			<link rel="stylesheet" href="/static/wed/css/product.css" />
			
					
		<!--  用户中心 -->
				
		<!--------------------- javascipt ----------------------->
		
		
		<script type="text/javascript" src="/static/wed/js/jquery-1.11.0.js"></script>

		<script type="text/javascript" src="/static/wed/js/bootstrap.js"></script>
		
		<script type="text/javascript" src="/static/wed/js/common.js"></script>
		
		<script type="text/javascript" src="/static/wed/js/layer.js"></script>
	
		<!-- 产品中心 -->
		
					
			<script type="text/javascript" src="/static/wed/js/product.js"></script>
		
			<script type="text/javascript" src="/static/wed/js/idangerous.swiper.min.js"></script>
			
					
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
						
														
								<img src="/static/wed/img/logo_03.png" alt="logo_03" class="img-responsive" />
								
															
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

					<img src="/static/wed/img/icon_place.png" />

					<p><a href="product.html">产品中心</a></p>

				</div>
				
				<div class="product">

					<div class="row">

						<div class="col-md-9">
							
							<div class="subnav">

								<ul class="akali">

																		
									<li  >
									
										<a date-cate_id="18" href="javascript:;">女装</a>
										<input type="hidden" value="18">
										
									</li>
									
																		
									<li  class="default_styel"  >
									
										<a date-cate_id="19" href="javascript:;">男装</a>
										<input type="hidden" value="19">
										
									</li>
									
																		
									<li  >
									
										<a date-cate_id="22" href="javascript:;">哥特式</a>
										<input type="hidden" value="22">
										
									</li>
									
																		
									<li  >
									
										<a date-cate_id="26" href="javascript:;">韩式</a>
										<input type="hidden" value="26">
										
									</li>
									
																		
									<li  >
									
										<a date-cate_id="27" href="javascript:;">潮流前线</a>
										<input type="hidden" value="27">
										
									</li>
									
									
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
									
									<ul><li><a href='javascript:;'>女装</a><input type='hidden' value='18'><ul><li><a href='javascript:;'>上衣</a><input type='hidden' value='1'><ul><li><a href='javascript:;'>衬衫</a><input type='hidden' value='2'><ul><li><a href='javascript:;'>西装衬衫</a><input type='hidden' value='8'></li><li><a href='javascript:;'>休闲衬衫</a><input type='hidden' value='9'><ul><li><a href='javascript:;'>白色衬衫</a><input type='hidden' value='32'></li></ul></li></ul></li></ul></li><li><a href='javascript:;'>裤子</a><input type='hidden' value='3'><ul><li><a href='javascript:;'>牛仔裤</a><input type='hidden' value='5'></li><li><a href='javascript:;'>运动裤</a><input type='hidden' value='16'></li><li><a href='javascript:;'>休闲裤</a><input type='hidden' value='17'></li><li><a href='javascript:;'>韩式裤</a><input type='hidden' value='21'></li></ul></li><li><a href='javascript:;'>鞋子</a><input type='hidden' value='6'><ul><li><a href='javascript:;'>板鞋</a><input type='hidden' value='7'></li><li><a href='javascript:;'>布鞋</a><input type='hidden' value='14'></li></ul></li></ul></li><li><a href='javascript:;'>男装</a><input type='hidden' value='19'></li><li><a href='javascript:;'>哥特式</a><input type='hidden' value='22'><ul><li><a href='javascript:;'>裙子</a><input type='hidden' value='28'></li><li><a href='javascript:;'>围巾</a><input type='hidden' value='30'><ul><li><a href='javascript:;'>蓝布围巾</a><input type='hidden' value='31'></li></ul></li></ul></li><li><a href='javascript:;'>韩式</a><input type='hidden' value='26'><ul><li><a href='javascript:;'>连衣裙</a><input type='hidden' value='29'></li></ul></li><li><a href='javascript:;'>潮流前线</a><input type='hidden' value='27'></li></ul>									
								</span>

							</div>

							<div class="swiper-container">

	  							<div class="swiper-wrapper">
								
									<div class="swiper-slide"><a href="http://www.akali.com/goods/product_center.html"><img src="/static/wed/img/product_pic_05.png" alt="product_pic_05.png" /></a></div>

								    <div class="swiper-slide"><a href="http://www.akali.com/goods/product_center.html"><img src="/static/wed/img/product_pic_03.png" alt="product_pic_03.png" /></a></div>

								    <div class="swiper-slide"><a href="http://www.akali.com/goods/product_center.html"><img src="/static/wed/img/product_pic_02.png" alt="product_pic_02.png" /></a></div>

							  	</div>

							</div>

							<div class="show_image">

								<ul>
								
									
								</ul>

								<a class="pre_show" href="###"><img src="/static/wed/img/icon_pre.png" alt="icon_pre" /></a>

								<a class="next_show" href="###"><img src="/static/wed/img/icon_next.png" alt="icon_next" /></a>

							</div>

							<a class="add" href="http://www.akali.com/goods/cart.html">加入购物车</a>

						</div>

						<div class="col-md-3">

							<img src="/static/wed/img/product_pic_01.png" alt="profuct_pic_01" />

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
		
			$.post('http://www.akali.com/goods/ajaxgoodsimge.html', {cate_id : cate_id}, function(data){
				$('.show_image ul').html(data);
			}, 'html');
			
		});
		
		$('.dropdown a').click(function(){
			
			var cate_id = $(this).next().val();
			
			//alert(cate_id);
		
			$.post('http://www.akali.com/goods/ajaxgoodsimge.html', {cate_id : cate_id}, function(data){
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
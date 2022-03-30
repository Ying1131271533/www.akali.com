<?php
//000000000000s:8741:"<!DOCTYPE html>

<html>

	<head>

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
		
		<link rel="icon" href="/static/wed/img/chuyin.ico"/>
		
		<!--------------------- css ----------------------->

		<link rel="stylesheet" href="/static/wed/css/bootstrap.css">
			
				
		<!-- 首页 -->	
					
			<link rel="stylesheet" href="/static/wed/css/index.css">
			
					
		<!-- 品牌介绍 -->
		
				
		
		<!-- 联系我们 -->
		
				
		<!-- 新闻中心 -->
		
				
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

						<li><a href="http://www.akali.com/wed/logins/index.html">登录</a></li>

						<li><a href="http://www.akali.com/wed/logins/reg.html">免费注册</a></li>

						<li><a href="http://www.akali.com/wed/logins/logout.html">退出登录</a></li>

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
						
														
							<img src="/static/wed/img/logo.png" alt="logo" class="img-responsive" />
							
														
						</a>
						
						
					</div>

					<ul class="nav navbar-nav">

						<li><a class="default" href="\">首页</a></li>

						<li><a  href="http://www.akali.com/wed/about/index.html">品牌介绍</a></li>

						<li><a  href="http://www.akali.com/wed/article/index.html">新闻中心</a></li>
						
						<li><a  class="" href="http://www.akali.com/wed/goods/index.html">产品中心</a></li>

						<li><a  href="http://www.akali.com/wed/message/index.html">联系我们</a></li>

						<li><a  href="http://www.akali.com/wed/user/index.html">个人中心</a></li>

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
					<a href="http://www.akali.com/wed/cart/index.html">
						
												
						<img src="/static/wed/img/cart.png" width="100px" height="80px" />
						
												
						<span>0<span>
					</a>
				</div>
				
				<script>
				
					$(function(){
						$.post("http://www.akali.com/wed/cart/ajaxgetcount.html", {}, function(data){
							$('.ali span').html(data.count);
						}, 'json');
					});
					
				</script>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				

	<div class="text">

		<div class="row">

			<div class="text-left col-sm-3">

				<ul class="nav">

					<li><a href="http://www.akali.com/wed/goods/index.html" style="background-color: rgb(192, 180, 162);">产品推介</a></li>

					<li class="default" style="background-color: rgb(58, 109, 132);"><a href="http://www.akali.com/wed/about/index.html">关于JHV</a></li>

					<li><a href="http://www.akali.com/wed/article/index.html" style="background-color: rgb(58, 109, 132);">旗下品牌</a></li>

					<li><a href="http://www.akali.com/wed/message/index.html" style="background-color: rgb(115, 55, 55);">招商加盟</a></li>

					<li><a href="http://www.akali.com/wed/about/index.html" style="background-color: rgb(115, 55, 55);">社会责任</a></li>

					<li><a href="http://www.akali.com/wed/user/index.html" style="background-color: rgb(192, 180, 162);">个人中心</a></li>

				</ul>

			</div>

			<div class="col-sm-9 col-xs-12">

				<a href="http://www.akali.com/wed/goods/index.html"><img class="img-responsive" src="/static/wed/img/banner.png" alt="banner"></a>

			</div>

		</div>

	</div>

</div>

<div class="search">

	<form name="form" action="http://www.akali.com/wed/goods/index.html" method="get">

		<div class="search_text input-group">

			<span class="input-group-btn dropup">

				<button class="btn btn-default dropdown-toggle btn-md" data-toggle="dropdown" type="button">搜品牌</button>

				<ul class="dropdown-menu akali" role="menu">

										
					<li><a href="javascript:;" onclick="brand(this)">1</a></li>
					
										
					<li><a href="javascript:;" onclick="brand(this)">2016夏新款男装韩版网纱七分袖短</a></li>
					
										
					<li><a href="javascript:;" onclick="brand(this)">3</a></li>
					
										
					<li><a href="javascript:;" onclick="brand(this)">1970-01-01 08:00:00</a></li>
					
										
					<li><a href="javascript:;" onclick="brand(this)">3051</a></li>
					
										
					<li><a href="javascript:;" onclick="brand(this)">2500</a></li>
					
										
					<li><a href="javascript:;" onclick="brand(this)">uploads/20170318/b9f3ef35536bfbbecfb78f6135a1ce12.jpg</a></li>
					
										
					<li><a href="javascript:;" onclick="brand(this)">1</a></li>
					
										
					<li><a href="javascript:;" onclick="brand(this)">1</a></li>
					
					
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

		
	
	<!--[if lte IE 9]>

		<script src="js/respond.min.js"></script>

		<script src="js/html5shiv.min.js"></script>

	<![endif]-->

</html>

";
?>
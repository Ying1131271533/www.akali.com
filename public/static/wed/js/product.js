$(document).ready(function(){
	var bool=true;
	function pre_show(index){
		bool=false;
		$(".content .product .show_image ul li").eq(2).addClass("default_show").siblings().removeClass("default_show");
		$(".content .product .show_image ul").stop(true,true).animate({"margin-left": -index +"px"},1000,function(){
			$(".content .product .show_image ul li").eq(0).appendTo(".content .product .show_image ul");
			$(".content .product .show_image ul").css({"margin-left":"0px"});
			bool=true;
		});
	}
	function next_show(index){
		bool=false;
		$(".content .product .show_image ul li").eq(0).addClass("default_show").siblings().removeClass("default_show");
		$(".content .product .show_image ul li").last().prependTo(".content .product .show_image ul");
		$(".content .product .show_image ul").css({"margin-left": -index +"px"});
		$(".content .product .show_image ul").stop(true,true).animate({"margin-left":"0px"},1000,function(){bool=true;});
	}
	
	$(window).resize(function(){
		show();
	})
	var variable=0;
	show();
	function show(){
		var width=$(".content .container").width();
			if(width>=720 && width<1140){
				variable = 222;
			}else{
				variable = 272;
		}
	}
	$(".content .product .pre_show").click(function(){
		if(!bool){return;}
		pre_show(variable);
	});
	$(".content .product .next_show").click(function(){
		if(!bool){return;}
		next_show(variable);
	});
	
	$(".product .subnav li").click(function(){
		$(this).addClass('default_styel');
		$(this).siblings().removeClass('default_styel');
	})
	
	function autoshow(){
		var auto = setInterval(function(){
			if(!bool){return;}
			pre_show(variable);
		},3000);
	}
	autoshow();
		
	var mySwiper = new Swiper('.swiper-container',{
    	loop: true,
		autoplay: 3000,
  	});  	
		
	
})
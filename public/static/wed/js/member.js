$(document).ready(function(){
	var bool=true;
	function pre_show(index){
		bool=false;
		$(".content .listpic ul").stop(true,true).animate({"margin-left": -index +"px"},1000,function(){
			$(".content .listpic ul li").eq(0).appendTo(".content .listpic ul");
			$(".content .listpic ul").css({"margin-left":"0px"});
			bool=true;
		});
	}
	function next_show(index){
		bool=false;
		$(".content .listpic li").last().prependTo(".content .listpic ul");
		$(".content .listpic ul").css({"margin-left": -index +"px"});
		$(".content .listpic ul").stop(true,true).animate({"margin-left":"0px"},1000,function(){bool=true;});
	}
	
	$(window).resize(function(){
		show();
	})
	var variable=0;
	show();
	function show(){
		var width=$(".content .container").width();
			if(width == 720){
				variable = 132;
			}else if(width == 940){
				variable = 175;
			}
			else{
				variable = 218;
		}
	}
	$(".content .prev_switch").click(function(){
		if(!bool){return;}
		pre_show(variable);
	});
	$(".content .next_switch").click(function(){
		if(!bool){return;}
		next_show(variable);
	});
		
	var mySwiper = new Swiper('.swiper-container',{
    	loop: true,
		autoplay: 3000,
	});
})
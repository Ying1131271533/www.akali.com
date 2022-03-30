$(document).ready(function(){
	$(".content .text ul li").click(function(){
		$(this).addClass("default").siblings().removeClass("default");
	});
	
	var li = $(".text .text-left .nav li");
	li.eq(0).css({"background-color":"#c0b4a2"});
	li.eq(1).css({"background-color":"#3a6d84"});
	li.eq(2).css({"background-color":"#3a6d84"});
	li.eq(3).css({"background-color":"#733737"});
	li.eq(4).css({"background-color":"#733737"});
	li.eq(5).css({"background-color":"#c0b4a2"});
})

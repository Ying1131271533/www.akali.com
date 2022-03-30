$(document).ready(function(){
	function margin(){
		var width = window.innerWidth;
		if(width >= 992){
			$(".content .nav_first li").eq(3).css({"margin-left":"252"+"px"});
		}else if(width >= 768 ){
			$(".content .nav_first li").eq(3).css({"margin-left":"24"+"px"});
		}else{
			$(".content .nav_first li").eq(3).css({"margin-left":"9"+"px"});
		}
	}
	$(window).resize(function(){
		margin();
	});
	margin();
})

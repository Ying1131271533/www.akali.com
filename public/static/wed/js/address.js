$(document).ready(function(){/*
	$(".place_message").click(function(){
		$(this).addClass('default_massage');
		$(this).parent('li').siblings().children('.place_message').removeClass('default_massage');
	})*/
	
	$(".content .Invoice_message .choice").click(function(){
		var check = $(this).children('input').prop("checked");
		if(check){
			$(this).children('input').prop("checked",false);
			$(this).css({"background":"url(/static/wed/img/checkbox.jpg) no-repeat 0 center"});
			$(this).children('input').removeAttr("checked");
		}else{
			$(this).children('input').prop("checked",true);
			$(this).css({"background": "url(/static/wed/img/checked.jpg) no-repeat 0 center"});
			$(this).children('input').attr("checked","checked");
		}
	})
	
	$(".content .Invoice_message .Invoice_header").click(function(){
		var check = $(this).children('input').prop("checked");
		if(check){
			$(this).children('input').prop("checked",false);
			$(this).css({"background":"url(/static/wed/img/checkbox.jpg) no-repeat 0 center"});
			$(this).children('input').removeAttr("checked");
		}else{
			$(this).children('input').prop("checked",true);
			$(this).css({"background": "url(/static/wed/img/checked.jpg) no-repeat 0 center"});
			$(this).children('input').attr("checked","checked");
			
			$(this).siblings().children('input').prop("checked",false);
			$(this).siblings('.Invoice_header').css({"background": "url(/static/wed/img/checkbox.jpg) no-repeat 0 center"});
			$(this).siblings().children('input').removeAttr("checked");;
		}
	})
	
	$(".content .Invoice_message .Invoice_content").click(function(){
		var check = $(this).children('input').prop("checked");
		if(check){
			$(this).children('input').prop("checked",false);
			$(this).css({"background":"url(/static/wed/img/checkbox.jpg) no-repeat 0 center"});
			$(this).children('input').removeAttr("checked");
		}else{
			$(this).children('input').prop("checked",true);
			$(this).css({"background": "url(/static/wed/img/checked.jpg) no-repeat 0 center"});
			$(this).children('input').attr("checked","checked");
			
			$(this).siblings().children('input').prop("checked",false);
			$(this).siblings('.Invoice_content').css({"background": "url(/static/wed/img/checkbox.jpg) no-repeat 0 center"});
			$(this).siblings().children('input').removeAttr("checked");;
		}
	})
})

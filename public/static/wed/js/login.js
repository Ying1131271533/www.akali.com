$(document).ready(function(){
	$(".content .login_text .checked .checkbox-inline").click(function(){
		var check = $(this).children('input').prop("checked");
		if(check){
			$(this).children('input').prop("checked",false);
			$(this).css({"background":"url(/static/wed/img/checkbox.jpg) no-repeat 10px center"});
			$(this).children('input').removeAttr("checked");
		}else{
			$(this).children('input').prop("checked",true);
			$(this).css({"background": "url(/static/wed/img/checked.jpg) no-repeat 10px center"});
			$(this).children('input').attr("checked","checked");
		}
	})
	
})

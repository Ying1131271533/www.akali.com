$(document).ready(function () {
	$(".content .checkbox-inline").click(function(){
		$(this).css({'background':'url(/static/wed/img/checked.jpg) no-repeat right 0'});
		$(this).siblings().css({'background':'url(/static/wed/img/checkbox.jpg) no-repeat right 0'});
	});
});

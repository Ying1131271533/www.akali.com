$(document).ready(function(){
	var setnum;
	function setNum(obj){
		var num=document.getElementsByClassName("num");
		var reduce=document.getElementsByClassName("sub");
		var index = $(obj).parents('li').index();
		var className = $(obj)[0].className.substring(0,3);
		var count=parseInt(num[index].value);
		if(className == "add"){
			num[index].value = ++count;
			setnum = num[index].value;
			if(setnum > 1 ){
				reduce[index].removeAttribute("disabled");
			}
		}else{
			if(setnum <= 1 ){
				reduce[index].setAttribute("disabled","disabled");
				return ;
			}
			num[index].value = --count;
			setnum = num[index].value;
		}
		return setnum;
	}
	
	$('.add').click(function () {
		setNum(this);
	});
	
	$('.sub').click(function () {
		setNum(this);
	});
	
	var check = $(".content .checked_product");
	
	check.click(function(){
		var check = $(this).children('input').prop('checked');
		if (check) {
			$(this).children('input').prop("checked",false);
			$(this).css({"background":"url(img/checkbox.jpg) no-repeat 0 center"});
			$(this).children('input').removeAttr("checked","checked");
		} else {
			$(this).children('input').prop("checked",true);
			$(this).children('input').attr("checked","checked");
			$(this).css({"background":"url(img/checked.jpg) no-repeat 0 center"});
		}
		return false;
	});
})

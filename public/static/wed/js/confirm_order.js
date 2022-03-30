$(document).ready(function(e){
	var allcheck = $(".content .all_checked");
	var licheck = $(".content .checked_product");
	var xs_licheck = $(".content .xschecked_product");
	
	xs_licheck.click(function(e){
		if (isInput(e)) {
			return ;
		}
		
		var check = $(this).children('input').prop('checked');
		var all_check = $(".all_checked");
		
		if (check) {
			$(this).children('input').prop("checked",false);
			$(this).css({"background":"url(img/checkbox.jpg) no-repeat 0 center"});
			$(this).children('input').removeAttr("checked","checked");
		} else {
			$(this).children('input').prop("checked",true);
			$(this).children('input').attr("checked","checked");
			$(this).css({"background":"url(img/checked.jpg) no-repeat 0 center"});
		}
		
		setAllPrice(this);
		
		function isInput(e) {
			return e.target.__proto__ === HTMLInputElement;
		}
		
		function setCheck(check) {
			$(".content .checked_product input").prop("checked",check);
			if (check) {
				$(".content .checked_product input").attr("checked","checked");
			} else {
				$(".content .checked_product input").removeAttr("checked","checked");
			}	
		}
		return false;
	});
	
	licheck.click(function(e){
		if (isInput(e)) {
			return ;
		}
		
		var check = $(this).children('input').prop('checked');
		var all_check = $(".all_checked");
		
		if (check) {
			$(this).children('input').prop("checked",false);
			$(this).css({"background":"url(img/checkbox.jpg) no-repeat 0 center"});
			$(this).children('input').removeAttr("checked","checked");
		} else {
			$(this).children('input').prop("checked",true);
			$(this).children('input').attr("checked","checked");
			$(this).css({"background":"url(img/checked.jpg) no-repeat 0 center"});
		}
		
		setAllPrice(this);
		
		function isInput(e) {
			return e.target.__proto__ === HTMLInputElement;
		}
		
		function setCheck(check) {
			$(".content .checked_product input").prop("checked",check);
			if (check) {
				$(".content .checked_product input").attr("checked","checked");
			} else {
				$(".content .checked_product input").removeAttr("checked","checked");
			}	
		}
		return false;
	});
	
	allcheck.click(function(e){
		if (isInput(e)) {
			return ;
		}
		AllPri(this);
		
		var check = $(this).children('input').prop('checked');
		var li_check = $(".checked_product");
		
		if (check) {
			setCheck(false);
			allcheck.css({"background":"url(img/checkbox.jpg) no-repeat 0 center"});
			for(var i=0; i<li_check.length;i++){
				li_check.eq(i).css({"background":"url(img/checkbox.jpg) no-repeat 0 center"});
				xs_licheck.eq(i).css({"background":"url(img/checkbox.jpg) no-repeat 0 center"});
			}
		} else {
			setCheck(true);
			allcheck.css({"background":"url(img/checked.jpg) no-repeat 0 center"});
			for(var i=0; i<li_check.length;i++){
				li_check.eq(i).css({"background":"url(img/checked.jpg) no-repeat 0 center"});
				xs_licheck.eq(i).css({"background":"url(img/checked.jpg) no-repeat 0 center"});
			}
		}
		
		function isInput(e) {
			return e.target.__proto__ === HTMLInputElement;
		}
		
		function setCheck(check) {
			$(".content .checkbox-inline input").prop("checked",check);
			if (check) {
				$(".content .checkbox-inline input").attr("checked","checked");
				for(var i=0; i<li_check.length;i++){
					li_check.eq(i).children('input').attr("checked","checked");
					xs_licheck.eq(i).children('input').attr("checked","checked");
				}
			} else {
				$(".content .checkbox-inline input").removeAttr("checked","checked");
				for(var i=0; i<li_check.length;i++){
					li_check.eq(i).children('input').removeAttr("checked","checked");
					xs_licheck.eq(i).children('input').removeAttr("checked","checked");
				}
			}	
		}
		return false;
	});
	
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
	
	function setPrice(obj, count) {
		var li = $(obj).parents('li');
		var singleprice = parseInt(li.find('.singleprice').text());
		var totalprice = li.find('.totalprice');
		var price = count * singleprice;
		totalprice.text(price.toFixed(2));
	}
	
	
	setAllPrice();
	function setAllPrice(obj){
		var AllPrice = parseInt(document.getElementsByClassName("AllPrice")[0].innerHTML);
		var Totalprice = $(".lg_cart .totalprice");
		var length = Totalprice.length;
		if($(obj).children('input').is(':checked')){
			AllPrice += parseInt($(obj).parents('li').find('.totalprice').html());
		}else if($(obj).children('input').prop('checked') == false){
			AllPrice -= parseInt($(obj).parents('li').find('.totalprice').html());
			$(".content .all_checked input").removeAttr("checked","checked");
			$(".content .all_checked").css({"background":"url(img/checkbox.jpg) no-repeat 0 center"});
		}
		
		for(var i=0; i<length; i++){
			document.getElementsByClassName("AllPrice")[i].innerHTML = AllPrice.toFixed(2);
		}
	}
	
	function AllPri(obj){
		var AllPrice = 0;
		var Totalprice = $(".lg_cart .totalprice");
		var length = Totalprice.length;
		for(var i=0; i<length; i++){
			AllPrice += parseInt(Totalprice[i].innerHTML);
		}
		for(var i=0; i<length; i++){
			document.getElementsByClassName("AllPrice")[i].innerHTML = AllPrice.toFixed(2);
		}
	}
	
	$('.add').click(function () {
		setNum(this);
		setPrice(this, setnum);
	});
	
	$('.sub').click(function () {
		setNum(this);
		setPrice(this, setnum);
	});
})
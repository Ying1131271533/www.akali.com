$(document).ready(function(){
	var setnum;
	function setNum(obj){
		var num=document.getElementsByClassName("num");
		var reduce=document.getElementsByClassName("sub");
		var index = $(obj).parents('li').index();
		var className = $(obj)[0].className.substring(0,3);
		var count=parseInt(num[index].value);
		setnum = num[index].value;
		if(className == "add"){
			num[index].value = ++count;
			setnum = num[index].value;
			setprice(setnum);
			if(setnum > 1 ){
				reduce[index].removeAttribute("disabled");
			}
		}else{
			num[index].value = --count;
			setnum = num[index].value;
			setprice(setnum);
			if(setnum <= 1 ){
				reduce[index].setAttribute("disabled","disabled");
				return ;
			}
		}
		
		function setprice(count){
			var li = $(obj).parents('li');
			var singleprice = parseInt(li.find('.singleprice').text());
			var totalprice = li.find('.totalprice');
			var price = setnum * singleprice * 0.7;
			totalprice.text(parseInt(price).toFixed(2));
		}
		
	}
	
	var allprice = document.getElementsByClassName('AllPrice');
	var li_length = $('.lg_cart li').length;
	var allcheck = $(".content .all_checked");
	var licheck = $(".content .checked_product");
	var xs_licheck = $(".content .xschecked_product");
	
	$('.add').click(function () {
		setNum(this);
		if($(this).parents('li').find('input').is(':checked')){
			var pre = parseInt(document.getElementsByClassName("AllPrice")[0].innerHTML);
			for(var i=0; i<li_length; i++){
				 pre += 149;
				 document.getElementsByClassName("AllPrice")[i].innerHTML = pre.toFixed(2);
			}
		}
	});
	
	$('.sub').click(function () {
		setNum(this);
		if($(this).parents('li').find('input').is(':checked')){
			var Tprice = parseInt(document.getElementsByClassName("AllPrice")[0].innerHTML)
			 Tprice -= 149;
			for(var i=0; i<li_length; i++){
				document.getElementsByClassName("AllPrice")[i].innerHTML = Tprice.toFixed(2);
			}
		}
	});
	
	xs_licheck.click(function(e){
		if (isInput(e)) {
			return ;
		}
		
		function isInput(e) {
			return e.target.__proto__ === HTMLInputElement;
		}
		
		var index = $(this).parents('li').index();
		var check = $(this).children('input').prop('checked');
		var all_check = $(".all_checked");
		var money = 0;
		var ptext = document.getElementsByClassName('AllPrice')[0].innerHTML;
		
		if (check) {
			$(this).children('input').prop("checked",false);
			$(this).css({"background":"url(img/checkbox.jpg) no-repeat 0 center"});
			$(this).children('input').removeAttr("checked","checked");
			
			licheck.eq(index).children('input').prop("checked",false);
			licheck.eq(index).css({"background":"url(img/checkbox.jpg) no-repeat 0 center"});
			licheck.eq(index).children('input').removeAttr("checked","checked");
			
			all_check.children('input').prop("checked",false);
			all_check.css({"background":"url(img/checkbox.jpg) no-repeat 0 center"});
			all_check.children('input').removeAttr("checked","checked");
			
			money += parseInt($(this).parents('li').find('.totalprice').html());
			for(var i=0; i<li_length; i++){
				document.getElementsByClassName('AllPrice')[i].innerHTML = (parseInt(ptext) - money).toFixed(2) ;
			}
		} else {
			$(this).children('input').prop("checked",true);
			$(this).children('input').attr("checked","checked");
			$(this).css({"background":"url(img/checked.jpg) no-repeat 0 center"});
			
			licheck.eq(index).children('input').prop("checked",true);
			licheck.eq(index).children('input').attr("checked","checked");
			licheck.eq(index).css({"background":"url(img/checked.jpg) no-repeat 0 center"});
			
			money += parseInt($(this).parents('li').find('.totalprice').html());
			for(var i=0; i<li_length; i++){
				document.getElementsByClassName('AllPrice')[i].innerHTML = (parseInt(ptext) + money).toFixed(2) ;
			}
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
		
		function isInput(e) {
			return e.target.__proto__ === HTMLInputElement;
		}
		
		var index = $(this).parents('li').index();
		var check = $(this).children('input').prop('checked');
		var all_check = $(".all_checked");
		var money = 0;
		var ptext = document.getElementsByClassName('AllPrice')[0].innerHTML;
		
		if (check) {
			$(this).children('input').prop("checked",false);
			$(this).css({"background":"url(img/checkbox.jpg) no-repeat 0 center"});
			$(this).children('input').removeAttr("checked","checked");
			
			xs_licheck.eq(index).children('input').prop("checked",false);
			xs_licheck.eq(index).css({"background":"url(img/checkbox.jpg) no-repeat 0 center"});
			xs_licheck.eq(index).children('input').removeAttr("checked","checked");
			
			all_check.children('input').prop("checked",false);
			all_check.css({"background":"url(img/checkbox.jpg) no-repeat 0 center"});
			all_check.children('input').removeAttr("checked","checked");
			
			money += parseInt($(this).parents('li').find('.totalprice').html());
			for(var i=0; i<li_length; i++){
				document.getElementsByClassName('AllPrice')[i].innerHTML = (parseInt(ptext) - money).toFixed(2) ;
			}
		}else {
			$(this).children('input').prop("checked",true);
			$(this).children('input').attr("checked","checked");
			$(this).css({"background":"url(img/checked.jpg) no-repeat 0 center"});
			
			xs_licheck.eq(index).children('input').prop("checked",true);
			xs_licheck.eq(index).children('input').attr("checked","checked");
			xs_licheck.eq(index).css({"background":"url(img/checked.jpg) no-repeat 0 center"});
			
			money += parseInt($(this).parents('li').find('.totalprice').html());
			for(var i=0; i<li_length; i++){
				document.getElementsByClassName('AllPrice')[i].innerHTML = (parseInt(ptext) + money).toFixed(2) ;
			}
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
		var check = $(this).children('input').prop('checked');
		var li_check = $(".checked_product");
		
		if (check) {
			setCheck(false);
			allcheck.css({"background":"url(img/checkbox.jpg) no-repeat 0 center"});
			for(var i=0; i<li_check.length;i++){
				li_check.eq(i).css({"background":"url(img/checkbox.jpg) no-repeat 0 center"});
				xs_licheck.eq(i).css({"background":"url(img/checkbox.jpg) no-repeat 0 center"});
				
				document.getElementsByClassName('AllPrice')[i].innerHTML = 0;
			}
		} else {
			setCheck(true);
			var intext = 0;
			allcheck.css({"background":"url(img/checked.jpg) no-repeat 0 center"});
			for(var i=0; i<li_check.length;i++){
				li_check.eq(i).css({"background":"url(img/checked.jpg) no-repeat 0 center"});
				xs_licheck.eq(i).css({"background":"url(img/checked.jpg) no-repeat 0 center"});
				
				intext += parseInt($(".lg_cart li").eq(i).find('.totalprice').html());
			}
			for(var i=0; i<li_check.length;i++){
				document.getElementsByClassName('AllPrice')[i].innerHTML = intext.toFixed(2);
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
})
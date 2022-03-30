$(document).ready(function(){
	var allcheck=$(".content .checkbox-inline");
	allcheck.click(function(e){
		if (isInput(e)) {
			return ;
		}
		var check = $(this).children('input').prop('checked');
		
		if (check) {
			setCheck(false);
			allcheck.css({"background":"url(/static/wed/img/checkbox.jpg) no-repeat 0 center"});
		} else {
			setCheck(true);
			allcheck.css({"background":"url(/static/wed/img/checked.jpg) no-repeat 0 center"});
		}
		
		function isInput(e) {
			return e.target.__proto__ === HTMLInputElement;
		}
		
		function setCheck(check) {
			$(".content .checkbox-inline input").prop("checked",check);
			if (check) {
				$(".content .checkbox-inline input").attr("checked","checked");
			} else {
				$(".content .checkbox-inline input").removeAttr("checked","checked");
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
	
	function setAllPrice(){
		var AllPrice = 0;
		var Totalprice = document.getElementsByClassName("totalprice");
		var li = $(".cart_text li");
		var xs_li = $(".xs_cart li");
		var length = Totalprice.length;
		if(li.length == 0 ){
			document.getElementsByClassName("AllPrice")[0].innerHTML = 0;
		}else if(xs_li.length == 0 ){
			document.getElementsByClassName("AllPrice")[1].innerHTML = 0;
		}else{
			for(var i=0; i<length; i++){
				AllPrice += parseInt(Totalprice[i].innerHTML);
			}
			for(var i=0; i<length; i++){
				document.getElementsByClassName("AllPrice")[i].innerHTML = AllPrice.toFixed(2);
			}
		}
	}
	setAllPrice();
	$('.add').click(function () {
		setNum(this);
		setPrice(this, setnum);
		setAllPrice();
	});
	
	$('.sub').click(function () {
		setNum(this);
		setPrice(this, setnum);
		setAllPrice();
	});
	$(".content li #delete").click(function(){
		$(this).parents("li").remove();
		setAllPrice();
	})
})
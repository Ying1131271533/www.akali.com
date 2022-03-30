$(document).ready(function(){
	$(".content .news_center .switch a").click(function(){
		var width = window.innerWidth;
		if(width >= 1200){
			if($(".content .news_text .show_text").height() == 596){
				$(".content .news_text .show_text").animate({"height":"668"+"px"},1000);
				$(this).addClass("tranf");
			}else{
				$(".content .news_text .show_text").animate({"height":"596"+"px"},1000);
				$(this).removeClass("tranf");
			}
		}else if(width >= 992){
			if($(".content .news_text .show_text").height() == 576){
				$(".content .news_text .show_text").animate({"height":"608"+"px"},1000);
				$(this).addClass("tranf");
			}else{
				$(".content .news_text .show_text").animate({"height":"576"+"px"},1000);
				$(this).removeClass("tranf");
			}
		}else if(width >= 768){
			if($(".content .news_text .show_text").height() == 524){
				$(".content .news_text .show_text").animate({"height":"576"+"px"},1000);
				$(this).addClass("tranf");
			}else{
				$(".content .news_text .show_text").animate({"height":"524"+"px"},1000);
				$(this).removeClass("tranf");
			}
		}else if(width < 768){
			if($(".content .news_text .show_text").height() == 524){
				$(".content .news_text .show_text").animate({"height":"596"+"px"},1000);
				$(this).addClass("tranf");
			}else{
				$(".content .news_text .show_text").animate({"height":"524"+"px"},1000);
				$(this).removeClass("tranf");
			}
		}
	})
})

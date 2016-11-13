$(document).ready(function(){
	/*口风琴效果*/
	$(".list .list_title").toggle(function(){ 
		$(this).next(".list_content").animate({height: 'toggle'}, 200); 
	},function(){ 
        $(this).next(".list_content").animate({height: 'toggle'}, 200); 
	});	
	/*选中效果*/
	$(".list_content ul li").each(function(i){
		$(this).click(function(){
			clear();
			$(this).addClass("active");
		});
	});
	function clear(){
		var li = $(".list_content ul li");
		for(var i = 0;i < li.length;i ++){
			li[i].className = '';
		}
	}
});
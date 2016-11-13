$(document).ready(function(){
	var out = $('.slider'),
		imgNum = $('#container .slider img').length,
		buttons = $('#container #list span'),
		index = 0,
		timer;
	/*下一张切换*/
	$("#buttons .next").click(function(){
		checkIndex("next");
		animation(index);
		showButton(index);
	});
	/*上一张切换*/
	$("#buttons .prev").click(function(){
			checkIndex("prev");
			animation(index);
			showButton(index);
		});
	/*底部按钮切换*/
	function showButton(index){
		for(var i = 0;i < imgNum;i ++){
			buttons[i].className = '';	
		}
		buttons[index].className = 'on';
	}
	/*执行的动画函数*/
	function animation(zF){
		out.animate({left:(zF)*-900},400);
		console.log(zF);
	}
	/*判断索引值的变化*/
	function checkIndex(target){
		if(target=="next"){
			index+=1;
			if(index == imgNum){
				index = 0;
			}
		}else if(target=="prev"){
			index-=1;
			if(index == -1){
				index = imgNum-1;
			}
		}
	}
	/*底部按钮切换卡片*/
	function buttonsClick(){
		for(var i = 0;i < buttons.length;i ++){
			buttons[i].index = i;
			buttons[i].onclick = function(){
				animation(this.index);
				showButton(this.index);
				index = this.index;
			}
		}
	}
	buttonsClick();
	/*自动播放函数*/
	function startMove(){
		timer = setInterval(function(){
			$("#buttons .next").click();
		},3000);
	}
	/*鼠标移入container*/
	$('#container').mouseover(function(){
		showBtn(70);
		/*关闭自动切换*/
		clearInterval(timer);
	});
	/*鼠标移出container*/
	$('#container').mouseout(function(){
		showBtn(0);
		startMove();
	});
	function showBtn(target){
		$("#buttons .next").css('height',target);
		$("#buttons .prev").css('height',target);
	}
	startMove();	
})

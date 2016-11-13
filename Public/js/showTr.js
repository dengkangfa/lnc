var tr = document.getElementsByTagName('tr');
	for(var i = 0;i < tr.length;i ++){
		if(i==0){
			continue;
		}
		tr[i].onmouseover = function(){
			this.style.background = 'seashell';
		}
		tr[i].onmouseout = function(){
			this.style.background = '#FFF';
		}
	}

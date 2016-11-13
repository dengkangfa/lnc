$(function() {
		    var jcrop_api,
		        boundx,
		        boundy,
		        $preview = $('#preview-pane'),
		        $pcnt = $('#preview-pane .preview-container'),
		        $pimg = $('#preview-pane .preview-container img'),
		        xsize = $pcnt.width(),
		        ysize = $pcnt.height();
		      //点击
			  $("#re").click(function () {
			  	$("#upload").click();               //隐藏了input:file样式后，点击头像就可以本地上传
			    	$("#upload").on("change",function(){		     	
				       var objUrl = getObjectURL(this.files[0]) ;  //获取图片的路径，该路径不是图片在本地的路径
				       if (objUrl) {
				         $("#pic").attr("src", objUrl);//将图片路径存入src中，显示出图片
				         $("#show").attr("src",objUrl);
				         $(".jcrop-holder img").attr("src", objUrl);
				       	 $('#pic').Jcrop({
						      onChange: updatePreview,
						      onSelect: updatePreview,
						      aspectRatio: xsize / ysize,
						      allowSelect:false,
						      setSelect:[0,0,100,100],
						    },function(){
						      var bounds = this.getBounds();
						      boundx = bounds[0];
						      boundy = bounds[1];
						      jcrop_api = this;
								
						    });
						function updatePreview(c){
					      if (parseInt(c.w) > 0){
					        var rx = xsize / c.w;
					        var ry = ysize / c.h;					
					        $pimg.css({				          
					          width: Math.round(rx * boundx) + 'px',
					          height: Math.round(ry * boundy) + 'px',
					          marginLeft: '-' + Math.round(rx * c.x) + 'px',
					          marginTop: '-' + Math.round(ry * c.y) + 'px',
					        });
					      }
						};
				       }
				    });
				  });
				});
 
		//建立一個可存取到該file的url
		function getObjectURL(file) {
		  var url = null ;
		  if (window.createObjectURL!=undefined) { // basic
		    url = window.createObjectURL(file) ;
		  } else if (window.URL!=undefined) { // mozilla(firefox)
		    url = window.URL.createObjectURL(file) ;
		  } else if (window.webkitURL!=undefined) { // webkit or chrome
		    url = window.webkitURL.createObjectURL(file) ;
		  }
		  return url ;
		}
	$("#re").click(function () {
	  	$("#upload").click();               //隐藏了input:file样式后，点击头像就可以本地上传
    	$("#upload").on("change",function(){		     	
	       var objUrl = getObjectURL(this.files[0]) ;  //获取图片的路径，该路径不是图片在本地的路径
	       if (objUrl) {
	       		$("#pic").attr("src",objUrl)
	       }
	    });
 	});

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

	/**
	 * Created by Administrator on 2016/10/23.
	 */
	$(function () {
		var editor = new wangEditor('edit');
		editor.config.menuFixed = false;
		editor.config.menus = [
			'bold',
			'underline',
			'italic',
			'strikethrough',
			'eraser',
			'forecolor',
			'bgcolor',
			'quote',
			'fontsize',
			'head',
			'unorderlist',
			'orderlist',
			'alignleft',
			'aligncenter',
			'alignright',
			'video',
			'fullscreen'
		];
		editor.create();

		//让编辑器失去焦点
		// $('#edit').blur();

		//获取焦点时清空编辑器文字
		$('.wangEditor-txt').focus(function () {
			if(Trim(editor.$txt.text())=='请输入内容...'){
				editor.clear();
			}
		});

		//失去焦点，如果编辑器内容为空，则出相应提示
		$('.wangEditor-txt').blur(function () {
			if(Trim(editor.$txt.text())==''){
				editor.$txt.html('<p>请输入内容...</p>');
			}
		});
		//清空字符串前后空格
		function Trim(str) {
			return str.replace(/(^\s*)|(\s*$)/g, "");
		}

		$('#publishBtn').click( function(){
			if(Trim(editor.$txt.text())=='请输入内容...' || Trim(editor.$txt.text())==''){
				alert('内容不能为空');
				$('#edit').focus();
				return false;
			}else {
				var options = {
					success: function (data) {
						//判断副返回值
						var obj=$.parseJSON(data);
;						alert(obj.info);
					}
				};
				$("#form").ajaxSubmit(options);
				$("#form").resetForm();
				$("#pic").attr("src","/lnc/Public/img/未标题-1.jpg");
				editor.clear();
				$("#title").focus();
				return false;
			}
		});

	});


/*$(document).ready(function(){
	$('#tieba_btn').mouseover(function(){
		$('.list').animate({height:100},500)
	});
	
	$('#tieba_btn').mouseout(function(){
		$('.list').animate({height:0},0)
	});
		
})*/
//验证码字段
var code="";

/**
 * 生成随机验证码
 * @param $length  生成验证码的长度
 * @returns {string}
 */
function getCode($length) {
	code="";
	for (var i=0;i<$length;i++){
		code+=Math.floor(Math.random()*9+1);
	}
	return code;
}

/**
 * 发送邮件
 */
function sendMail(){
		var email=$('#email').val();
		$.ajax({
			url:'/lnc/Home/Main/sendEmail?email='+email+'&code='+getCode(6),
			type:"GET",
			// data:$('#email').serialize(),
			success: function(data) {
				alert(data['content']);
			}
		});
}

/**
 * 验证验证码是否一致
 * @returns {boolean}
 */
function check() {
	if(code==$('#code').val()){
		return true;
	}else{
		alert(2);
		return false;
	}
}

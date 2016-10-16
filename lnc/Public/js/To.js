$(document).ready(function(){
	$('#toReBtn').click(function(){
		$('#login_register .out').animate({left:-900},500)
		clear();
	});
	
	$('#toLoBtn').click(function(){
		$('#login_register .out').animate({left:0},500)
		clear();
	});
	function clear(){
		$('#login_register .text').val('');
	}
})
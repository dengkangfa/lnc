$(document).ready(function(){
			var flag = true;
			$('#login_btn').click(function(){
				if(flag == false){
					$('#login_register').animate({height:0},200);
					flag = true;
					return;
				}
				if(flag == true){
					$('#login_register').animate({height:250},200);
					$('#login_register .out').animate({left:0},0);
					clear();
					$('#login_register .right span').animate({left:-200},0);
					$('#login_register .right img').animate({left:300},0);
					show(0,500);
					flag = false;
					return;
				}
			});
			function clear(){
				$('#login_register .text').val('');
			}
			function show(target,speed){
				$('#login_register .right span').animate({left:target},speed);
				$('#login_register .right img').animate({left:target},speed);
			}


			//start
				$('#name').keyup(function(){
					var name=$('#name').val();
					if(name) {
						var url = "./User/verifyOnly";
						var data = {'verifier':'n','u_name': name};
						var success = function (data) {
							if (data.status === 1) {
								$('#nameMessage').className = '';
							} else {
								$('#nameMessage').className = '';
							}
							$('#nameMessage').html(data.content);
						}
						$.post(url, data, success);
					}else{
						$('#nameMessage').html('');
					}
				});

				$('#email').keyup(function(){
					var email=$('#email').val();
					if(email) {
						var url = "./User/verifyOnly";
						var data = {'verifier':'e','u_email': email};
						var success = function (data) {
							if (data.status === 1) {
								$('#emailMessage').className = '';
							} else {
								$('#emailMessage').className = '';
							}
							$('#emailMessage').html(data.content);
						}
						$.post(url, data, success);
					}else{
						$('#emailMessage').html('');
					}
				});

				//解决用户登录操作未执行成功，导致记住我单选按钮与对应值不匹配的情况
				if($('#remember').is(':checked')){
					$('#remember').val(1);
				}else{
					$('#remember').val(0);
				}

				$("#remember").click(function(){
					//记住我单选框赋值
					if($('#remember').is(':checked')){
						$('#remember').val(1);
					}else{
						$('#remember').val(0);
					}
				});

			//end

		})
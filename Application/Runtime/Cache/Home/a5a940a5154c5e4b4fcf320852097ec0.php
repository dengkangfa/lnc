<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/tiebaUse.css"/>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/manager_transfer.css"/>
	</head>
	<body>
		<div id="box">
			<form action="" method="post">
				<div class="title">
					<h3>管理员转让</h3>					
				</div>

				<div class="one">
					<ul>
						<li>您的账号:</li>
						<li>转让的账号:</li>
						<li></li>
					</ul>
				</div>
				<div class="two">
					<ul>
						<!--您的账号-->
						<li id="user" style="text-indent: 10px;" class="rgb" ><?php echo ($name); ?></li>
						<!--填写需要转让的账号-->
						<li>
							<input type="text" class="text" name="" id="recipient" value="" placeholder="用户名/邮箱"/>
						</li>
						<!--确定按钮-->
						<li>
							<input type="submit" class="button" name="" id="ok" value="确定" />
						</li>
					</ul>
				</div>
			</form>		
		</div>
	</body>
	<script src="/lnc/Public/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		$("#ok").on("click",function(){
			if(confirm("确定要转让管理员？")){
				//当前管理员用户名
				var user=$('#user').html();
				//接收者
				var recipient=$('#recipient').val();
				var url='/lnc/BoardManage/updateManage';
				var data={'user':user,'recipient':recipient};
				$.post(url, data, null);
			}else{
				alert(1);
			}
		})
	</script>
</html>
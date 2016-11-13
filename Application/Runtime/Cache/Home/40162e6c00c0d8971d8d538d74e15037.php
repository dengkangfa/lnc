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
						<li style="text-indent: 10px;" class="rgb">12124124</li>
						<!--填写需要转让的账号-->
						<li>
							<input type="text" class="text" name="" id="" value="" />
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
			confirm("确定要转让管理员？")
		})
	</script>
</html>
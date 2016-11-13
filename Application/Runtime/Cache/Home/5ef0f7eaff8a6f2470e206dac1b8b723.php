<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/tiebaUse.css"/>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/reset_word.css"/>
	</head>
	<body>
		<div id="box">
			<form action="" method="post">
				<h3>密码修改</h3><br />
				<div class="one">
					<ul>
						<li>原始密码:</li>
						<li>新的密码:</li>
						<li>确定密码:</li>
						<li></li>
					</ul>
				</div>
				<div class="two">
					<ul>
						<!--旧密码-->
						<li>
							<input type="text" class="text" name="" id="" value="" />
						</li>
						<!--新密码-->
						<li>
							<input type="text" class="text" name="" id="" value="" />
						</li>
						<!--新密码-->
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
			confirm("确定要修改密码吗？")
		})
	</script>
</html>
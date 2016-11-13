<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/tiebaUse.css"/>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/tieba_head.css"/>
	</head>
	<body>
		<div id="box">
			<h3>设置贴吧头像</h3><br />	
			<form action="" method="post">
				当前头像:
				<img src="<?php echo ($b_headicon); ?>" id="pic"/>
				<!--重新按钮-->
				<br /><br />
				<a href="<?php echo U('BoardManage/setAvatar',array('id'=>$b_id));?>" id="reset_head">更换头像</a>
			</form>		
		</div>
	</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/tiebaUse.css"/>
	<style type="text/css">
		#box{
			width: 500px;	
			height: 200px;
			margin: 100px auto;
			text-align: center;
		}
	</style>
	</head>
	<body>
		<div id="box">
			<h3>设置贴吧签名</h3><br />
			<form action="<?php echo U('BoardManage/updateSignatrue',array('id'=>$b_id));?>" method="post">
				<textarea name="explain" rows="7" cols="60" style="resize:none"><?php echo ($b_explain); ?></textarea>
				<br /><br />
				<input name="send" type="submit" value="确定" class="button"/>
			</form>
		</div>
	</body>
</html>
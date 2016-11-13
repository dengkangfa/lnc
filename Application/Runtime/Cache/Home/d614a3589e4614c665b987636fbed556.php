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
			<h3>设置个人签名</h3><br />
			<form action="<?php echo U('BoardManage/setExplain',array('u_id'=>$u_id));?>" method="post">
				<textarea name="explain" rows="7" cols="60" style="resize:none"><?php echo ($u_explain); ?></textarea>
				<br /><br />
				<input type="submit" name="send" value="确定" class="button"/>
			</form>
		</div>
	</body>
</html>
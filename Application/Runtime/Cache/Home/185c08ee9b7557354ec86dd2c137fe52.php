<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<style type="text/css">
		body,html{
			width: 100%;
			height: 100%;
			margin: 0;
			padding: 0;
		}
	</style>
	<body>
		<iframe src="/lnc/index.php/Home/BoardManage/top.html" width="100%" height="130px" frameborder="no" marginheight="0px"></iframe>
		<iframe src="/lnc/index.php/Home/BoardManage/left/id/<?php echo ($u_id); ?>" width="15%" height="90%" frameborder="no" marginheight="0" marginwidth="0" style="float: left;" ></iframe>
		<iframe src="/lnc/index.php/Home/BoardManage/right.html"  width="85%" height="90%" frameborder="no" name="right" marginheight="0" marginwidth="0" scrolling="auto"></iframe>
	</body>
</html>
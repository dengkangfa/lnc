<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/tiebaUse.css"/>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/tieba_cover.css"/>
	</head>
	<body>
		<div id="box">
			<div class="content">
				<img src="<?php echo ($b_cover); ?>"/>
			</div>
			<h3>当前封面</h3>
			<br />
			<a href="set_cover.html" id="reset_cover">修改封面</a>
		</div>
	</body>
</html>
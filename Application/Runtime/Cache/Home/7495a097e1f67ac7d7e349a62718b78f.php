<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/jquery.Jcrop.min.css"/>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/tiebaUse.css"/>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/set_cover.css"/>
	<body>
		<div id="box"> 
			<form action="" method="post">
				<div class="top">
					<img src="img/未标题-2.jpg" id="pic"/>
				</div>
				当前封面
				<p style="color: red;">请上传宽高比为(20:3)的图</p>
				<br /><br />
				<input type="submit" name="" id="" value="确定" class="button"/>
				<br /><br />
				<div id="preview-pane">
					<div class="preview-container">
						<img src="img/未标题-2.jpg" id="show"/>								
					</div>
				</div>
				裁剪后的封面
				<br /><br />
				<input type="button" name="" id="re" value="上传" class="button"/>
				<input type="file" name="upload" id="upload" value="" style="display: none"/>
				<br /><br />
			</form>
		</div>
	</body>
	<script src="/lnc/Public/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/lnc/Public/js/jquery.Jcrop.js" type="text/javascript" charset="utf-8"></script>
	<script src="/lnc/Public/js/show_img.js" type="text/javascript" charset="utf-8"></script>
</html>
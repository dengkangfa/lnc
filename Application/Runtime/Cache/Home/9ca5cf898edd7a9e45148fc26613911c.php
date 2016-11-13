<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/tiebaUse.css"/>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/jquery.Jcrop.min.css"/>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/set_personalH.css"/>
	<body>
		<div id="box">
			<div class="title">
				<a href="<?php echo ($prev_url); ?>" id="back_btn">返回</a>
			</div>
			<div class="content">
				<div class="info">
					<!--当前头像-->
					<div class="one">
						<div class="img_container">
							<img src="<?php echo ($u_headicon); ?>" id="pic"/><br />
						</div>
						<p>当前图片</p>
						<input type="submit" name="" id="ok" value="确定上传" class="button"/>
						
					</div>
					<div class="two"></div>
					<!--裁剪的图像-->
					<div class="three">
						<div id="preview-pane">
							<div class="preview-container">
								<img src="/lnc/Public/img/未标题-1.jpg" id="show"/>
							</div>
						</div>
						<p>裁剪后的图片</p>
						<!--确定上传按钮-->
						<a href="#" id="re">上传图片</a>
						<input type="file" name="" id="upload" value="" style="display: none;"/>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="/lnc/Public/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/lnc/Public/js/jquery.Jcrop.js" type="text/javascript" charset="utf-8"></script>
	<script src="/lnc/Public/js/show_img.js" type="text/javascript" charset="utf-8"></script>
</html>
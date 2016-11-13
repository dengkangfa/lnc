<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/tiebaUse.css"/>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/publish_tuiwen.css"/>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/dist/css/wangEditor.min.css">
	</head>
	<body>
		<div id="box">
			<form action="/lnc/BoardManage/publshTweets" id="form" method="post">
			<h3>发表推文</h3><br />
			<p>标题:</p>
			<div class="title">
				<input type="text" name="title" id="title" value=""/>
			</div>
			<p>简介:</p>
			<textarea id="" name="synopsis" rows="5" cols="30" style="resize: none;">
			</textarea>
			<p>缩略图:</p>
			<img src="/lnc/Public/img/未标题-1.jpg" id="pic"/>
			<input type="file" name="pic" id="upload" value="" style="display: none;"/>
			<a href="#" id="re">上传图片</a>
			<p>内容:</p>
			<div class="content">
			<textarea id="edit" name="content" style="height:340px">
                <p>请输入内容...</p>
			</textarea>
			</div>
			<br />
			<div class="footer" style="margin: 100px auto">
				<input type="submit" name="" id="publishBtn" value="确定" class="button""/>
				<input type="button" name="" id="" value="取消" class="button"/>
			</div>
			</form>
		</div>
	</body>
	<script src="/lnc/Public/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/lnc/Public/dist/js/wangEditor.min.js"  type="text/javascript" charset="UTF-8"></script>
	<script src="/lnc/Public/js/jquery.form.js" type="text/javascript" charset="UTF-8"></script>
	<script src="/lnc/Public/js/publishTweets.js" type="text/javascript" charset="utf-8"></script>
</html>
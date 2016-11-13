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
			<?php if(!empty($tweets)): if(is_array($tweets)): foreach($tweets as $key=>$vo): ?><form action="/lnc/BoardManage/updateTweets" id="form" method="post">
						<input type="hidden" name="id" value="<?php echo ($_GET['t_id']); ?>">
						<h3>发表推文</h3><br />
						<p>标题:</p>
						<div class="title">
							<input type="text" name="title" id="title" value="<?php echo ($vo["title"]); ?>"/>
						</div>
						<p>简介:</p>
						<textarea id="" name="synopsis" rows="5" cols="30" style="resize: none;">
							<?php echo ($vo["synopsis"]); ?>
						</textarea>
						<p>缩略图:</p>
						<img src="<?php echo ($vo["t_cover"]); ?>" id="pic"/>
						<input type="file" name="pic" id="upload" value="<?php echo ($vo["cover"]); ?>" style="display: none;"/>
						<a href="#" id="re">上传图片</a>
						<p>内容:</p>
						<div class="content">
						<textarea id="edit" name="content" style="height:340px">
							<?php echo ($vo["content"]); ?>
						</textarea>
						</div>
						<br />
						<div class="footer" style="margin: 100px auto">
							<input type="submit" name="" id="publishBtn" value="确定" class="button""/>
							<input type="button" name="" id="" value="取消" class="button"/>
						</div>
					</form><?php endforeach; endif; ?>
			<?php else: ?>
				<form action="/lnc/BoardManage/publishTweets" id="form" method="post">
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
				</form><?php endif; ?>
		</div>
	</body>
	<script src="/lnc/Public/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/lnc/Public/dist/js/wangEditor.min.js"  type="text/javascript" charset="UTF-8"></script>
	<script src="/lnc/Public/js/jquery.form.js" type="text/javascript" charset="UTF-8"></script>
	<script src="/lnc/Public/js/publishTweets.js" type="text/javascript" charset="utf-8"></script>
</html>
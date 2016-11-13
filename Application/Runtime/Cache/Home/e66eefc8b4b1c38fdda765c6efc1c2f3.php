<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/tiebaUse.css"/>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/post_editor.css"/>
		<link rel="stylesheet" type="text/css" href="/lnc/Public/dist/css/wangEditor.min.css">
	</head>
	<body>
		<div id="box">
			<?php if(!empty($postDetails)): if(is_array($postDetails)): foreach($postDetails as $key=>$vo): ?><div class="title">
						<p>标题:</p>
						<input type="text" name="" id="" value="<?php echo ($vo["title"]); ?>"/>
					</div>
					<p>内容:</p>
					<div class="content">

						<div class="pinglun" style="height: 40%;width: 100%;">
							<input type="hidden" id="type" value="<?php echo ($type); ?>">
							<input type="hidden" id="id" value="<?php echo ($id); ?>">
							<div id="edit" style="height:340px">
								<p><?php echo ($vo["content"]); ?></p>
							</div>
							<!--<p  id="p"><input id="publishBtn" type="button" value="发表"/></p>-->


						</div>
					</div>
					<div class="footer">
						<input type="button" name="" id="" value="确定" class="button"/>
						<input type="button" name="" id="" value="取消" class="button"/>
					</div><?php endforeach; endif; endif; ?>
		</div>
	</body>
	<script type="text/javascript" src="/lnc/Public/dist/js/lib/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="/lnc/Public/dist/js/wangEditor.min.js"></script>
	<script type="text/javascript" src="/lnc/Public/js/postWangEditor.js"></script>
</html>
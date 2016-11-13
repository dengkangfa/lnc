<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/tiebaUse.css"/>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/personal_head.css"/>
	</head>
	<body>
		<div id="box">
			<h3>设置个人头像</h3><br />

			<form action="" method="post">
				<?php if(!empty($u_headicon)): ?>当前头像:
						<img src="<?php echo ($u_headicon); ?>" id="pic"/>
						<!--重新按钮-->
						<br /><br />
				<?php else: ?>
					当前头像:
					<img src="/lnc/Public/img/default_avatar.png" id="pic"/>
					<!--重新按钮-->
					<br /><br /><?php endif; ?>
				<a href="<?php echo U('BoardManage/setUserAvatar',array('u_id'=>$u_id));?>" id="reset_head">更换头像</a>
			</form>
		</div>
	</body>
</html>
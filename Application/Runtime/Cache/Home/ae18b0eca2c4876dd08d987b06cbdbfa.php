<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/left.css"/>
	</head>
	<body>
		<!--左侧手风琴菜单栏-->
        <div id="left">
        	<!--贴吧设置-->
        	<div class="list">
				<div class="list_title">贴吧设置<span></span></div>
				<div class="list_content">
					<ul>
						<!--<li><a href="updateBoardAvatar.html" target="right">设置贴吧头像</a></li>-->
						<li><a href="<?php echo U('BoardManage/updateBoardAvatar',array('id'=>$b_id));?>" target="right">设置贴吧头像</a></li>
						<li><a href="<?php echo U('BoardManage/updateCover',array('id'=>$b_id));?>" target="right">设置封面</a></li>
						<li><a href="<?php echo U('BoardManage/updateSignatrue',array('id'=>$b_id));?>" target="right">设置签名</a></li>
						<li><a href="<?php echo U('BoardManage/transferManage',array('b_id'=>$b_id,'u_id'=>$u_id));?>" target="right">管理员转让</a></li>
					</ul>
				</div>
			</div>
			
			<!--帖子管理-->
			<div class="list">
				<div class="list_title">帖子管理<span></span></div>
				<div class="list_content">
					<ul>
						<li><a href="<?php echo U('BoardManage/postManagement',array('id'=>$b_id));?>" target="right">帖子管理</a></li>
					</ul>
				</div>
			</div>
			
			<!--推文管理-->
			<div class="list">
				<div class="list_title">推文管理<span></span></div>
				<div class="list_content">
					<ul>
						<li><a href="/lnc/index.php/Home/BoardManage/selectTweets.html" target="right">发表推文</a></li>
						<li><a href="<?php echo U('BoardManage/tweetsManagement',array('u_id'=>$u_id));?>" target="right">推文管理</a></li>
					</ul>
				</div>
			</div>
			
			<!--账号设置-->
			<div class="list">
				<div class="list_title">账号设置<span></span></div>
				<div class="list_content">
					<ul>
						<li><a href="<?php echo U('BoardManage/updateUserAvatar',array('u_id'=>$u_id));?>" target="right">设置个人头像</a></li>
						<li><a href="<?php echo U('BoardManage/setExplain',array('u_id'=>$u_id));?>" target="right">设置签名</a></li>
						<li><a href="<?php echo U('BoardManage/resetWord',array('u_id'=>$u_id));?>" target="right">密码修改</a></li>
					</ul>
				</div>
			</div>
			

			<!--安全退出-->
			<div class="list">
				<div class="list_title">安全退出</div>
				<div class="list_content">
					<ul>
						<li><a href="<?php echo U('BoardManage/upload');?>">安全退出</a></li>
					</ul>
				</div>
			</div>
		</div>
	</body>
	<script src="/lnc/Public/js/jq_1.2.6.js" type="text/javascript" charset="utf-8"></script>
	<script src="/lnc/Public/js/list.js" type="text/javascript" charset="utf-8"></script>
</html>
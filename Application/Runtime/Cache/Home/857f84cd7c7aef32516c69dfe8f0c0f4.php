<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/tiebaUse.css"/>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/post_management.css"/>
	<link rel="stylesheet" type="text/css" href="/lnc/Public/css/bootstrap.min.css"/>
	<script src="/lnc/Public/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/lnc/Public/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
	<body>
		<h3>推文管理</h3>
		<table class="table table-striped table-bordered table-hover">
		   <thead>
		     <tr>
		       <th>推文id</th>
		       <th>推文标题</th>
		       <th>推文编辑</th>
		       <th>推文删除</th>
		     </tr>
		   </thead>
		   <tbody>
		     <?php if(!empty($tweets)): if(is_array($tweets)): foreach($tweets as $key=>$vo): ?><tr>
					   <td><?php echo ($vo["t_id"]); ?></td>
					   <td><?php echo ($vo["title"]); ?></td>
					   <td><a href="/lnc/BoardManage/selectTweets/t_id/<?php echo ($vo["t_id"]); ?>">编辑</a></td>
					   <td><a href="/lnc/BoardManage/deleteTweets/t_id/<?php echo ($vo["t_id"]); ?>">删除</a></td>
					 </tr><?php endforeach; endif; ?>
			 <?php else: ?>
				 <tr><td colspan="4" align="center">没有任何数据</td></tr><?php endif; ?>
		   </tbody>
		 </table>
		 <!--页数切换-->
		 <div class="footer">
			 <?php echo ($page); ?>
		 	<!--<div class="left">-->
		 		<!--页:-->
		 		<!--<span style="color: red;">1</span>-->
		 		<!--/-->
		 		<!--<span>1</span>-->
		 		<!--记录:-->
		 		<!--<span style="color: red;">0</span>-->
		 	<!--</div>-->
		 	<!--<div class="right">-->
		 		<!--<a href="">首页</a>-->
		 		<!--<a href="">上一页</a>-->
		 		<!--<a href="">下一页</a>-->
		 		<!--<a href="">尾页</a>-->
		 	<!--</div>-->
		 	<!--<ul>-->
		 		<!--<li><a href="">1</a></li>-->
		 		<!--<li><a href="">2</a></li>-->
		 		<!--<li><a href="">3</a></li>-->
		 		<!--<li><a href="">4</a></li>-->
		 		<!--<li><a href="">5</a></li>-->
		 		<!--<li><a href="">6</a></li>-->
		 		<!--<li><a href="">7</a></li>-->
		 	<!--</ul>-->
		 </div>
	</body>
	<script src="/lnc/Public/js/showTr.js" type="text/javascript" charset="utf-8"></script>
</html>
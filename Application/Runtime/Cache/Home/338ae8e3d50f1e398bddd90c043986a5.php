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
		<h3>帖子管理</h3>
		<table class="table table-striped table-bordered table-hover">
		   <thead>
		     <tr>
		       <th>帖子id</th>
		       <th>帖子标题</th>
		       <th>帖子编辑</th>
		       <th>帖子置顶</th>
		       <th>帖子删除</th>
		     </tr>
		   </thead>
			<?php if(!empty($post)): if(is_array($post)): foreach($post as $key=>$vo): ?><tbody>
					 <tr>
					   <td><?php echo ($vo["p_id"]); ?></td>
					   <td><?php echo ($vo["title"]); ?></td>
					   <td><a href="/lnc/BoardManage/postEditor/id/<?php echo ($vo["p_id"]); ?>">编辑</a></td>
					   <td><a href="#">置顶</a></td>
					   <td><a href="/lnc/BoardManage/postDelete/id/<?php echo ($vo["p_id"]); ?>"  onclick="return confirm('你真的要删除这条评论吗？')?true:false">删除</a></td>
					 </tr>
				   </tbody><?php endforeach; endif; ?>
				<?php else: ?>
				<tbody>
					<tr>
						<td colspan="5" align="center">没有任何数据</td>
					</tr>
				</tbody><?php endif; ?>
		 </table>
		 <!--页数切换-->
		 <div class="chose">
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
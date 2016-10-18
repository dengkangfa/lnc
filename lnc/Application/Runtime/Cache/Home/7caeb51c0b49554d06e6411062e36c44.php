<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="/lnc/Public/css/index.css"/>
    <link rel="stylesheet" type="text/css" href="/lnc/Public/css/all.css"/>
    <script src="/lnc/Public/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<!--页眉-->
<div id="top">
    <div class="out">
        <!--logo-->
        <div class="logo">
            岭南校园
        </div>
        <!--导航-->
        <div class="tab">
            <ul>
                <li><a href="/lnc">首页</a></li>
                <li><a href="/lnc/Tweets/index">推文</a></li>
                <li id="tieba_btn">
                    贴吧
                    <div class="list">
                        <?php if(!empty($plate)): if(is_array($plate)): foreach($plate as $key=>$vo): ?><a href="tuiwen.html"><?php echo ($vo["p_name"]); ?></a><?php endforeach; endif; ?>
                            <?php else: ?>
                            没有任何数据<?php endif; ?>
                    </div>
                </li>
            </ul>

        </div>
        <!--登陆按钮以及搜索框-->
        <div class="btn_search">
            <ul>
                <!--没登陆-->
                <?php if(empty($user)): ?><li id="login_btn">登陆</li>
                    <?php else: ?>
                    <!--登陆之后-->
                    <li id="user_info">
                        <!--用户名-->
                        <span id="user_name">欢迎您,<?php echo ($user); ?></span>
                        <div class="list">
                            <a href="#">个人信息</a>
                            <a href="<?php echo U('unLogin');?>">注销</a>
                        </div>
                    </li><?php endif; ?>
                <li style="width: 170px;">
                    <input type="search" name="" id="search" value="" placeholder="贴吧/推文"/>
                </li>
                <li>
                    <input type="button" name="" id="" value="搜索" class="button"/>
                </li>
            </ul>
        </div>
    </div>
</div>

<!--登陆窗口-->
<div id="login_register">
    <!--登陆框与注册框-->
    <div class="left">
        <div class="out">
            <!--登陆-->
            <div class="login box">
                <h3>用户登陆</h3>
                <div class="frame">
                    <form action="<?php echo U('login');?>" method="post">
                        <div class="one">
                            <ul>
                                <li>
                                    你的手机号/邮箱:
                                </li>

                                <li>
                                    密码:
                                </li>

                                <li>
                                    验证码:
                                </li>
                                <li>
                                    <input type="checkbox" name="checkbox" id="" value="" />
                                </li>
                                <li></li>
                            </ul>
                        </div>
                        <div class="two">
                            <ul>
                                <!--用户名 邮箱-->
                                <li>
                                    <input type="text" name="user" id="" value="" class="text"/>
                                </li>
                                <!--密码-->
                                <li>
                                    <input type="password" name="pwd" id="" value="" class="text"/>
                                </li>
                                <!--验证码-->
                                <li style="width: 300px;">
                                    <input type="text" name="code" id="" value="" class="text" style="float: left;width: 75px;"/>
                                    <div id="yanzheng">
                                        <img class="verify" src="<?php echo U(verify);?>" alt="验证码" onClick="this.src=this.src+'?'+Math.random()";/>
                                    </div>
                                    <a href="#">换一张</a>
                                </li>
                                <!--记住密码-->
                                <li>
                                    记住我
                                    <a href="#" style="margin-left: 70px;">忘记密码?</a>
                                </li>
                                <li>
                                    <input type="submit" name="" id="ok" value="登陆" class="button"/>
                                </li>
                            </ul>
                        </div>
                    </form>
                    <!--跳转到注册页面按钮-->
                    <div id="toRegister">
                        <span>还没注册?</span>
                        <span id="toReBtn" class="toBtn">
									注册
								</span>
                    </div>
                </div>
            </div>
            <!--注册框-->
            <form action="<?php echo U('registered');?>" method="post">
                <div class="register box">
                    <h3>用户注册</h3>
                    <div class="frame">
                        <div class="three">
                            <ul>
                                <!--昵称-->
                                <li>
                                    <input type="text" name="u_name" id="name" value="" class="text" placeholder="昵称(例:王大锤)"/>
                                </li>
                                <!--密码-->
                                <li>
                                    <input type="password" name="u_pwd" id="" value="" class="text" placeholder="密码(6-16个字符组成,区分大小写)"/>
                                </li>
                                <!--手机号-->
                                <li>
                                    <input type="text" name="u_email" id="email" value="" class="text" placeholder="填写常用手机号"/>
                                </li>
                                <!--手机验证码-->
                                <li>
                                    <input type="text" name="" id="code" value="" class="text" placeholder="手机验证码"/>
                                </li>
                                <!--注册按钮-->
                                <li>
                                    <input type="submit" name="" id="re" value="注册" class="button" onclick="return check();"/>
                                </li>
                            </ul>
                        </div>
                        <div class="four">
                            <ul>
                                <li id="nameMessage"></li>
                                <li></li>
                                <li id="emailMessage"></li>
                                <li><input type="button" value="点击获取"  class="toBtn" onclick="sendMail()"/></li>
                                <!--<li><a href="###" onclick="loadXMLDoc()">点击获取</a></li>-->
                                <li></li>
                            </ul>
                        </div>
            </form>
            <!--跳转到登陆页面按钮-->
            <div id="toLogin">
                <span>已经注册?</span>
                <span id="toLoBtn" class="toBtn">
									登陆
								</span>
            </div>
        </div>
    </div>
</div>
</div>
<!--二维码-->
<div class="right">
    <img src="img/749413009632672666.jpg"/>
    <span>扫二维码关注岭南校园公众号哟~</span>
</div>
</div>


		<!--主要内容-->
		<div id="main">
							
			<!--幻灯片-->
			<div id="container">
				<!--图片位置-->
				<div class="slider">
					<!--图片放多少张 下面的list对应就多少 自行添加或者删减-->
					<?php if(is_array($carousel)): foreach($carousel as $key=>$vo): ?><a href="<?php echo ($vo["c_url"]); ?>"><img src="<?php echo ($vo["c_pic"]); ?>"/></a><?php endforeach; endif; ?>
				</div>
				<div id="list">
			        <span class="on">1</span>
			        <span>2</span>
			        <span>3</span>
			        <span>4</span>
			        <span>5</span>
			    </div>
			    <div id="buttons">
			    	<div class="prev"><</div>
			    	<div class="next">></div>
			    </div>
			</div>
			
			<!--热门贴吧和用户已关注的贴吧-->
			<div id="hot_tieba" class="bsBox">
				<!--热门贴吧-->
				<div class="top">
					<h3>热门贴吧</h3><br />
					<!--贴吧1-->
					<?php if(!empty($popularBoard)): if(is_array($popularBoard)): foreach($popularBoard as $key=>$vo): ?><div class="info">
								<!--贴吧头像-->
								<a href="/lnc/Board/personal/id/<?php echo ($vo["b_id"]); ?>" ><img src="<?php echo ($vo["b_headicon"]); ?>" class="head"/></a>
								<div class="content bsBox">
									<!--贴吧名字-->
									<a href="/lnc/Board/personal/id/<?php echo ($vo["b_id"]); ?>" class="rgb"><?php echo ($vo["name"]); ?></a><br />
									<!--贴吧简介-->
									<span title="<?php echo ($vo["b_explain"]); ?>"><?php echo ($vo["b_explain"]); ?></span>
								</div>
							</div><?php endforeach; endif; ?>
						<?php else: ?>
						没有任何数据<?php endif; ?>


				</div>

				<!--我的贴吧-->
				<div class="my_tieba">
					<h3><?php echo ($b_title); ?></h3><br />
					<?php if(!empty($attention)): ?><!--贴吧1-->
						<?php if(is_array($attention)): foreach($attention as $key=>$vo): ?><div class="info">
								<!--贴吧头像-->
								<a href="/lnc/Board/personal/id/<?php echo ($vo["b_id"]); ?>"><img src="<?php echo ($vo["b_headicon"]); ?>" class="head"/></a>
								<div class="content bsBox">
									<!--贴吧名字-->
									<a href="/lnc/Board/personal/id/<?php echo ($vo["b_id"]); ?>" class="rgb"><?php echo ($vo["name"]); ?></a><br />
									<!--贴吧简介-->
									<span><?php echo ($vo["b_explain"]); ?></span>
								</div>
							</div><?php endforeach; endif; ?>
					<?php else: ?>
						没有数据<?php endif; ?>

				</div>
			</div>
							
			<!--热门推文-->
			<div id="hot_tuiwen" class="bsBox">
				<h3>热门推文</h3>

				<div class="content">
                    <?php if(!empty($tweets)): if(is_array($tweets)): foreach($tweets as $key=>$vo): ?><a href="#">
						<div class="box bsBox">
							<div class="title">
								<span class="top"><?php echo ($vo["title"]); ?></span><br />
								<div>
									<div class="time"><?php echo ($vo["t_date"]); ?></div>
									<div class="author"><?php echo ($vo["author"]); ?></div>
								</div>								
							</div>
							<div class="info">
								<div class="img"><img src="<?php echo ($vo["t_cover"]); ?>"/></div>
								<div class="content">
									<?php echo ($vo["content"]); ?>
								</div>
								<!--阅读数量-->
								<span style="color: silver">阅读数量</span>
								<span style="color: red;"><?php echo ($vo["t_read"]); ?></span>
								<span style="float: right;">阅读全文></span>
							</div>
						</div>
					</a><?php endforeach; endif; ?>
                    <?php else: ?>
                        没有任何数据<?php endif; ?>
				</div>
				<script src="/lnc/Public/js/noMargin.js" type="text/javascript" charset="utf-8"></script>
			</div>
		</div>

<!--页尾-->
<div id="bottom">

</div>
</body>
<script src="/lnc/Public/js/login_btn.js" type="text/javascript" charset="utf-8"></script>
<script src="/lnc/Public/js/tieba_btn.js" type="text/javascript" charset="utf-8"></script>
<script src="/lnc/Public/js/To.js" type="text/javascript" charset="utf-8"></script>
<script src="/lnc/Public/js/slider.js" type="text/javascript" charset="utf-8"></script>
</html>
</html>
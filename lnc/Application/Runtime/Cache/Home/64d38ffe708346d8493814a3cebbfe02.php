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
                        <?php if(!empty($plate)): if(is_array($plate)): foreach($plate as $key=>$vo): ?><a href="/lnc/Board/plate/id/<?php echo ($vo["p_id"]); ?>"><?php echo ($vo["p_name"]); ?></a><?php endforeach; endif; ?>
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


    <link rel="stylesheet" type="text/css" href="/lnc/Public/css/tuiwenindex.css" />
    <!--主要内容-->
    <div id="main">
        <?php if(!empty($tweets)): if(is_array($tweets)): foreach($tweets as $key=>$vo): ?><div class="twtop">
                    <div class="biaoti">
                        <h1><?php echo ($vo["title"]); ?></h1>
                    </div>
                    <div class="shijian">
                        <p><?php echo ($vo["t_date"]); ?></p>
                    </div>
                    <div class="zuozhe">
                        <span>作者：</span>
                        <span><?php echo ($vo["author"]); ?></span>
                    </div>
                </div>
                <div class="twmiddle">
                    <p><?php echo ($vo["content"]); ?></p>
                </div><?php endforeach; endif; ?>
            <?php else: ?>
            没有任何数据<?php endif; ?>

        <!--            下面的评论-->
        <div class="twfoot">
            <!--               评论-->
            <link rel="stylesheet" type="text/css" href="/lnc/Public/dist/css/wangEditor.min.css">
<div class="pinglun" style="height: 40%;width: 100%;">
    <input type="hidden" id="type" value="<?php echo ($type); ?>">
    <input type="hidden" id="id" value="<?php echo ($id); ?>">
    <div id="edit" style="height:250px">
        <p>请输入内容...</p>
    </div>
    <p  id="p"><input id="publishBtn" type="button" value="发表"/></p>

    <script type="text/javascript" src="/lnc/Public/dist/js/lib/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="/lnc/Public/dist/js/wangEditor.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var editor = new wangEditor('edit');
            editor.config.menuFixed = false;
            editor.config.uploadImgUrl = "<?php echo U(upload);?>";
            editor.config.hideLinkImg = true;
            editor.config.uploadImgFileName = 'picFile';
            editor.config.menus = [
                'bold',
                'underline',
                'italic',
                'strikethrough',
                'eraser',
                'forecolor',
                'bgcolor',
                'quote',
                'fontsize',
                'head',
                'unorderlist',
                'orderlist',
                'alignleft',
                'aligncenter',
                'alignright',
                'img',
                'video',
                'fullscreen'
            ];
            editor.create();
//            alert(createXMLHttpRequest().);

            $('#publishBtn').click(function () {
                // 获取编辑器区域完整html代码
                var html = editor.$txt.html();
                var id=$('#id').val();
                var type=$('#type').val();
                var url = "<?php echo U('postComment');;?>";
                var data = {'comment':html,'id':id,'type':type};
                var success = function (data) {
                    if(data.status==0){
                        alert(data.content);
                    }
                }
                $.post(url, data, success);
            });

        });

    </script>
</div>
            <!--                留言-->
            <div class="liuyan">
                <?php if(!empty($comment)): if(is_array($comment)): foreach($comment as $key=>$vo): ?><div class="ly">
                            <div class="yk">
                                <img src="<?php echo ($vo["u_headicon"]); ?>">
                                <p class="lytime"><?php echo ($vo["date"]); ?></p>
                            </div>
                            <p><?php echo ($vo["comment"]); ?></p>
                        </div><?php endforeach; endif; endif; ?>
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
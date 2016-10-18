<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>我的地盘贴吧</title>
    <link rel="stylesheet" type="text/css" href="/lnc/Public/css/personal_bar.css" />
</head>
<body>
<!-------------------------头部---------------------->
<div class="head-p">
    <!--图片背景-->
    <?php if(!empty($board)): if(is_array($board)): foreach($board as $key=>$vo): ?><img class="photo" src="<?php echo ($vo["b_cover"]); ?>"/>
            <!--吧主层-->

            <div class="personal">
                <div class="img-div">
                    <img class="img" src="<?php echo ($vo["b_headicon"]); ?>"/>
                </div>
                <div class="personal-top bsBox">
                    <div class="name">
                        <b style="font-size: 25px;"><?php echo ($vo["name"]); ?></b>
                    </div>
                    <!------------+关注按钮-->
                    <div class="translated">
                        <a href="#">+关注</a>
                    </div>
                    <!--关注人数，帖子数量总div-->
                    <div class="translated-num">
                        <?php if(!empty($attention_count)): ?><span>关注：</span>
                            <span><?php echo ($attention_count[0]['attention_count']); ?></span>
                            <?php else: ?>
                            <span>关注：</span>
                            <span>0</span><?php endif; ?>
                        <?php if(!empty($post_count)): ?><span>帖子：</span>
                            <span><?php echo ($post_count[0]['post_count']); ?></span>
                            <?php else: ?>
                            <span>帖子：</span>
                            <span>0</span><?php endif; ?>
                    </div>
                </div>
                <!--标签语言-->
                <!--word-->
                <div class="word">
                    <p class="cont">
                        <?php if(!empty($post_count)): echo ($vo["b_explain"]); ?>
                            <?php else: ?>
                            这个吧主很懒,什么也没留下...<?php endif; ?>
                    </p>
                </div>
            </div><?php endforeach; endif; endif; ?>

</div>
<!-------------------------中间部分------------------->
<div id="body-p">
    <!--大的面积部分-->
    <?php if(!empty($post)): if(is_array($post)): foreach($post as $key=>$vo): ?><div class="tall bsBox">
                <div class="title">
                    <p class="title-word"><a href="#"><?php echo ($vo["title"]); ?></a></p>
                    <div class="people">
                        <span>发布者：</span>
                        <span><?php echo ($vo["u_name"]); ?></span>
                    </div>
                    <div class="time">
                        <span><?php echo ($vo["p_date"]); ?></span>
                    </div>
                </div>
                <!--楼主里面内容-->
                <div class="content">
                    <?php echo ($vo["content"]); ?>
                </div>
            </div><?php endforeach; endif; endif; ?>
</div>
<!-------------------------尾部----------------------->
<div id="lass-p"></div>
</body>
</html>
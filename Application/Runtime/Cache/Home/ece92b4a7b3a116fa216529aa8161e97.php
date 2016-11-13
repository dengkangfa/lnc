<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="/lnc/Public/css/test.css"/>
</head>
<body>
<!--------------------------------顶部封面-------------------------------->
     <?php if(!empty($board)): if(is_array($board)): foreach($board as $key=>$vo): ?><div class="h_cover">
                <!--放头部背景图片图片位置-->
                <img src="<?php echo ($vo["b_cover"]); ?>" style="height: 100%; width:100%">
            </div>

            <!------------------中间内容------------------>
            <div class="middle" style="width: 100%;background: rgb(242,243,244);min-width:1100px;">
                <div class="m_block">

                    <!------------贴吧信息------------>
                    <div class="m_block_info">
                        <!------贴吧头像------>
                        <div  class="m_info_icon" >
                            <img class="img_headicon" src="<?php echo ($vo["b_headicon"]); ?>" alt="头像">
                        </div>
                        <!------贴吧信息------>
                        <div class="m_info_other">
                            <div class="m_info_name">                             <!------贴吧名字------>
                                <b style="font-size: 25px"><?php echo ($vo["b_name"]); ?></b>
                            </div>
                            <div class="m_info_atn">                              <!------关注按钮------>
                                <a  class="button_atn" href=""><?php echo ($attentionStatus); ?></a>
                            </div>
                            <div class="m_info_fans">                            <!------其它信息------>
                                <span>关注：</span>
                                <span><?php echo ($attention_count); ?></span>
                                <span>帖子：</span>
                                <span><?php echo ($post_count); ?></span>
                            </div>
                        </div>
                        <!------贴吧签名------>
                        <div class="m_info_signature">
                            <p><?php echo ($vo["b_explain"]); ?></p>
                        </div>
                    </div><?php endforeach; endif; ?>
     <?php else: ?>
     没有数据<?php endif; ?>

    <?php if(($p) == "0"): if(!empty($post)): if(is_array($post)): foreach($post as $key=>$vo): ?><!------------贴子内容------------>
                <div class="m_post">
                    <!------帖子标题------>
                    <div class="m_post_title">
                        <p><?php echo ($vo["title"]); ?></p>
                    </div>

                    <!------贴吧评论------>
                    <div class="m_post_comment">
                        <!------评论左块------>
                        <div class="m_post_comment_left" align="center">
                            <div class="m_comment_headicon">
                                <img class="img_headicon" src="<?php echo ($vo["u_headicon"]); ?>" alt="头像">                        <!------用户头像------>
                            </div>
                            <div class="m_comment_username">
                                <a href=""><?php echo ($vo["u_name"]); ?></a>                                                   <!------用户名字------>
                            </div>
                        </div>
                        <!------评论右块------>
                        <div class="m_post_comment_right">
                            <!------评论内容----富文本框内容------>
                            <div class="m_comment_content">
                                <?php echo ($vo["content"]); ?>
                            </div>
                            <!------评论信息------>
                            <div class="m_post_info">
                                <span>1楼</span>
                                <span><?php echo (date("Y-m-d H:i",$vo["p_date"])); ?></span>
                            </div>
                        </div>
                    </div>
                </div><?php endforeach; endif; ?>
        <?php else: ?>
        没有任何数据<?php endif; ?>
        <?php else: ?>

        回复:<?php echo ($title); endif; ?>

    <?php if(!empty($comment)): if(is_array($comment)): $i = 0; $__LIST__ = $comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><!------------贴子内容------------>
            <div class="m_post">
                <!------贴吧评论------>
                <div class="m_post_comment">
                    <!------评论左块------>
                    <div class="m_post_comment_left" align="center">
                        <div class="m_comment_headicon">
                            <img class="img_headicon" src="<?php echo ($vo["u_headicon"]); ?>" alt="头像">                        <!------用户头像------>
                        </div>
                        <div class="m_comment_username">
                            <a href=""><?php echo ($vo["u_name"]); ?></a>                                                   <!------用户名字------>
                        </div>
                    </div>
                    <!------评论右块------>
                    <div class="m_post_comment_right">
                        <!------评论内容----富文本框内容------>
                        <div class="m_comment_content">
                            <?php echo ($vo["comment"]); ?>
                        </div>
                        <!------评论信息------>
                        <div class="m_post_info">
                            <span><script type="text/javascript">document.write(<?php echo ($i+1); ?>+<?php echo (POST_COMMENT_PAGE); ?>*<?php echo ($p); ?>)</script>楼</span>
                            <span><?php echo (date('Y-m-d H:i',$vo["date"])); ?></span>
                        </div>
                    </div>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                <!------------页    码-------------->
                <div class="page">
                    <ul class="page_style">
                        <?php echo ($page); ?>
                        <!--<li><a href="#">上一页</a></li>-->
                        <!--<li><a href="#">1</a></li>-->
                        <!--<li><a href="#">2</a></li>-->
                        <!--<li><a href="#">3</a></li>-->
                        <!--<li><a href="#">下一页</a></li>-->
                    </ul>
                </div>
                <!--wangEditor-->
                <div class="comment">
                    <h3>发表评论</h3>
                    <div class="wangEditor">
                        <!--插入wangEditor位置-->
                        <link rel="stylesheet" type="text/css" href="/lnc/Public/dist/css/wangEditor.min.css">
<div class="pinglun" style="height: 40%;width: 100%;">
    <input type="hidden" id="type" value="<?php echo ($type); ?>">
    <input type="hidden" id="id" value="<?php echo ($id); ?>">
    <div id="edit" style="height:340px">
        <p>请输入内容...</p>
    </div>
    <!--<p  id="p"><input id="publishBtn" type="button" value="发表"/></p>-->

    <script type="text/javascript" src="/lnc/Public/dist/js/lib/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="/lnc/Public/dist/js/wangEditor.min.js"></script>
</div>
                    </div>
                    <div class="m_submit_atn">
                        <a id="publishBtn" class="submit_atn" >提交</a>
                    </div>
                </div>
            </div>

        </div>
</body>
<script type="text/javascript" src="/lnc/Public/js/postWangEditor.js"></script>
</html>
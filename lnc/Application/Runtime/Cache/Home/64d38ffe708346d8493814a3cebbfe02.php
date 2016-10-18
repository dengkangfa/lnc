<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>111</title>
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
    <div class="twtop">
        <div class="biaoti">
            <h1>技研预览会</h1>
        </div>
        <div class="shijian">
            <p>2016-10-13</p>
        </div>
        <div class="zuozhe">
            <span>作者：</span>
            <span>庄晓强</span>
        </div>
    </div>
    <div class="twmiddle">
        <p>【学习进行时】10月10日至11日召开的全国国有企业党的建设工作会议上，习近平总书记发表了重要讲话，从坚持和发展中国特色社会主义、巩固党的执政基础执政地位的高度，深刻回答了事关国有企业改革发展和党的建设的一系列重大问题，是加强新形势下国有企业党的建设的纲领性文献。

            新华网“学习进行时”原创品牌栏目“讲习所”今天推出《习近平为国有企业强“根”固“魂”》，为您解读这篇讲话的重要思想。



            　　10月10日至11日，全国国有企业党的建设工作会议在北京举行。中共中央总书记、国家主席、中央军委主席习近平出席会议并发表重要讲话。新华社记者 兰红光 摄

            国企的“根”和“魂”在哪里？

            我国经济进入新常态，动力转换、方式转变、结构调整的任务十分繁重。国有企业作为国民经济发展的中坚力量，必须发挥带头作用，模范执行各项改革决策，成为改革的主力军和先行者。

            习近平总书记多次强调要理直气壮做强做优做大国有企业，尽快在国企改革重要领域和关键环节取得新成效。这次讲话，习近平进一步提出要求，要使国有企业“成为党和国家最可信赖的依靠力量，成为坚决贯彻执行党中央决策部署的重要力量，成为贯彻新发展理念、全面深化改革的重要力量，成为实施‘走出去’战略、‘一带一路’建设等重大战略的重要力量，成为壮大综合国力、促进经济社会发展、保障和改善民生的重要力量，成为我们党赢得具有许多新的历史特点的伟大斗争胜利的重要力量”。

            习近平强调，要坚持有利于国有资产保值增值、有利于提高国有经济竞争力、有利于放大国有资本功能的方针。

            要坚持好3个“有利于”，加强和完善党对国有企业的领导、加强和改进国有企业党的建设是最大的前提。习近平指出，坚持党的领导、加强党的建设，是我国国有企业的光荣传统，是国有企业的“根”和“魂”，是我国国有企业的独特优势。

            为国有企业强“根”固“魂”，习近平具体提出了新形势下国有企业坚持党的领导、加强党的建设的总要求：坚持党要管党、从严治党，坚持党对国有企业的领导不动摇；坚持服务生产经营不偏离；坚持党组织对国有企业选人用人的领导和把关作用不能变；坚持建强国有企业基层党组织不放松。这个总要求突出问题导向，针对一些国有企业不同程度存在党的建设弱化、淡化、虚化、边缘化，基层党组织软弱涣散等问题，作出部署。

            20字要求体现两个“一以贯之”

            习近平强调，坚持党对国有企业的领导是重大政治原则，必须一以贯之；建立现代企业制度是国有企业改革的方向，也必须一以贯之。习近平将这两个“一以贯之”并列，意在表明二者是相辅相成、不可割裂的关系。

            习近平指出，中国特色现代国有企业制度，“特”就特在把党的领导融入公司治理各环节，把企业党组织内嵌到公司治理结构之中，明确和落实党组织在公司法人治理结构中的法定地位，做到组织落实、干部到位、职责明确、监督严格。

            处理好两个“一以贯之”的关系，习近平对国有企业生产经营中的重要环节提出许多具体要求，作出全面部署。

            国有企业领导人员是党在经济领域的执政骨干，是治国理政复合型人才的重要来源，肩负着经营管理国有资产、实现保值增值的重要责任。第一职责就是为党工作。

            习近平对国有企业领导人员提出了“对党忠诚、勇于创新、治企有方、兴企有为、清正廉洁”的20字要求，“对党忠诚”排在第一，就是要求国有企业领导人员牢固树立政治意识、大局意识、核心意识、看齐意识，把爱党、忧党、兴党、护党落实到经营管理各项工作中。

            党管国有企业，离不开工人阶级。习近平指出，坚持全心全意依靠工人阶级的方针，是坚持党对国有企业领导的内在要求。他强调要健全以职工代表大会为基本形式的民主管理制度。

            全面从严治党从3个“基本”严起

            加强和完善党对国有企业的领导、加强和改进国有企业党的建设，就必须全面从严治党。

            全面从严治党如何在国有企业落实落地？习近平说：“必须从基本组织、基本队伍、基本制度严起。要同步建立党的组织、动态调整组织设置。要把党员日常教育管理的基础性工作抓紧抓好。企业党组织‘三会一课’要突出党性锻炼。要让支部成为团结群众的核心、教育党员的学校、攻坚克难的堡垒。要把思想政治工作作为企业党组织一项经常性、基础性工作来抓，把解决思想问题同解决实际问题结合起来，既讲道理，又办实事，多做得人心、暖人心、稳人心的工作。”

            习近平指出，要坚持党管干部原则，保证党对干部人事工作的领导权和对重要干部的管理权，保证人选政治合格、作风过硬、廉洁不出问题。国有企业党委（党组）要履行主体责任，严肃查处侵吞国有资产、利益输送等问题。

            同时，习近平特别强调，要突出监督重点，强化对关键岗位、重要人员特别是一把手的监督管理，完善“三重一大”决策监督机制，严格日常管理，整合监督力量，形成监督合力。</p>
    </div>
    <!--            下面的评论-->
    <div class="twfoot">
        <!--               评论-->
        <link rel="stylesheet" type="text/css" href="/lnc/Public/dist/css/wangEditor.min.css">
<div class="pinglun">
    <div id="div1">
        <p>请输入内容...</p>
    </div>

    <script type="text/javascript" src="/lnc/Public/dist/js/lib/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="/lnc/Public/dist/js/wangEditor.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var editor = new wangEditor('div1');
            editor.create();
        });
    </script>
</div>
        <!--                留言-->
        <div class="liuyan">
            <div class="ly">
                <div class="yk">
                    <img src="img/749413009632672666.jpg">
                    <p class="lytime">2010-2-2</p>
                </div>
                <p>倒萨大看都不看</p>
            </div>
            <div class="ly">
                <div class="yk">
                    <img src="img/749413009632672666.jpg">
                    <p class="lytime">2010-2-2</p>
                </div>
                <p>saudhusadhak</p>
            </div>
            <div class="ly">
                <div class="yk">
                    <img src="img/749413009632672666.jpg">
                    <p class="lytime">2010-2-2</p>
                </div>
                <p>sakhcsajcnjkanc</p>
            </div>
            <div class="ly">
                <div class="yk">
                    <img src="img/749413009632672666.jpg">
                    <p class="lytime">2010-2-2</p>
                </div>
                <p>achbcnsdbciu</p>
            </div>
            <div class="ly">
                <div class="yk">
                    <img src="img/749413009632672666.jpg">
                    <p class="lytime">2010-2-2</p>
                </div>
                <p>sajdnjkasndjkasn</p>
            </div>
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
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--引入wangEditor.css-->
    <link rel="stylesheet" type="text/css" href="/lnc/Public/wangEditor-2.1.20/dist/css/wangEditor.min.css">
    <title>Title</title>
</head>
<body>
<div style="width:90%">
    <!--用当前元素来控制高度-->
    <div id="div1" style="height:400px;max-height:500px;">
        <p>请输入内容...</p>
    </div>
</div>
</body>
<script type="text/javascript" src="/lnc/Public/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="/lnc/Public/wangEditor-2.1.20/dist/js/wangEditor.min.js"></script>
<script type="text/javascript">
    var editor = new wangEditor('div1');
    editor.config.uploadImgUrl = '//lnc/Public/upload';
    // 配置自定义参数（举例）
//    editor.config.uploadParams = {
//        token: 'abcdefg',
//        user: 'wangfupeng1988'
//    };

//    // 设置 headers（举例）
//    editor.config.uploadHeaders = {
//        'Accept' : 'text/x-json'
//    };
    editor.create();
</script>
</html>
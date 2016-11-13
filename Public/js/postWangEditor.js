/**
 * Created by Administrator on 2016/10/23.
 */
/**
 * Created by Administrator on 2016/10/23.
 */
$(function () {
    var editor = new wangEditor('edit');
    editor.config.menuFixed = false;
    editor.config.uploadImgUrl='/lnc/Comment/upload';
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

    //让编辑器失去焦点
    $('#edit').blur();

    //获取焦点时清空编辑器文字
    $('#edit').focus(function () {
        if(trim(editor.$txt.text())=='请输入内容...' && isLegalTag(editor.$txt.html())==null){
            editor.clear();
        }
    });

    //失去焦点，如果编辑器内容为空，则出相应提示
    $('#edit').blur(function () {
        if(trim(editor.$txt.text())=='' && isLegalTag(editor.$txt.html())==null){
            editor.$txt.html('<p>请输入内容...</p>');
        }
    });
    //清空字符串前后空格
    function trim(str) {
        return str.replace(/(^\s*)|(\s*$)/g, "");
    }

    //验证是否存在img/iframe标签
    function isLegalTag(str){
        var reg=/(<img(.*?)>)|(<iframe(.*?)>)/;
        return str.match(reg);
    }

    // function isImage(){
    //     filepath=$("#pro_img").val();
    //     var extStart=filepath.lastIndexOf(".");
    //     var ext=filepath.substring(extStart,filepath.length).toUpperCase();
    //     if(ext!=".BMP"&&ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
    //         alert("图片限于png,gif,jpeg,jpg格式");
    //     }
    // }

    //提交评论
    $('#publishBtn').click(function () {
        if(isLegalTag(editor.$txt.html())==null && (trim(editor.$txt.text())=='请输入内容...' || trim(editor.$txt.text())=='')){
            alert('内容不能为空');
            $('#edit').focus();
        }else {
            // 获取编辑器区域完整html代码
            var html = editor.$txt.html();
            var id = $('#id').val();
            var type = $('#type').val();
            var url = "/lnc/Comment/postComment";
            var data = {'comment': html, 'id': id, 'type': type};
            var success = function (data) {
                if (data.status == 0) {
                    alert(data.content);
                } else {
                    history.go(0);
                }
            }
            $.post(url, data, success);
        }
    });


});

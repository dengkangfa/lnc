/**
 * Created by Administrator on 2016/10/23.
 */
$(function () {
    var editor = new wangEditor('edit');
    editor.config.menuFixed = false;
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
        'video',
        'fullscreen'
    ];
    editor.create();

    //让编辑器失去焦点
    $('#edit').blur();

    //获取焦点时清空编辑器文字
    $('#edit').focus(function () {
        if(Trim(editor.$txt.text())=='请输入内容...'){
            editor.clear();
        }
    });

    //失去焦点，如果编辑器内容为空，则出相应提示
    $('#edit').blur(function () {
        if(Trim(editor.$txt.text())==''){
            editor.$txt.html('<p>请输入内容...</p>');
        }
    });
    //清空字符串前后空格
    function Trim(str) {
        return str.replace(/(^\s*)|(\s*$)/g, "");
    }

    $('#publishBtn').click(function () {
        if(Trim(editor.$txt.text())=='请输入内容...' || Trim(editor.$txt.text())==''){
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

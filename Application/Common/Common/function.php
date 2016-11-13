<?php
/**
 * User: Administrator
 */

/**
 * 验证字符长度
 * @param $str 需要验证的字符串
 * @param $min 最小长度
 * @param $max 最大长度
 * @return bool
 * author Fox
 */
function fn_check_length($str,$min,$max){
    preg_match_all("/./u",$str,$matches);
    $len=count($matches[0]);
    if($len<$min||$len>$max){
        return false;
    }else{
        return true;
    }
}

/**
 * 验证系统验证码
 * @param $code 用户输入的验证码
 * @param $id   对应的entry编号
 * @return bool
 * author Fox
 */
function fn_check_verify($code,$id=''){
    $verify=new \Think\Verify();
    return $verify->check($code,$id);
}

/**
 * 生成随机验证码
 * @param $length 指定生成验证码的长度
 * @return string 验证码
 * author Fox
 */
function fn_create_code($length){
    $code='';
    for($a=0;$a<$length;$a++){
        $code.=rand(0,9);
    }
    return $code;
}

/**
 * 发送邮件
 * @param $address 接收者地址
 * @param $title   邮件标题
 * @param $content  邮件内容
 * @return bool
 * author Fox
 */
function fn_send_email($address,$title,$content){
    Vendor('PHPMailer.class#phpmailer');
    $mail = new PHPMailer();                //实例化
    $mail->IsSMTP();
    //设置使用smtp服务
    $mail->CharSet='UTF-8';                 //设置编码
    $mail->Host=EMAIL_HOST;                 //smtp服务器
    $mail->Username=EMAIL_USER_NAME;        //发送方账号
    $mail->Password=EMAIL_USER_PASSWORD;    //发送方密码
    $mail->AddAddress($address);            //添加收件者邮箱
    $mail->From=EMAIL_USER_NAME;
    $mail->FromName='岭南校园';
    $mail->isHTML(true);
    $mail->Subject=$title;                  //邮件主题
    $mail->Body=$content;                   //邮件正文
    $mail->SMTPAuth=true;
    return($mail->Send());

}

/**
 * 配置相应验证码字段，并将最终生成的验证码对象返回
 * @return Verify
 * author Fox
 */
function fn_get_verify_obj(){
    $config =    array(
        'fontSize'    =>    12,    // 验证码字体大小
        'length'      =>    4,     // 验证码位数
        'useCurve'    =>    true,  // 是否画混淆曲线
        'useNoise'    =>    false,  // 关闭验证码杂点
        'expire'      =>    60,    // 验证码有效期（秒）
        'useImgBg'    =>    true,  // 使用背景图片
//            'useZh'       =>    true,  // 使用中文验证码
        'imageW'      =>    100,   // 验证码宽度
        'imageH'      =>    30,    // 验证码高度
//            'fontttf'     =>    'simhei.ttf', // 验证码字体
    );
    $verify=new \Think\Verify($config);
    $verify->fontttf = '5.ttf';
    return $verify;
}

/**
 * 图片上传函数，设置限制字段，初始化upload对象
 * @param $savePath 图片文件存放的位置
 * @return \Think\Upload
 * author Fox
 */
//function fn_get_imgupload_obj($savePath){
//    $upload=new \Think\Upload();   //实例化上传类
//    $upload->maxSize=3145728;   //设置上传大小，字节
//    $upload->exts=array('jpg','png','jpeg');//限制后缀
//    $upload->rootPath='./Public/uploads/';
//    $upload->savePath=$savePath;
//    return $upload;
//}

//过滤XSS攻击
function reMoveXss($val) {
    // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
    // this prevents some character re-spacing such as <java\0script>
    // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
    $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);

    // straight replacements, the user should never need these since they're normal characters
    // this prevents like <IMG SRC=@avascript:alert('XSS')>
    $search = 'abcdefghijklmnopqrstuvwxyz';
    $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $search .= '1234567890!@#$%^&*()';
    $search .= '~`";:?+/={}[]-_|\'\\';
    for ($i = 0; $i < strlen($search); $i++) {
        // ;? matches the ;, which is optional
        // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars
        // @ @ search for the hex values
        $val = preg_replace('/(&#[xX]0{0,8}' . dechex(ord($search[$i])) . ';?)/i', $search[$i], $val); // with a ;
        // @ @ 0{0,7} matches '0' zero to seven times
        $val = preg_replace('/(&#0{0,8}' . ord($search[$i]) . ';?)/', $search[$i], $val); // with a ;
    }

    // now the only remaining whitespace attacks are \t, \n, and \r
    $ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'script', 'embed', 'object', 'iframe', 'frameset', 'ilayer', 'layer', 'bgsound', 'base');
    $ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
    $ra = array_merge($ra1, $ra2);

    $found = true; // keep replacing as long as the previous round replaced something
    while ($found == true) {
        $val_before = $val;
        for ($i = 0; $i < sizeof($ra); $i++) {
            $pattern = '/';
            for ($j = 0; $j < strlen($ra[$i]); $j++) {
                if ($j > 0) {
                    $pattern .= '(';
                    $pattern .= '(&#[xX]0{0,8}([9ab]);)';
                    $pattern .= '|';
                    $pattern .= '|(&#0{0,8}([9|10|13]);)';
                    $pattern .= ')*';
                }
                $pattern .= $ra[$i][$j];
            }
            $pattern .= '/i';
            $replacement = substr($ra[$i], 0, 2) . '<x>' . substr($ra[$i], 2); // add in <> to nerf the tag
            $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
            if ($val_before == $val) {
                // no replacements were made, so exit the loop
                $found = false;
            }
        }
    }
    return $val;
}

/**
 * 判断$date长度是否为$length
 * @param $date
 * @param $length
 * @return bool
 */
function fn_is_length($data,$length){
    if(mb_strlen(trim($data),'utf-8')==$length) return true;
    return false;
}

/**
 * 验证邮箱格式
 * @param $data
 * @return bool
 * author Fox
 */
function fn_check_email($data){
    if(preg_match('/^\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}$/',$data))return true;
    return false;
}

/**
 * 验证昵称
 * @param $data
 * @return bool
 * author Fox
 */
function fn_check_name($data){
    if(preg_match('/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{2,10}$/u',$data))
        return true;
    return false;
}

/**
 * 验证密码
 * @param $data
 * @return bool
 * author Fox
 */
function fn_check_pwd($data){
    if(preg_match('/^[a-z]\w{6,12}$/i',$data))
        return true;
    return false;
}

//验证是否存在img/iframe标签
function isLegalTag($data){
    if (preg_match('/(<img(.*?)>)|(<iframe(.*?)>)/',$data))
        return true;
    return false;
}

/**
 * 无提示跳转
 * @param $url 指定跳转地址
 * author Fox
 */
function fn_jump(){
    //重新加载页面
    echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
}


/**
 * 生成相应的分页对象，以及对数据进行分页处理
 * @param $m 模型操作类
 * @param $where 筛选条件
 * @param int $pagesize 每页条数
 * @return \Think\Page 分页对象
 * author Fox
 */
function fn_getpage(&$m,$where,$pagesize=8){
    $m1=clone $m;//浅复制一个模型
    $count = $m->where($where)->count();//连惯操作后会对join等操作进行重置
    $m=$m1;//为保持在为定的连惯操作，浅复制一个模型
    $p=new Think\Page($count,$pagesize);
    $p->lastSuffix=false;
    $p->rollPage=5;//控制显示的页码数
    $p->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;<b>%NOW_PAGE%</b>/<b>%TOTAL_PAGE%</b>页</li>');
    $p->setConfig('prev','上一页');
    $p->setConfig('next','下一页');
    $p->setConfig('last','末页');
    $p->setConfig('first','首页');
    $p->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');

    $p->parameter=I('get.');

    $m->limit($p->firstRow,$p->listRows);

    return $p;
}

/* End of file function.php*/
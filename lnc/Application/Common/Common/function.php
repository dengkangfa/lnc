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
    $mail = new PHPMailer(); //实例化
    $mail->IsSMTP();
    $mail->CharSet='UTF-8';
    $mail->AddAddress($address);
    $mail->Body=$content;
    $mail->From='m13590098323@163.com';
    $mail->FromName='岭南校园';
    $mail->Subject=$title;
    $mail->Host='smtp.163.com';
    $mail->SMTPAuth=true;
    $mail->Username='m13590098323@163.com';
    $mail->Password='qq7750825';
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
    if(preg_match('[\u4e00-\u9fa5_a-zA-Z0-9_]{2,10}',$data))
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

/**
 * 无提示跳转
 * @param $url 指定跳转地址
 * author Fox
 */
function fn_jump($url){
    echo "<script language='javascript'
    type='text/javascript'>";
    echo "window.location.href='".U($url)."'";
    echo "</script>";
}
/* End of file function.php*/
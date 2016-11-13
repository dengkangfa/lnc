<?php

/**
 * User: Administrator
 */
namespace Home\Event;
use Think\Controller;

class EmailEvent extends Controller{
    /**
     * 发送邮件
     * author Fox
     */
    public function sendEmail(){
        //判断是否恶意访问
        if(IS_POST){
            //获取get所有数据
            $data=I('post.');
            $email=$data['email'];
            $code=$data['code'];
            if($email && $code) {
                //验证$email格式是否符合要求
                if (preg_match('/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/', $email)) {
                    session('code', $code);
                    $result=fn_send_email($email, '岭南校园注册', $code);
                    if($result) {
                        $feedback['status'] = 1;
                        $feedback['content'] = '邮件已发';
                        $this->ajaxReturn($feedback);
                    }else{
                        $feedback['status'] = 0;
                        $feedback['content'] = '系统繁忙';
                        $this->ajaxReturn($feedback);
                    }
                } else {
                    $feedback['status']=0;
                    $feedback['content']='邮箱格式不合法';
                    $this->ajaxReturn($feedback);
                }
            }else{
                $feedback['status']=0;
                $feedback['content']='请填写邮箱';
                $this->ajaxReturn($feedback);
            }
        }else{
            $feedback['status']=0;
            $feedback['content']='非法操作';
            $this->ajaxReturn($feedback);
        }
    }
}
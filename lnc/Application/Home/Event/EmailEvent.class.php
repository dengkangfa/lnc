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
        if(IS_GET){
            //获取get所有数据
            $data=I('get.');
            $email=$data['email'];
            $code=$data['code'];
            if($email && $code) {
                //验证$email格式是否符合要求
                if (preg_match('/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/', $email)) {
                    session('code', $code);
                    $result=fn_send_email($email, '岭南校园注册', $code);
                    if($result) {
                        $data['status'] = 1;
                        $data['content'] = '邮件已发';
                        $this->ajaxReturn($data);
                    }else{
                        $data['status'] = 0;
                        $data['content'] = '系统繁忙';
                        $this->ajaxReturn($data);
                    }
                } else {
                    $data['status']=0;
                    $data['content']='邮箱格式不合法';
                    $this->ajaxReturn($data);
                }
            }else{
                $data['status']=0;
                $data['content']='非法操作';
                $this->ajaxReturn($data);
            }
        }else{
            $data['status']=0;
            $data['content']='非法操作';
            $this->ajaxReturn($data);
        }
    }
}
<?php
/**
 * 用户控制器
 */

namespace Home\Controller;


use Home\Common\Controller\CommonController;
use Home\Event\EmailEvent;

class UserController extends CommonController{
    public function verifyOnly(){
        $user=M('User');
        if(IS_POST) {
            $data = I('post.');
            if($data['verifier']==='n') {
                $map['u_name'] = $data['u_name'];
                $count = $user->where($map)->count();
                if ($count == 0) {
                    $data['status'] = 1;
                    $data['content'] = '该用户可以使用';
                    $this->ajaxReturn($data);
                } else {
                    $data['status'] = 0;
                    $data['content'] = '该用户已被使用';
                    $this->ajaxReturn($data);
                }
            }else{
                $map['u_email'] = $data['u_email'];
                $count = $user->where($map)->count();
                if ($count == 0) {
                    $data['status'] = 1;
                    $data['content'] = '该邮件可以使用';
                    $this->ajaxReturn($data);
                } else {
                    $data['status'] = 0;
                    $data['content'] = '该邮件已注册';
                    $this->ajaxReturn($data);
                }
            }
        }else{
            $data['status']=0;
            $data['content']='error';
            $this->ajaxReturn($data);
        }

    }

    public function registered(){
        echo 1;
        $this->display();
    }

    /**
     * 生成随机验证码，并将生成的验证码存放进seesion，还发送至用户邮箱
     * author Fox
     */
    public function sendEmail(){
        $email=new EmailEvent();
        $email->sendEmail();
    }
}
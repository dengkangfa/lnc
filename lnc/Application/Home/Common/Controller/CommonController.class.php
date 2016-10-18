<?php

/**
 * User: Administrator
 */
namespace Home\Common\Controller;
use Think\Controller;

class CommonController extends Controller{
    public function _initialize(){
        //获取cookie信息
        $cookie=cookie('User');
        //将获取到的cookie进行解密解压再反序列化回原来的数据格式
        $user=unserialize(gzuncompress(base64_decode($cookie)));
        if(is_array($user) && count($user)){
            session('User',$user['u_name']);
        }
        //将用户名赋值过去视图，如其值不为空，则生成用户名信息模块，反之生成登录模块
        $this->assign('user', $user['u_name']);
        //获取版块模型句柄
        $plate=M('plate');
        $this->assign('plate',$plate->select());
    }

    /**
     * 生成验证码
     * author Fox
     */
    public function verify(){
        $verify=fn_get_verify_obj();
        $verify->entry();
    }



    /**
     * 登录操作
     * author Fox
     */
    public function login(){
        //判断是否恶意访问
        if(IS_POST){
            //获取User模型
            $user=D('User');
            //获取所有表单信息
            $data=I('post.');
            if(is_array($data) && $data) {
                //判断用户是否完善表单数据
                foreach ($data as $value){
                    if(empty($value)){
                        $this->error('请完善表单数据');
                    }
                }
                //验证用户输入的信息
                if(!fn_is_length($data['code'],4)) $this->error('验证码必须四位');
                if(!fn_check_verify($data['code'])){  $this->error('验证码输入有误');};
                if(!fn_check_email($data['user']) || fn_check_name($data['user'])) $this->error('用户名的格式不正确');
                if(!fn_check_pwd($data['pwd'])) $this->error('密码的格式不正确');
                //判断用户是使用何种方式登录
                if(fn_check_email($data['user'])){
                    //查询用户是否存在
                    $result=$user->where('u_email="'.$data['user'].'" and u_pwd="'.md5($data['pwd']).'"')->limit(1)->getField('u_id,u_name,u_email',1);
                    //判断查询结果
                    if(is_array($result) && count($result)>0){
                        foreach ($result as $value){
                            //将用户信息序列号压缩并加密
                            cookie('User',base64_encode(gzcompress(serialize($value))));
                        }
                        //重新加载页面
                        fn_jump('../Main');
                    }else{
                        $this->error('账号/密码错误');
                    }
                }else if(fn_check_name($data['user'])){
                    echo 1;
                }else{
                    $this->error('发生意想不到的错误！');
                }
            }else{
                $this->error('非法操作');
            }
        }else{
            $this->error('非法操作');
        }
    }

    /**
     * 注销操作
     * author Fox
     */
    public function unLogin(){
        cookie('User',null);
        session('User',null);
        fn_jump('index');
    }

    /**
     * 注册操作
     * author Fox
     */
    public function registered(){
        if(IS_POST){
            //加载User模型
            $user=D('User');
            $data=I('post.');
            //验证字段合法性
            if($user->create($data)){
                //将数据添加进数据库
                if($user->add()){
                    //默认新注册的用户，账号信息保持一天
                    cookie('User',base64_encode(gzcompress(serialize($data))),86400);
                    //跳转回index操作
                    fn_jump('index');
                }else{
                    $this->error("数据写入失败");
                }
            }else{
                echo $user->getError();
            }
        }else{
            $this->error("非法操作");
        }
    }

}
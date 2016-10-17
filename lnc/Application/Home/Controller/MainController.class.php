<?php
/**
 * 首页控制器
 */
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class MainController extends Controller {
    /**
     * 人口操作，判断用户是否登录，如登录则加载相应数据，反之加载游客数据。
     * author Fox
     */
    public function index(){
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
        //获取轮播图模型句柄
        $carousel=M('carousel');
        //直接将轮播图的结果集对象赋值到视图，让其进行迭代遍历出数据.
        $this->assign('carousel',$carousel->select());
        //热门贴吧
        $board=M('board');
        //通过关联贴吧表与贴子表，获取贴吧对应的贴子浏览量的总和，进行排序获得前三贴吧
        $popularBoard=$board->join('lnc_post on lnc_board.b_id=lnc_post.b_id')
                        ->join('lnc_board_name on lnc_board.b_id=lnc_board_name.b_id')
                    ->join('lnc_board_explain on lnc_board.b_id=lnc_board_explain.b_id')
                ->group('lnc_board_name.name,lnc_board_explain.b_explain')
            ->limit(3)
            ->Field('lnc_board_name.name,lnc_board_explain.b_explain,lnc_board.b_headicon,SUM(lnc_post.p_read) as count')
            ->select();
        $this->assign('popularBoard',$popularBoard);

        //我的贴吧/推荐贴吧数据
        //根据用户是否登录和其是否关注贴吧判断，当他登录并且有关注的贴吧时，显示我的贴吧模块，
        //反之如果没有登录或者登录了都没有关注的贴吧，则显示推荐贴吧。
        $map['u_id']=$user['u_id'];
        if($map['u_id'] !=''){
            //通过当前登录对象的’u_id‘去筛选其关注的贴吧，通过判断结果集的条数，判断是否存在关注的贴吧
            $boarAttention=M(boardAttention);
            $attentionCount=$boarAttention->where($map)->count();
        }else{
            $attentionCount=0;
        }
        //当用户登录，并且存在关注的贴吧，则去获取其关注的贴吧数据，反之获取推荐
        if(!empty(session('User')) && $attentionCount !=0 && $map['u_id'] !=''){
            //获取关注的贴吧id
            $result=$boarAttention->where($map)->field('b_id')->select();
            unset($map);
            foreach($result as $value){
                $filter[]=$value['b_id'];
            }
            //获取关注的贴吧表数据
            $map['b_id']=array('in',$filter);
            $board=$board->where($map)->select();
            unset($map);
            //通过关联表获取需要贴吧的简介和贴吧名称
            foreach($board as &$value){
                $map['b_id']=$value['b_id'];
                $model=new Model();
                //获取简介
                $explain=$model->table('lnc_board_explain')->where($map)->limit(1)->field('b_explain')->select();
                $value['explain']=$explain[0]['b_explain'];
                //获取贴吧名称
                $name=$model->table('lnc_board_name')->where($map)->limit(1)->field('name')->select();
                $value['name']=$name[0]['name'];
            }
            unset($map);
            $this->assign('b_title','我的贴吧');
            $this->assign('attention',$board);

        }else{
            unset($map);
            $this->assign('b_title','推荐贴吧');
        }

        //获取推文模型句柄
        $tweets=M('tweets');
        //筛选出审核通过的推文
        $map['t_state']='2';
        $data=$tweets->where($map)->join('lnc_tweets_title on lnc_tweets.t_id=lnc_tweets_title.t_id')
                    ->join('lnc_tweets_content on lnc_tweets.t_id=lnc_tweets_content.t_id')
                ->join('lnc_tweets_author on lnc_tweets.t_id=lnc_tweets_author.t_id')
            ->order('lnc_tweets.t_date')
            ->select();
        //将每条数据的时间戳转换成日期格式
        foreach ($data as &$value){
            $value['t_date']=date("Y-m-d",$data['t_date']);
        }
        $this->assign('tweets',$data);
        //渲染视图
        $this->display();
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
     * 生成随机验证码，并将生成的验证码存放进seesion，还发送至用户邮箱
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
                    $result=fn_send_mail($email, '岭南校园注册', $code);
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
                if(!fn_check_verify($data['code'])) $this->error('验证码输入有误');
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
        fn_jump('../Main');
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
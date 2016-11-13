<?php
/**
 * User: Administrator
 */

namespace Home\Controller;


use Think\Controller;
use Think\Image;
use Think\Model;

class BoardManageController extends Controller{
    //贴吧管理员首页
    public function index(){
        //这里应该使用post提交用户id
        $u_id=I('get.id');
        //判断用户id是否存在
        if(IS_GET && !empty($u_id) && is_numeric($u_id)){
            //判断用户是否登录
            if (session('User') && session('u_id')) {
                //获取贴吧资源
                $Model = M('board');
                $map['u_id'] = $u_id;
                $result = $Model->where($map)->field('b_id')->select();
                if ($result) {
                    $this->assign('u_id', $u_id);
                    $this->display();
                } else {
                    $this->error('你没有权限访问该页面');
                }
            }else{
                $this->error('请先在首页登录',U('Main/index'));
            }
        }else{
            $this->error('你访问的页面不存在！');
        }
    }
    //渲染页头操作
    public function top(){
        $this->display();
    }
    public function left(){
        $u_id=I('get.id');
        if(IS_GET && !empty($u_id) && is_numeric($u_id)){
            $Model=M('board');
            //筛选条件
            $map['u_id']=$u_id;
            $result=$Model->where($map)->field('b_id')->select();
            if($result){
                $this->assign('u_id',$u_id);
                $this->assign('b_id',$result[0]['b_id']);
            }else{
                $this->error('你没有权限访问该页面');
            }
        }
        $this->display();
    }
    //渲染右侧页面
    public function right(){
        $this->display();
    }

    /**
     * 贴吧头像管理操作
     */
    public function updateBoardAvatar(){
        //获取对应的贴吧id
        $b_id=I('get.id');
        if($b_id){
            //筛选条件
            $map['b_id']=$b_id;
            $Model=M('board');
            $result=$Model->where($map)->select();
            $this->assign('b_headicon',$result[0]['b_headicon']);
            $this->assign('b_id',$result[0]['b_id']);
            $this->display();
        }
    }

    /**
     * 设置贴吧头像
     */
    public function setAvatar(){
        $b_id=I('get.id');
        if($b_id){
            //筛选条件
            $map['b_id']=$b_id;
            $Model=M('board');
            $result=$Model->where($map)->select();
            $this->assign('b_headicon',$result[0]['b_headicon']);
            $this->assign('b_id',$result[0]['b_id']);
        }
        $this->assign('prev_url',PREV_URL);
        $this->display();
    }

    /**
     * 封面管理操作
     */
    public function updateCover(){
        $b_id=I('get.id');
        if($b_id){
            //筛选条件
            $map['b_id']=$b_id;
            //获取贴吧资源句柄
            $Model=M('board');
            $result=$Model->where($map)->select();
            $this->assign('b_cover',$result[0]['b_cover']);
            $this->assign('b_id',$result[0]['b_id']);
        }
        $this->display();
    }

    /**
     * 设置封面操作
     */
    public function setCover(){

    }

    /**
     * 贴吧签名管理操作
     */
    public function updateSignatrue(){
        $b_id=I('get.id');
        $Model=M('boardExplain');
        $map['b_id']=$b_id;
        //判断是否存在表单提交，如果存在则重新设置贴吧签名
        if($_POST['send']){
            $explain=I('post.explain');
            //重设值
            $data['b_explain']=$explain;
            $Model->where($map)->save($data);
        }
        //加载当前贴吧签名信息
        if($b_id){
            $result=$Model->where($map)->limit(1)->select();
            $this->assign('b_explain',$result[0]['b_explain']);
            $this->assign('b_id',$result[0]['b_id']);
        }
        $this->display();
    }

    /**
     * 管理员转让管理操作
     */
    public function transferManage(){
        //获取当前管理员id以及当前贴吧id
        $b_id=I('get.b_id');
        $u_id=I('get.u_id');
        $Model=M('user');
        if($b_id && $u_id){
            //获取当前管理员身份
            $map['u_id']=$u_id;
            $result=$Model->where($map)->field('u_name')->select();
            $name=$result[0]['u_name'];
            $this->assign('name',$name);
        }
        $this->display();
    }

    /**
     * 修改当前贴吧管理员
     */
    public function updateManage(){
        if(IS_POST){
            $data=I('post.');
            $recipient=$data['recipient'];
            if(!empty($recipient)){
                if(fn_check_email($recipient)){
                    $Model=M('user');
                    $map['u_email']=$recipient;
                }elseif(fn_check_name($recipient)){
                    $Model=M('user');
                    $map['u_name']=$recipient;
                }else{
                    echo '<script>alert("格式不正确！");</script>';
                    exit();
                }
                $result=$Model->where($map)->field('u_id')->select();
                $r_id=$result[0]['u_id'];
//                $map['u_name']=$data['user'];
//                $result=$Model->where($map)->field('u_id')->select();
                $u_id=I('get.id');
                if($r_id){
                    $map=null;
                    $map['u_id']=$u_id;
                    $data['u_id']=$r_id;
                    $Model=M('board');
                    if($Model->where($map)->save($data)){
                        $this->success('转让成功！');
                    }else{
                        $this->error('转让失败');
                    }
                }else{
                    $this->error('转让的账号不存在');
                }
            }else{
                echo '<script>alert("请输入转让的账号");</script>';
                exit();
            }
        }
    }

    /**
     * 显示当前贴吧的所有贴子
     */
    public function postManagement(){
        $b_id=I('get.id');
        if($b_id) {
            //通过当前贴吧id，获取对应的贴子id
            $map['b_id']=$b_id;
            $Model = M('post');
            //生成分页对象
            $page = fn_getpage($Model,$map);
            $post = $Model->where($map)->field('p_id')->select();
            foreach ($post as $value) {
                $postArray[]=$value['p_id'];
            }
            if(!empty(count($postArray))){
                //在通过贴子id查询对应贴子的贴子名称以及贴子id
                $Model=M('postTitle');
                $map=null;
                //只查询出贴子id在当前贴子id数组的对象
                $map['p_id']=array('in',$postArray);
                $result=$Model->where($map)->select();
                $this->assign('page', $page->show());
                $this->assign('post', $result);
            }
        }
        $this->display();
    }

    /**
     * 贴子编辑
     */
    public function postEditor(){
        $p_id=I('get.id');
        if($p_id){
            $Model=M('postContent');
            $map['lnc_post_content.p_id']=$p_id;
            $result=$Model->where($map)
                ->join('lnc_post_title ON lnc_post_Content.p_id=lnc_post_title.p_id')
                ->limit(1)
                ->select();
            $this->assign('postDetails',$result);
        }
        $this->display();
    }

    /**
     * 贴子删除操作
     */
    public function postDelete(){
        if(IS_GET){
            $p_id=I('get.id');
            $Model=D('Post');
            $map['p_id']=$p_id;
            if($Model->relation(true)->delete($p_id)){
                fn_jump();
            }else{
                echo $Model->getError();
                $this->error('删除失败');
            }
        }

    }

    /**
     * 发表推文操作
     */
    public function publishTweets()
    {
        if (IS_POST) {
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3145728;// 设置附件上传大小
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath = IMAGE_ROOT_PATH; // 设置附件上传根目录
            $upload->savePath = '/img/'; // 设置附件上传（子）目录
            $upload->subName = array('date', 'Y-m-d');
            $now = $_SERVER['REQUEST_TIME'];
            $upload->saveName = array('uniqid', $now);//上传文件的保存规则
            // 上传文件
            $info = $upload->upload();
            if (!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            } else {// 上传成功
                $Model = D('Tweets');
                foreach ($info as $value) {
                    $data['t_cover'] = '/lnc/Public/uploads'.$value['savepath'] . $value['savename'];
                    $image=new Image();
                    $image->open(IMAGE_ROOT_PATH.$value['savepath'] . $value['savename']);
                    $image->thumb(200, 200)->save(IMAGE_ROOT_PATH.$value['savepath'] . $value['savename']);
                    $data['u_id'] = session('u_id');
                    $data['t_date'] = time();
                    $data['tweets_content'] = array(
                        'content' => $_POST['content'],
                    );
                    $data['tweets_title'] = array(
                        'title' => I('post.title'),
                    );
                    $data['tweets_author'] = array(
                        'author' => session('User'),
                    );
                    $data['tweets_synopsis'] = array(
                        'synopsis' => I('post.synopsis'),
                    );
                    if($Model->create($data)){
                        if ($Model->relation(true)->add($data)) {
                            $this->success('上传成功！');
                        }
                    }
                }

            }
            print_r($data);
        } else {
            $this->error('非法操作');
        }
    }

    /**
     * 推文管理(疑问：当管理员转让时，之前该管理员所发的推文如何处理，因为推文是通过用户id进行捆绑处理的)
     */
    public function tweetsManagement(){
        //获取当前管理员用户id
        $u_id=I('get.u_id');
        if(!empty($u_id)) {
            //获取推文资源句柄
            $Model = D('tweets');
            //筛选条件
            $map['u_id'] = $u_id;
            //获取分页对象
            $page = fn_getpage($Model,$map);
            $result=$Model->where($map)->relation('tweets_title')->select();
            $this->assign('tweets',$result);
            $this->assign('page',$page->show());
        }
        $this->display();
    }

    /**
     * 获取单个推文详细内容，如果t_id不存在则显示对应的发表推文表单
     */
    public function selectTweets(){
        if(IS_GET && !empty($_GET['t_id'])){
            $map['t_id']=I('get.t_id');
            $Model=D('tweets');
            $array=array('tweets_title','tweets_synopsis','tweets_content');
            $result=$Model->where($map)->relation($array)->select();
            $this->assign('tweets',$result);
        }
        $this->display('publishTweets');
    }

    public function deleteTweets(){
        if(IS_GET){
            $t_id=I('get.t_id');
            $Model=D('Tweets');
            $map['t_id']=$t_id;
            if($Model->relation(true)->delete($t_id)){
                fn_jump();
            }else{
                echo $Model->getError();
                $this->error('删除失败');
            }
        }
    }

//    public function updateTweets(){
//        if(IS_POST && !empty($_POST['id'])){
//            $map['t_id']=I('post.t_id');
//            $Model=D('tweets');
////            if($Model->create()) {
//                $Model->where($map)->relation(true)->save();
////            }else{
////                $this->error('数据不合法');
////            }
//        }else{
//            $this->error('非法操作');
//        }
//    }

    /**
     * 设置个人头像操作
     */
    public function updateUserAvatar(){
        //获取对应的贴吧id
        $u_id=I('get.u_id');
        if($u_id){
            //筛选条件
            $map['u_id']=$u_id;
            $Model=M('User');
            $result=$Model->where($map)->select();
            $this->assign('u_headicon',$result[0]['u_headicon']);
            $this->assign('u_id',$result[0]['u_id']);
            $this->display();
        }
    }

    /**
     * 修改用户头像
     */
    public function setUserAvatar(){
        $u_id=I('get.u_id');
        if($u_id){
            //筛选条件
            $map['u_id']=$u_id;
            $Model=M('User');
            $result=$Model->where($map)->select();
            $this->assign('u_headicon',$result[0]['u_headicon']);
            $this->assign('u_id',$result[0]['u_id']);
        }
        $this->assign('prev_url',PREV_URL);
        $this->display();
    }

    /**
     * 设置个人签名操作
     */
    public function setExplain(){
        $u_id=I('get.u_id');
        $Model=M('User');
        $map['u_id']=$u_id;
        //判断是否存在表单提交，如果存在则重新设置用户签名
        if($_POST['send']){
            $explain=I('post.explain');
            //重设值
            $data['u_explain']=$explain;
            $Model->where($map)->save($data);
        }
        //加载当前用户签名信息
        if($u_id){
            $result=$Model->where($map)->field('u_id,u_explain')->limit(1)->select();
            $this->assign('u_explain',$result[0]['u_explain']);
            $this->assign('u_id',$result[0]['u_id']);
        }
        $this->display();
    }

    public function resetWord(){
        $u_id=I('get.u_id');
        $map['u_id']=$u_id;
        $Model=D('User');
        if(IS_GET && !empty($u_id) && is_numeric($u_id)){
            $result=$Model->where($map)->field('u_id,u_pwd')->limit(1)->select();
            $this->assign('u_id',$result[0]['u_id']);
            $this->assign('u_pwd',$result[0]['u_pwd']);
        }elseif(IS_POST && !empty($_POST['send'])){

        }else{
            $this->error('非法操作');
        }
        $this->display();
    }

    public function upload(){
        cookie('User',null);
        session('User',null);
        session('u_id',null);
        echo "<script type='text/javascript'>top.location.href='/lnc';</script>";
    }

}
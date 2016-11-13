<?php
/**
 * User: Administrator
 */

namespace Home\Controller;
use Home\Common\Controller\CommonController;
use Home\Event\UploadEvent;
use Think\Page;

class TweetsController extends CommonController{
    public function index(){
//       //获取推文资源句柄
        $tweets = D('TweetsView');
        $map['t_state']='2';
        //数据分页并且返回分页对象
        $page=fn_getpage($tweets,$map);
        //获取推文标题，推文作者，推文发布日期，推文内容
        $Tweets=$tweets->where($map)->order('tweets.t_date desc')->select();
        $show=$page->show();
        //将每条数据的时间戳转换成日期格式
//        foreach ($Tweets as &$value){
//            $value['t_date']=date("Y-m-d",$value['t_date']);
//        }
        //赋值
        $this->assign('page',$show);
        $this->assign('tweets',$Tweets);
        $this->display();
    }

    public function tweetDetails(){
        //推问详情页面

        //推文唯一ID
        $t_id = I('get.id');
        if(empty($t_id) || !is_numeric($t_id)){
            $this->error('你访问的页面不存在！');
        }
        $this->assign('id',$t_id);
        $this->assign('type','tw');
        //获取推文资源句柄
        $tweets = M('Tweets');
        //被点击阅读量+1
        $map['t_id']=$t_id;
        $tweets->where($map)->setInc('t_read',1);
        //获取推文标题，推文作者，推文发布日期，推文内容
        $Tweets = $tweets
            ->join('lnc_tweets_title ON lnc_tweets.t_id = lnc_tweets_title.t_id')
            ->join('lnc_tweets_author ON lnc_tweets.t_id = lnc_tweets_author.t_id')
            ->join('lnc_tweets_content ON lnc_tweets.t_id = lnc_tweets_content.t_id')
            ->where("lnc_tweets.t_id = $t_id")
            ->field('lnc_tweets_title.title,lnc_tweets_author.author,lnc_tweets.t_date,lnc_tweets_content.content')
            ->select();
        //将每条数据的时间戳转换成日期格式
//        foreach ($Tweets as &$value){
//            $value['t_date']=date("Y-m-d",$value['t_date']);
//        }
        //赋值
        $this->assign('tweets',$Tweets);

        //获取推文评论资源句柄
        $comment = M('tweets_comment');
        //获取推文的评论用户头像，评论用户名，评论内容，评论日期
        $Comment = $comment
            ->join('lnc_tweets ON lnc_tweets_comment.t_id = lnc_tweets.t_id')
            ->join('lnc_user ON lnc_tweets_comment.u_id = lnc_user.u_id')
            ->where("lnc_tweets.t_id = $t_id")
            ->field('lnc_user.u_headicon,lnc_user.u_name,lnc_tweets_comment.comment,lnc_tweets_comment.date')
            ->select();
        //将每条数据的时间戳转换成日期格式
//        foreach ($Comment as &$value){
//            $value['date']=date("Y-m-d",$value['date']);
//        }
        //赋值
        $this->assign('comment',$Comment);
        //渲染视图
        $this->display();
    }

//    //
//    public function upload(){
//        $upload=new UploadEvent();
//        $upload->uploadImg();
//    }


//    public function GenerateComments(){
//        $t_id = I('get.id');
//        $t_id=6;
//        //获取推文评论资源句柄
//        $comment = M('tweetsComment');
//        //获取推文的评论用户头像，评论用户名，评论内容，评论日期
//        $Comment = $comment
//            ->join('lnc_tweets ON lnc_tweets_comment.t_id = lnc_tweets.t_id')
//            ->join('lnc_user ON lnc_tweets_comment.u_id = lnc_user.u_id')
//            ->where("lnc_tweets.t_id = $t_id")
//            ->field('lnc_user.u_headicon,lnc_user.u_name,lnc_tweets_comment.comment,lnc_tweets_comment.date')
//            ->select();
//        //将每条数据的时间戳转换成日期格式
//        foreach ($Comment as &$value){
//            $value['date']=date("Y-m-d",$value['date']);
//        }
//        //赋值
//        $this->assign('comment',$Comment);
//        $this->display('Tweets/tweetDetails');
//    }

}
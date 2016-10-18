<?php
/**
 * User: Administrator
 */

namespace Home\Controller;
use Home\Common\Controller\CommonController;

class TweetsController extends CommonController{
    public function index(){
//        //推文首页
//        $cookie=cookie('User');
//        //将获取到的cookie进行解密解压再反序列化回原来的数据格式
//        $user=unserialize(gzuncompress(base64_decode($cookie)));
//        print_r($user);
//        if(is_array($user) && count($user)){
//            session('User',$user['u_name']);
//        }
//        $this->assign('user', $user['u_name']);
        $this->display();
    }

    public function tweetDetails($id){
        //推问详情页面

        $t_id = $id;
        $tweet = M('tweets');
        $Tweet = $tweet
            ->join('lnc_tweets_title ON lnc_tweets.t_id = lnc_tweets_title.t_id')
            ->join('lnc_tweets_author ON lnc_tweets.t_id = lnc_tweets_author.t_id')
            ->join('lnc_tweets_content ON lnc_tweets.t_id = lnc_tweets_content.t_id')
            ->where("lnc_tweets.t_id = $t_id")
            ->field('lnc_tweets_title.title,lnc_tweets_author.author,lnc_tweets.t_date,lnc_tweets_content.content')
            ->select();
        $this->assign('tweets',$Tweet);

        $comment = M('tweets_comment');




        $this->display();
    }
}
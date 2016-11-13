<?php
/**
 * 首页控制器
 */
namespace Home\Controller;
use Home\Common\Controller\CommonController;
use Home\Event\EmailEvent;
use Think\Model;

class MainController extends CommonController{
    /**
     * 人口操作，判断用户是否登录，如登录则加载相应数据，反之加载游客数据。
     * author Fox
     */
    public function index(){
        $cookie=cookie('User');
        //将获取到的cookie进行解密解压再反序列化回原来的数据格式
        $user=unserialize(gzuncompress(base64_decode($cookie)));
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
                            ->group('lnc_board_name.b_name,lnc_board_explain.b_explain')
                            ->limit(3)
                            ->Field('lnc_board.b_id,lnc_board_name.b_name,lnc_board_explain.b_explain,lnc_board.b_headicon,SUM(lnc_post.p_read) as count')
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
//        $user=session('User');
        if(!empty($user) && $attentionCount !=0 && $map['u_id'] !=''){
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
                $value['b_explain']=$explain[0]['b_explain'];
                //获取贴吧名称
                $name=$model->table('lnc_board_name')->where($map)->limit(1)->field('b_name')->select();
                $value['b_name']=$name[0]['b_name'];
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
            ->order('lnc_tweets.t_read desc,lnc_tweets.t_date desc')
            ->limit(8)
            ->select();
        $this->assign('tweets',$data);
        //渲染视图
        $this->display();
    }


}
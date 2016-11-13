<?php
/**
 * 贴子控制器
 */

namespace Home\Controller;



use Think\Controller;

class PostController extends Controller  {
    //获取贴子信息操作
    public function index(){
        //获取当前贴子id
        $p_id=I('get.id');
        //如果id为空或者id不是数字则判断用户操作有误！
        if(empty($p_id) || !is_numeric($p_id)){
            $this->error('你访问的页面不存在！');
        }
        //获取分页
        $p=I('get.p');
        //当分页p为第一页，也就是p为0或者1时，将其赋值为0，原因是为了楼层的计算，
        //反之不是第一页评论，则将其相应的值减去1
        if($p >1){
            $p-=1;
        }else{
            $p=0;
        }
        $this->assign('p',$p);
        //获取贴子模型句柄
        $Model=M('Post');
        $map['p_id']=$p_id;
        //查询其对应的贴吧id
        $result=$Model->where($map)->field('b_id')->limit(1)->select();
        $b_id=$result[0]['b_id'];
        //获取贴吧资源句柄
        $board = D('Board');
        //获取贴吧头像，封面，名字，签名
        $Board = $board->alias('b')
            ->join('lnc_board_name ON b.b_id = lnc_board_name.b_id')
            ->join('lnc_board_explain ON b.b_id = lnc_board_explain.b_id')
            ->group('lnc_board_name.b_name,lnc_board_explain.b_explain')
            ->where("b.b_id=$b_id")
            ->field('b.b_headicon,b.b_cover,lnc_board_name.b_name,lnc_board_explain.b_explain')
            ->select();
//        //赋值
//        $this->assign('id',$b_id);
        $this->assign('board',$Board);
        //获取贴吧关注资源句柄
        $boardAttention=M('boardAttention');
        //通过贴吧id与用户id去查询用户是否已关注当前贴吧
        $map['b_id']=$b_id;
        $map['u_id']=session('u_id');
        //通过获取查询关注表的结果集判断是否关注
        $result=$boardAttention->where($map)->count();
        if($result==0){
            $this->assign('attentionStatus','+关注');
        }else{
            $this->assign('attentionStatus','已关注');
        }
        unset($map);

        //获取帖子资源句柄
        $Model = M('post');
        //获取帖子数量资源
        $Post_count = $Model
            ->where("b_id=$b_id")
            ->count();
        //赋值
        $this->assign('post_count',$Post_count);

        //获取帖吧关注资源句柄
        $attention = M('board_attention');
        //获取贴吧被关注数量
        $Attention_count = $attention
            ->where("b_id=$b_id")
            ->count();//获取关注数量
        //赋值
        $this->assign('attention_count',$Attention_count);

        //如果当前页为贴子首页，则生成贴子相应的信息，反之生成回复+标题
        if($p==0) {
            $map['lnc_post.p_id'] = $p_id;
            $map['lnc_post.b_id'] = $b_id;
            //获取帖子标题，内容，发布日期，作者
            $Post = $Model
                ->join('lnc_post_title ON lnc_post.p_id = lnc_post_title.p_id')
                ->join('lnc_post_content ON lnc_post.p_id = lnc_post_content.p_id')
                ->join('lnc_user ON lnc_post.u_id = lnc_user.u_id')
                ->group('lnc_post_title.title,lnc_post_content.content,lnc_post.p_date,lnc_user.u_name')
                ->where($map)
                ->field('lnc_post.p_id,lnc_post_title.title,lnc_post_content.content,lnc_post.p_date,lnc_user.u_name,lnc_user.u_headicon')
                ->select();
//            print_r($Post);
//            exit();
            //将每条数据的时间戳转换成日期格式
//            foreach ($Post as &$value) {
//                $value['p_date'] = date("Y-m-d H:i", $value['p_date']);
//            }
            unset($map);
        }else{
            //获取贴子标题模型句柄
            $postTitle=M('postTitle');
            //查询当前贴子的标题
            $map['p_id']=$p_id;
            $title=$postTitle->where($map)->field('title')->limit(1)->select();
            $this->assign('title',$title[0]['title']);
            unset($map);
        }

        //获取贴子评论资源句柄
        $Model=M('postComment');
        $map['p_id']=$p_id;
        //生成分页对象，并且将数据进行分页
        $page=fn_getpage($Model,$map,POST_COMMENT_PAGE);
        $show=$page->show();
        $comment=$Model->where($map)
            ->join('lnc_user ON lnc_post_comment.u_id=lnc_user.u_id')
            ->field('lnc_post_comment.comment,lnc_post_comment.date,lnc_user.u_name,lnc_user.u_headicon')
            ->select();
//        //将每条数据的时间戳转换成日期格式
//        foreach ($comment as &$value){
//            $value['date']=date("Y-m-d H:i",$value['date']);
//        }
        //赋值
        //当前贴子的id
        $this->assign('id',$p_id);
        //当前页的类型，主要是为了评论时可以标识当前评论的类型以及对象id，方便
        //相应的表增添数据
        $this->assign('type','tz');
        //评论数据对象
        $this->assign('comment',$comment);
        //当前贴子信息对象
        $this->assign('post',$Post);
        //分页对象
        $this->assign('page',$show);

        $this->display();
    }

}
<?php
/**
 * 贴吧控制器
 */

namespace Home\Controller;


use Home\Common\Controller\CommonController;

class BoardController extends CommonController {
    public function index(){
        //贴吧首页
        $this->display();
    }
    public function personal($id){
        //具体到那个班级那个社团的贴吧页面

        $b_id = $id;//贴吧ID
        $board = M('board');
        $Board = $board->alias('b')
            ->join('lnc_board_name ON b.b_id = lnc_board_name.b_id')
            ->join('lnc_board_explain ON b.b_id = lnc_board_explain.b_id')
            ->group('lnc_board_name.name,lnc_board_explain.b_explain')
            ->where("b.b_id=$b_id")
            ->field('b.b_headicon,b.b_cover,lnc_board_name.name,lnc_board_explain.b_explain')
            ->select();//获取贴吧头像，封面，名字，签名，
    //        var_dump($Board);
        $this->assign('board',$Board);

        $post = M('post');
        $Post = $post
            ->join('lnc_board ON lnc_post.b_id = lnc_board.b_id')
            ->join('lnc_post_title ON lnc_post.p_id = lnc_post_title.p_id')
            ->join('lnc_post_content ON lnc_post.p_id = lnc_post_content.p_id')
            ->join('lnc_user ON lnc_post.u_id = lnc_user.u_id')
            ->group('lnc_post_title.title,lnc_post_content.content,lnc_post.p_date,lnc_user.u_name')
            ->where("lnc_board.b_id=$b_id")
            ->field('lnc_post_title.title,lnc_post_content.content,lnc_post.p_date,lnc_user.u_name')
            ->select();//获取帖子标题，内容，发布日期，作者
    //        var_dump($Post);
        $this->assign('post',$Post);

        $Post_count = $post
            ->where("b_id=$b_id")
            ->field('count(lnc_post.b_id) as post_count')
            ->select();
    //        var_dump($Post_count);
        $this->assign('post_count',$Post_count);

        $attention = M('board_attention');
        $Attention_count = $attention
            ->where("b_id=$b_id")
            ->field('count(lnc_board_attention.b_id) as attention_count')
            ->select();//获取关注数量
    //        var_dump($Attention_count);
        $this->assign('attention_count',$Attention_count);




        $this->display();
    }
}
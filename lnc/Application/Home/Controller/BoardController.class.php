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

    public function plate(){
        $p_id=I('get.id');
        if(empty($p_id) || !is_numeric($p_id)){
            $this->error('你访问的页面不存在！');
        }
        $Model=M('Board');
        $map['lnc_board.p_id']=$p_id;
        $board=$Model->join('lnc_board_name ON lnc_board.b_id=lnc_board_name.b_id')
                ->join('lnc_board_explain ON lnc_board.b_id=lnc_board_explain.b_id')
                    ->join('lnc_board_attention ON lnc_board.b_id=lnc_board_attention.b_id')
                        ->group('lnc_board_name.b_name,lnc_board_explain.b_explain')
                            ->where($map)->field('lnc_board.b_id,lnc_board.b_headicon,lnc_board_name.b_name,lnc_board_explain.b_explain,COUNT(*) u_count')
                                ->select();
        foreach ($board as $key => &$value) {
            $map['lnc_board.b_id']=$value['b_id'];
            $result=$Model->where($map)->join('lnc_post ON lnc_board.b_id=lnc_post.b_id')->field('COUNT(*) as p_count')->select();
            $value['p_count']=$result[0]['p_count'];
        }

        $this->assign('plate_board',$board);
        $this->display();
    }

    /**
     * 贴吧详情页面
     * @param $id
     * author Fox
     */
    public function personal(){
        //具体到那个班级那个社团的贴吧页面

//        //贴吧ID
        $b_id = I('get.id');
        if(empty($b_id) || !is_numeric($b_id)){
            $this->error('你访问的页面不存在！');
        }
//        //获取贴吧资源句柄
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

        $this->assign('id',$b_id);
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
        //获取帖子资源句柄
        $post = M('post');
        //获取帖子标题，内容，发布日期，作者
        $Post = $post
            ->join('lnc_board ON lnc_post.b_id = lnc_board.b_id')
            ->join('lnc_post_title ON lnc_post.p_id = lnc_post_title.p_id')
            ->join('lnc_post_content ON lnc_post.p_id = lnc_post_content.p_id')
            ->join('lnc_user ON lnc_post.u_id = lnc_user.u_id')
            ->group('lnc_post_title.title,lnc_post_content.content,lnc_post.p_date,lnc_user.u_name')
            ->where("lnc_board.b_id=$b_id")
            ->field('lnc_post_title.title,lnc_post_content.content,lnc_post.p_date,lnc_user.u_name')
            ->select();
        //将每条数据的时间戳转换成日期格式
        foreach ($Post as &$value){
            $value['p_date']=date("Y-m-d",$Post['p_date']);
        }
        //赋值
        $this->assign('post',$Post);

        //获取帖子数量资源
        $Post_count = $post
            ->where("b_id=$b_id")
            ->field('count(lnc_post.b_id) as post_count')
            ->select();
        //赋值
        $this->assign('post_count',$Post_count);

        //获取帖吧关注资源句柄
        $attention = M('board_attention');
        //获取贴吧被关注数量
        $Attention_count = $attention
            ->where("b_id=$b_id")
            ->field('count(lnc_board_attention.b_id) as attention_count')
            ->select();//获取关注数量
        //赋值
        $this->assign('attention_count',$Attention_count);
        //渲染视图
        $this->display();
    }

    public function attention(){
        echo '关注';
    }

    public function unSubscribe(){
        echo '取消关注';
    }
}
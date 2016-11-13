<?php
/**
 * User: Administrator
 */

namespace Home\Controller;


use Home\Event\UploadEvent;
use Think\Controller;

/**
 * 评论控制器，通过判断是推文评论或是贴子评论实例化不同的模型句柄。
 * 并通过验证是否满足对应模型句柄的验证条件。
 * 再将数据添加进数据库
 * @package Home\Controller
 * anthor Fox
 */
class CommentController extends Controller{
    public function postComment(){
        if(IS_POST) {
            //由于如果使用I函数会过滤html标签，所有使用原生的$_POST操作获取评论内容。
            $comment = $_POST['comment'];
            //获取评论对象的id，评论类型的文章，参数
            $postData = I('post.');
            //判断用户是否登录,判断用户评论内容是否为空
            if(empty(session('u_id'))){
                $feedback['status']=0;
                $feedback['content']='你还没有登录,请先登录！';
                $this->ajaxReturn($feedback);
                exit(0);
            }elseif(empty(trim(strip_tags($comment))) && !isLegalTag($comment)){
                $feedback['status']=0;
                $feedback['content']='评论内容不能为空！';
                $this->ajaxReturn($feedback);
                exit(0);
            }
            //将当前时间，当前登录的用户id，以及评论的内容存放进数组中
            $data['date'] = time();
            $data['u_id'] = session('u_id');
            //判断评论的类型
            if ($postData['type'] == 'tw') {
                $model = M('tweetsComment');
                $data['t_id'] = $postData['id'];
            } elseif ($postData['type'] = 'tz') {
                $model = M('postComment');
                $data['p_id'] = $postData['id'];
                if(preg_match_all('/tmp[^\"]*/',$comment,$temp)){
                    $upload=new UploadEvent();
                    $upload->pubImg($temp,$comment);
                }

            } else {
                $feedback['status']=0;
                $feedback['content']='非法操作！';
                $this->ajaxReturn($feedback);
            }
            $data['comment']=$comment;
            //验证字段
            if($model->create($data)){
                $model->add($data);
                $feedback['status'] = 1;
                $feedback['content'] = '评论成功';
                $this->ajaxReturn($feedback);
            }else{
                $feedback['status']=0;
                $feedback['content']=$model->getError();
                $this->ajaxReturn($feedback);
            }
        }
    }

    /**
     * 评论插入图片操作
     * author Fox
     */
    public function upload(){
        $upload=new UploadEvent();
        $upload->uploadImg();
    }



}
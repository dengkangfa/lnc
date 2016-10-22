<?php
/**
 * User: Administrator
 */

namespace Home\Model;


use Think\Model\ViewModel;

class PostViewModel extends ViewModel{
    public $viewFields=array(
        'post'=>array('p_id','b_id','u_id','p_date','p_read'),
        'post_content'=>array('content','_on'=>'post.p_id=post_content.p_id'),
        'post_title'=>array('title','_on'=>'post.p_id=post_title.p_id'),
    );

}
<?php
/**
 * User: Administrator
 */

namespace Home\Model;


use Think\Model\ViewModel;

class TweetsViewModel extends ViewModel{
    public $viewFields=array(
        'tweets'=>array('t_id','t_date','t_cover','t_read','t_state'),
        'tweets_author'=>array('author','_on'=>'tweets.t_id=tweets_author.t_id'),
        'tweets_content'=>array('content','_on'=>'tweets.t_id=tweets_content.t_id'),
        'tweets_title'=>array('title','_on'=>'tweets.t_id=tweets_title.t_id'),
    );
}
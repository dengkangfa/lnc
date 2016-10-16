<?php
/**
 * User: Administrator
 */

namespace Home\Controller;


use Think\Controller;

class TweetsController extends Controller{
    public function index(){
        //推文首页
        $this->display();
    }

    public function tweetDetails(){
        $this->display();
    }
}
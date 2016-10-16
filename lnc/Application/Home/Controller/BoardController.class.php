<?php
/**
 * 贴吧控制器
 */

namespace Home\Controller;


use Think\Controller;

class BoardController extends Controller{
    public function index(){
        //贴吧首页
        $this->display();
    }
    public function personal(){
        //具体到那个班级那个社团的贴吧页面
        $this->display();
    }
}
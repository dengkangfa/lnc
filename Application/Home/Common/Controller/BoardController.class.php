<?php
/**
 * User: Administrator
 */

namespace Home\Common\Controller;


use Think\Controller;

class BoardController extends Controller{
    protected function _initialize(){
        $u_id=I('get.id');
        if(IS_GET && !empty($u_id) && is_numeric($u_id)){
            $Model=M('board');
            $map['u_id']=$u_id;
            $result=$Model->where($map)->field('b_id')->select();
            if($result){
                $this->assign('u_id',$u_id);
                $this->assign('b_id',$result[0]['b_id']);
                $this->display();
            }else{
                $this->error('你没有权限访问该页面');
            }
        }else{
            $this->error('你访问的页面不存在！');
        }
    }
}
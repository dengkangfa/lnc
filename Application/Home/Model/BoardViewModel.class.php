<?php
/**
 * User: Administrator
 */

namespace Home\Model;


use Think\Model\ViewModel;

class BoardViewModel extends ViewModel{
    public $viewFields=array(
        'board'=>array('b_id','b_headicon','b_cover'),
        'board_explain'=>array('b_explain','_on'=>'board.b_id=board_explain.b_id'),
        'board_name'=>array('b_name','_on'=>'board.b_id=board_name.b_id'),
        'board_attention'=>array('u_id','_on'=>'board.b_id=board_attention.b_id')
    );
}
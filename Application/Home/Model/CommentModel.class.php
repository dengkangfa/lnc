<?php
/**
 * User: Administrator
 */

namespace Home\Model;


use Think\Model;

class CommentModel extends Model{
    protected $fields=array('t_id','u_id','comment','date');
    protected $_validate=array(

    );
}
<?php

/**
 * 贴子模型类
 */
namespace Home\Model;
use Think\Model;

class PostModel extends Model{
    protected $fields=array('p_id','b_id','u_id','p_date','p_state','p_read','comment','content','title');
    protected $_validate=array(
        array('p_state',array(1,2),'贴子状态系数不在指定范围',self::EXISTS_VALIDATE,'in',self::MODEL_BOTH),
        array('title','require','贴子标题不得为空'),
        array('title','check_length','贴子标题不得超过50位',self::EXISTS_VALIDATE,'function',self::MODEL_BOTH,array(1,50)),
    );
    protected $_auto=array(
        array('p_date','time','','function'),
    );
}
/* End of file PostModel.php*/
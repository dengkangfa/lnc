<?php
/**
 * User: Administrator
 */

namespace Home\Model;


use Think\Model\RelationModel;

class TweetsModel extends RelationModel{
    protected $_link=array(
        'tweets_content'=>array(
            'mapping_type'=>self::HAS_ONE,
            'mapping_name'=>'tweets_content',
            'foreign_key'=>'t_id',
            'mapping_fields'=>'content',
            'as_fields'=>'content',
        ),
        'tweets_title'=>array(
            'mapping_type'=>self::HAS_ONE,
            'mapping_name'=>'tweets_title',
            'foreign_key'=>'t_id',
            'mapping_fields'=>'title',
            'as_fields'=>'title'
        ),
        'tweets_author'=>array(
            'mapping_type'=>self::HAS_ONE,
            'mapping_name'=>'tweets_author',
            'foreign_key'=>'t_id',
            'mapping_fields'=>'author',
            'as_fields'=>'author'
        )
    );

}
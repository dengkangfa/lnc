<?php

/**
 * 用户模型类
 */
namespace Home\Model;
use Think\Model;

class UserModel extends Model {
    protected $fields=array('u_id','u_name','u_pwd','u_email','u_headicon','u_permission','u_explain','u_rstdate');
    /**
     * 字段自动验证，对表处理时，如果该字段存在时，uname(用户名)不得为空，并且不得与存在的用户名冲突，upass(密码)不得为空，并且介于六位到十六位，
     * uemail(邮箱)邮箱不得为空并至今没有被其他用户注册过，userpermission(权限),权限系数只能是1(普通用户)或者2(贴吧管理员)
     * urstdate(注册时间)只有在插入数据时才进行验证。
     */
    protected $_validate=array(
        array('u_name','require','用户名不能为空！'),
        array('u_name','/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{2,10}$/u','用户名格式不正确',self::MUST_VALIDATE,'regex',self::MODEL_BOTH),
        array('u_name','','用户名已存在',self::EXISTS_VALIDATE,'unique',self::MODEL_BOTH),
        array('u_pwd','require','密码不得为空'),
        array('u_pwd','6,12','密码不得小于6位，不得大于12位','','length'),
        array('u_email','email','邮箱格式不合法'),
        array('u_email','','此邮箱已被注册',self::EXISTS_VALIDATE,'unique',self::MODEL_BOTH),
        array('u_permission',array(1,2),'权限系数不在指定范围',self::EXISTS_VALIDATE,'in',self::MODEL_BOTH),
        array('u_explain','check_length','个性签名长度不得超过50位',self::EXISTS_VALIDATE,'function',self::MODEL_BOTH,array(0,50)),
    );

    /**
     * 提交数据时，对密码进行md5加密
     */
    protected $_auto=array(
        array('u_pwd','md5',3,'function'),
        array('u_rstdate','time','','function'),
    );

}
<?php
return array(
	//'配置项'=>'配置值'
//    'SHOW_PAGE_TRACE' =>true,
    'TMPL_CACHE_ON'=>false,
    'TMPL_L_DELIM'=>'{',
    'TMPL_R_DELIM'=>'}',
    'DB_TYPE'=>'mysql',
    'DB_USER'=>'root',
    'DB_PWD'=>'a7750825',
    'DB_PREFIX'=>'lnc_',
    'DB_DSN'=>'mysql:host=localhost;dbname=lnc;charset=UTF8',
    'MODULE_ALLOW_LIST'=>array('Home','Admin'),
    'TMPL_PARSE_STRING' => array(
        '__PUBLIC__' => '/lnc/Public',
    ),
    //由于默认的Index控制器会和index.html人口文件冲突，所有将默认的Index控制器改成Main
    'DEFAULT_CONTROLLER' => 'Main',
    //设置默认的操作
    'DEFAULT_ACTION'=>'index',
    //默认的I函数过滤方式
    'DEFAULT_FILTER'=>'htmlspecialchars,trim',
    //开启trace调试工具
    'SHOW_PAGE_TRACE' =>true, // 显示页面Trace信息
    //开启路由
    'URL_ROUTER_ON'=>true,
    'URL_MAP_RULES'=>array(
        'main/User/verifyOnly'=>'User/verifyOnly',
    ),



);
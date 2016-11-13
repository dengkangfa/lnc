<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);
//define('__APP__', '');
//smtp服务器
define('EMAIL_HOST','smtp.aliyun.com');
//发送方账号
define('EMAIL_USER_NAME','lingnanxy@aliyun.com');
define('EMAIL_USER_PASSWORD','a7750825');
// 定义应用目录
define('APP_PATH','./Application/');
define('IMAGE_ROOT_PATH','./Public/uploads/');
//临时图片地址
define('TMP_IMAGE_PATH','Public/uploads/tmp/');
//上传图片地址
define('IMAGE_PATH','Public/uploads/img/');
//评论一页显示条数
define('POST_COMMENT_PAGE',8);

define('PREV_URL',isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:'');

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单
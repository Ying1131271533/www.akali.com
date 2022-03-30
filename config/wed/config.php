<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
   //视图输出替换
   'view_replace_str' => [
		'__PUBLIC__'	=>	'/static/wed/',
		'__ROOT__' 		=> 	'/',
	],
	
	// 模版布局配置
	'template' => [
		'layout_on' => true,
		'layout_name' => 'layout/index',
		'layout_item' => '{__REPLACE__}'
	],
];


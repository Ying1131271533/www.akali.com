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
use think\Route;
Route::domain('admin', 'admin');
Route::domain('www', 'wed');
return [
	
	// 定义路由的时候 url() 这个函数 里面的 admin/admin/add 路径必须要填完整
	
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
	
	// url('wed/home/age', ['name' => 'lisi', 'age' => 24]); 转变 age-list-15.html
	
	// 复杂路由 前面必须要有一个参数才能用 所以下面这种不能用
	/* 'age-?<name?>-?<age?>' => 'wed/goods/age' */
	
	// 默认路由 有没有参数，则是用 [] 表示 而且可以不用必须有一个参数
	// 'age/[:name]/[:age]' => 'wed/goods/age'
	// Route::get('akali-[:id]-[:name]', 'home/akali'); 这个最好
	// Route::get('akali/[:id]-[:name]', 'home/akali');
	
	// 复杂路由<> 和 默认路由的[] 不能同时存在 例如下面：
	// Route::get('akali-[:id]-<name>', 'home/akali');
	
	
	// 原来正则表达式的 ? 是表示可能出现 0 次或者 1 次 所以结束贪婪模式是出现了一次就结束
	/* 	'age/<name?>-?<age?>' => ['wed/goods/age', ['method' => 'get'], ['id' => '\d+']],
		'age-<id?><name?>' => ['wed/goods/age', ['method' => 'get'], ['id' => '\d+']], */
	
	// 路由分组 tp的路由分组没什么卵用
	'[age]' => [
		// '' => ['wed/home/age', ['method' => 'get']],
		':name' => ['wed/home/age', ['method' => 'get'], ['name' => '\w+']],
		':age' => ['wed/home/age', ['method' => 'get'], ['age' => '\d+']],
		':name/:age' => ['wed/home/age', ['method' => 'get'], ['name' => '\w+', 'age' => '\d+']],
	],
	
	
	// 'wed/age' => 'wed/home/age',
	// 'admin/age' => 'admin/home/age',
	
	//'' => 'home/index', // 因为默认是空的所以和下面一样
	// '' => 'wed/home/index',
	// '' => 'admin/home/index',
	// 二级域名可以解决上面的后台和前台的路径一致的问题
	// www.1001.com -> wwww.1001.com/wed/home/index
	// admin.1001.com -> wwww.1001.com/admin/home/index
	
	// 'list/:cid/[:bid]/[:attr]' => 'wed/goods/index',
	// 					↓访问时的完整路径
	'goods/:id' => ['wed/goods/product_center', ['method' => 'get'], ['id' => '\d+']],
	// 'goods' => 'wed/goods/index',
	// 'goods' => 'admin/goods/index',
	
	// 不一定需要参数
	// 'goods/:id' => 'wed/goods/product_center',
	
	
	// 复杂路由 前面必须要有一个参数才能用
	// 'goods-<id>' => ['wed/goods/product_center', ['method' => 'get'], ['id' => '\d+']],
	
	// 按照上面的规则 自己写了 挺不错的
	// 'article/:id' => 'wed/article/details',
	'article-<id>' => 'wed/article/details',
	'pyramid' => 'wed/home/pyramid',
	'cache' => 'wed/cache/index',
];

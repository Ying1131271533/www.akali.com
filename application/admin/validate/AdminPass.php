<?php
namespace app\admin\validate;

use think\Validate;

class AdminPass extends Validate
{
	// 定义一个验证规则
	protected $rule = [
		'username|用户名'		=> 'require|length:3,18|unique:admin',
	];
	
	protected $message = [
		'username.require'		=> '用户名不能为空',
		'username.length'		=> '用户名为2至28个字符',
		'username.unique'		=> '用户名已存在',
	];
}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
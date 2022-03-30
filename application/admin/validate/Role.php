<?php
namespace app\admin\validate;

use think\Validate;

class Role extends Validate
{
	// 定义一个验证规则
	protected $rule = [
		'name|角色名'		=> 'require|unique:role',
	];
	
	protected $message = [
		'name.require'		=> '角色名不能为空',
		'name.unique'		=> '角色名已存在',
	];
}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
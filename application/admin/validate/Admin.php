<?php
namespace app\admin\validate;

use think\Validate;

class Admin extends Validate
{
	// 定义一个验证规则
	protected $rule = [
		'username|用户名'		=> 'require|length:3,18|unique:admin',
		'password|密码'			=> 'require|min:3|confirm:password2',
	];
	
	protected $message = [
		'username.require'		=> '用户名不能为空',
		'username.length'		=> '用户名为2至28个字符',
		'username.unique'		=> '用户名已存在',
		'password.require'		=> '密码不能为空',
		'password.min'			=> '密码不能少于3位',
		'password.confirm'		=> '两次密码不一致',
	];
}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
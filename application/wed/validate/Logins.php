<?php
namespace app\wed\validate;

use think\Validate;

class Logins extends Validate
{
	// 定义一个验证规则
	protected $rule = [
		'username|用户名'	=> 'require|length:3,18',
		'password|密码'		=> 'require|length:3,18',
	];
}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
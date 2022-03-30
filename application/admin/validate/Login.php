<?php
namespace app\admin\validate;

use think\Validate;

class Login extends Validate
{
	// 定义一个验证规则
	protected $rule = [
		'username|用户名'	=> 'require|length:2,18',
		'password|密码'		=> 'require|length:3,18',
		//'vcode|验证码'		=> 'require|captcha',
	];
}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
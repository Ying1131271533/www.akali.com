<?php
namespace app\admin\validate;

use think\Validate;

class Message extends Validate
{
	// 定义一个验证规则
	protected $rule = [
		'name|姓名'			=> 'require',
		'phone|手机号码'	=> 'require|number',
		'email|邮箱'		=> 'require',
		'content|留言'		=> 'require',
	];
	
	// 自定义验证提示信息
	protected $message = [
		'name.require' => '姓名不能为空',
		'phone.require' => '手机号码不能为空',
		'phone.number' => '手机号码必须为数字',
		'email.require' => '邮箱不能为空',
		'content.require' => '留言不能为空',
	];
	
}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
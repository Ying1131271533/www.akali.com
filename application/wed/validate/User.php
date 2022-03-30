<?php
namespace app\wed\validate;

use think\Validate;

class User extends Validate
{
	// 定义一个验证规则
	protected $rule = [
		'name|收货人'		=> 'require',
		'phone|手机'		=> 'require|length:11,18',
		'address|地址'		=> 'require',
		'postal|邮政编号'	=> 'require|length:6',
	];
}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
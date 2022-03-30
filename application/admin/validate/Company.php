<?php
namespace app\admin\validate;

use think\Validate;

class Company extends Validate
{
	// 定义一个验证规则
	protected $rule = [
		'address|公司地址'	=> 'require',
		'phone|公司电话'	=> 'require',
		'preserve|传真'		=> 'require',
		'email|邮箱'		=> 'require',
		'postcode|邮编'		=> 'require',
	];
	
	// 自定义验证提示信息
	protected $message = [
		'address.require' 	=> '地址不能为空',
		'phone.require' 	=> '电话不能为空',
		'preserve.require'	=> '传真不能为空',
		'email.require' 	=> '邮箱不能为空',
		'postcode.require' 	=> '邮编不能为空',
	];
	
}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
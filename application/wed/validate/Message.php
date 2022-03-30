<?php
namespace app\wed\validate;

use think\Validate;

class Message extends Validate
{
	// 定义一个验证规则
	protected $rule = [
		'name|姓名'			=> 'require',
		'phone|手机号码'	=> 'require|regex:^1[3456789][0126789]\d{8}$',
		//'phone|手机号码'	=> 'require|checkPhone:phone',
		'email|邮箱'		=> 'require',
		'content|留言'		=> 'require|min:5',
	];
	
	protected function checkPhone($phone)
	{

		$reg  = '/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/';
		
		if( !preg_match($reg,$phone)){
			return '手机号码错误';
		}
		return true;		
	}
	
	// 自定义验证提示信息
	protected $message = [
		'name.require' => '姓名不能为空',
		'phone.require' => '手机号码不能为空',
		'phone.regex' => '手机号码格式不正确',
		'email.require' => '邮箱不能为空',
		'content.require' => '留言不能为空',
		'content.min' => '留言不能少于五个字',
	];
	
}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
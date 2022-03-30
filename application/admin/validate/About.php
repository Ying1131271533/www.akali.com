<?php
namespace app\admin\validate;

use think\Validate;

class About extends Validate
{
	// 定义一个验证规则
	protected $rule = [
		'title|标题'	=> 'require|unique:about',
		'image|图片'	=> 'require',
	];
	
	// 自定义验证提示信息
	protected $message = [
		'title.unique' => '标题已存在',
		'title.require' => '标题不能为空',
		'image.require' => '图片不能为空',
	];
	
}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
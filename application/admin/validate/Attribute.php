<?php
namespace app\admin\validate;

use think\Validate;

class Attribute extends Validate
{
	// 定义一个验证规则
	protected $rule = [
		'attr_name|属性名称' => 'require|length:1,25',
	];
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
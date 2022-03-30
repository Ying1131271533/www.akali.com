<?php
namespace app\admin\validate;

use think\Validate;

class Brand extends Validate
{
	// 定义一个验证规则
	protected $rule = [
		'brand_name|品牌名称'	=> 'require|length:1,25|unique:brand',
		'logo'	=> 'require|length:1,120',
	];
	
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
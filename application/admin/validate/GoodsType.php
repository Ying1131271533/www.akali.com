<?php
namespace app\admin\validate;

use think\Validate;

class GoodsType extends Validate
{
	// 定义一个验证规则
	protected $rule = [
		'type_name|模型名称' => 'require|length:1,25|unique:goods_type',
	];
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
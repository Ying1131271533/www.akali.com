<?php
namespace app\admin\validate;

use think\Validate;

class Spec extends Validate
{
	// 定义一个验证规则
	protected $rule = [
		'spec_name|规格名称' => 'require|length:1,25',
		'type_id|商品类型' 	 => 'require|gt:0|number',
	];
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
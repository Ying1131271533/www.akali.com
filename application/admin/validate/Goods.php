<?php
namespace app\admin\validate;

use think\Validate;

class Goods extends Validate
{
	// 定义一个验证规则
	protected $rule = [
		'goods_name|商品名称' => 'require|length:1,50|unique:goods',
		'type_id|商品类型' 	  => 'require|gt:0|number',
	];
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<?php
	namespace app\admin\validate;
	
	use think\Validate;
	
	class Category extends Validate
	{
		// 定义一个验证规则
		protected $rule = [
			'cate_name|分类名称' => 'require|length:1,15|unique:category',
			'pid|上级分类' 		 => 'require|number',
		];
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
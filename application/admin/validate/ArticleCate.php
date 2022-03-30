<?php
	namespace app\admin\validate;
	
	use think\Validate;
	
	class ArticleCate extends Validate
	{
		// 定义一个验证规则
		protected $rule = [
			'cate_name|分类名称' => 'require|length:1,15|unique:article_cate',
		];
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
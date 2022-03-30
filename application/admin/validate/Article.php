<?php
	namespace app\admin\validate;
	
	use think\Validate;
	
	class Article extends Validate
	{
		// 定义一个验证规则
		protected $rule = [
			'title|标题'	=> 'require|length:1,30|unique:article',
			'cid|分类' 		=> 'require|gt:0',
		];
		
		// 自定义验证提示信息
		protected $message = [
			'cid.gt' => '请选择分类',
		];
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
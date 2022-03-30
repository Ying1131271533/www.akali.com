<?php
namespace app\admin\validate;

use think\Validate;

class Node extends Validate
{
	// 定义一个验证规则
	protected $rule = [
		'name|节点名称'			=> 'require',
		'title|备注'			=> 'require|unique:node',
		'pid|父级ID'			=> 'require',
		'level|等级'			=> 'require',
	];
	
	protected $message = [
		'name.require'		=> '节点名称不能为空',
		'title.require'		=> '备注不能为空',
		'title.unique'		=> '备注已存在',
	];
}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
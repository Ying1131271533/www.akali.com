<?php
namespace app\admin\model;

use think\Model;

class Admin extends Model
{
	// 创建这个属性 就可以用 toArray 这个方法
	protected $resultSetType = 'collection';
	
	// 密码自动转换md5 一定要在这里把密码保存为md5 不要在逻辑代码那边做这步操作
	// 因为空字符也会被md5加密 这样验证器那边就判断不了是不是为空
	public function setPasswordAttr($value)
	{
		return md5($value);
	}
	
	public function roles()
	{
		return $this -> belongsToMany('Role');
	}	
}


















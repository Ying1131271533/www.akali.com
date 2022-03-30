<?php
namespace app\admin\model;

use think\Model;

class GoodsType extends Model
{
	// 创建这个属性 就可以用 toArray 这个方法
	protected $resultSetType = 'collection';
	
	protected function attrs()
	{
		return $this -> hasMany('Attribute');
	}
}


















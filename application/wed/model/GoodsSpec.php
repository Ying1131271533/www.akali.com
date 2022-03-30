<?php
namespace app\wed\model;

use think\Model;

class GoodsSpec extends Model
{
	// 创建这个属性 就可以用 toArray 这个方法
	protected $resultSetType = 'collection';
	
	protected function goods()
	{
		return $this -> hasOne('Goods');
	}
	
}


















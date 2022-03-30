<?php
namespace app\wed\model;

use think\Model;

class GoodsImg extends Model
{
	// 创建这个属性 就可以用 toArray 这个方法
	protected $resultSetType = 'collection';
	
	// 定义商品相册与商品模型的相对应关系
	protected function goods()
	{
		return $this -> bolongsTo('Goods');
	}
}


















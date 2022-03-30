<?php
namespace app\wed\model;

use think\Model;

class Goods extends Model
{
	// 创建这个属性 就可以用 toArray 这个方法
	protected $resultSetType = 'collection';
	
	public function getCateNameAttr($value, $data)
	{
		return $this -> cate -> cate_name;
	}
	
	public function getBrandNameAttr($value, $data)
	{
		return $this -> brand -> brand_name;
	}
	
	public function getTypeNameAttr($value, $data)
	{
		return $this -> gtype -> type_name;
	}
	
	public function cate()
	{
		return $this -> belongsTo('Category');
	}
	
	public function brand()
	{
		return $this -> belongsTo('Brand');
	}
	
	// 定义商品模型与商品相册的一对多关联关系
	public function imgs()
	{
		return $this -> hasMany('GoodsImg');
	}
	
	public function specs()
	{
		return $this -> hasMany('GoodsSpec');
	}
	
	public function attrs()
	{
		return $this -> hasMany('GoodsAttr');
	}
	
	public function desc()
	{
		return $this -> hasOne('GoodsDesc');
	}
	
	public function gtype()
	{
		// 如果没有外键关系 则要手动添加外键 就是第二个参数
		return $this -> belongsTo('GoodsType', 'type_id');
	}
	
}


















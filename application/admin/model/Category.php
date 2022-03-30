<?php
namespace app\admin\model;

use think\Model;

class Category extends Model
{
	public function goods()
	{
		return $this -> hasMany('Goods');
	}
	
	/*
	// 获取器
	public function getPidAttr($value)
	{
		$cate_name = $this -> where('id', $value) -> value('cate_name');
		return ! empty($cate_name) ? $cate_name : '顶级分类';
	}
	*/
	
	public function getIsChildAttr($value, $data)
	{
		$childData = $this -> where(['pid' => $data['id']]) -> value('id');
		return ! empty($childData) ? 1 : 0;
	}
	
}


















<?php
namespace app\wed\model;

use think\Model;

class Category extends Model
{
	protected $resultSetType = 'collection';
	public function goods()
	{
		return $this -> hasMany('Goods');
	}
	
	public function getIsChildAttr($value, $data)
	{
		$childData = $this -> where(['pid' => $data['id']]) -> value('id');
		return ! empty($childData) ? 1 : 0;
	}
	
}


















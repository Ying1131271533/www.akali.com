<?php
namespace app\wed\model;

use think\Model;

class Spec extends Model
{
	protected function items()
	{
		return $this -> hasMany('SpecItem');
	}
	
	public function getTypeNameAttr($value, $data)
	{
		return model('GoodsType') -> where('type_id', $data['type_id']) -> value('type_name');
	}
	
	public function getSpecItemsAttr($value, $data)
	{
		$items = model('SpecItem') -> where(['spec_id' => $data['spec_id']]) -> column('item_name');
		return implode("\r\n", $items);
	}
	
}




























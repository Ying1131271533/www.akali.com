<?php
namespace app\wed\model;

use think\Model;

class Attribute extends Model
{
	protected function type()
	{
		return $this -> beLongsTo('GoodsType');
	}
	
	public function getTypeNameAttr($value, $data)
	{
		return model('GoodsType') -> where('type_id', $data['type_id']) -> value('type_name');
	}
	
	public function getAttrInputTypeAttr($value)
	{
		$type = ['手工录入', '从列表中选择', '多行文本框'];
		return $type[$value];
	}
}


















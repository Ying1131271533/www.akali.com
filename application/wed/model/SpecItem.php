<?php
namespace app\wed\model;

use think\Model;

class SpecItem extends Model
{
	public function spec()
	{
		return $this -> beLongsTo('Spec');
	}
	
	public function getSpecNameAttr($value, $data)
	{
		return $this -> spec -> spec_name;
	}
	
}






















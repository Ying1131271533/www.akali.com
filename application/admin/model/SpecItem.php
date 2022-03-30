<?php
namespace app\admin\model;

use think\Model;

class SpecItem extends Model
{
	public function spec()
	{
		return $this -> beLongsTo('Spec');
	}
}





















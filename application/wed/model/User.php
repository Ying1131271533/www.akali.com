<?php
namespace app\wed\model;

use think\Model;

class User extends Model
{
	
	public function setPasswordAttr($value)
	{
		return md5($value);
	}
}




























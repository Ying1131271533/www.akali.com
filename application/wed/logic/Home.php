<?php
namespace app\wed\logic;

use think\Model;

class Home
{
	// 递归清除缓存
	public function recursion_cache($data)
	{
		if(is_array($data) && !empty($data))
		{
			foreach($data as $key => $value)
			{
				$this -> recursion_cache($value);
			}
			
		}else
		{
			cache(md5($data), null);
		}
	}
}


















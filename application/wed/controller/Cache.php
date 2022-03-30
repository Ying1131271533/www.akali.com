<?php
namespace app\wed\controller;

use think\Controller;

class Cache extends Controller
{
	public function index()
	{
		$cacheList = cache('cache_list');
		if(!empty($cacheList))
		{
			echo '<ul>';
			foreach($cacheList as $key => $value)
			{
				$url = url('del', ['name' => str_replace('/', 'jinx', encrypt($value, 'E', 'akali')), 'key' => $key]);
				echo <<<AKALI
				<li>{$value}————> <a href="{$url}">删除</a></li>
AKALI;
			}
			echo '<li>————> <a href="del_all">全部删除</a></li></ul>';
		}
	}
	
	public function del($name, $key)
	{
		$name = encrypt(str_replace('jinx', '/', $name), 'D', 'akali');
		cache($name, null);
		
		$cacheList = cache('cache_list');
		unset($cacheList[$key]);
		cache('cache_list', $cacheList);
		return $this -> success('删除成功');
	}
	
	public function del_all()
	{
		foreach(cache('cache_list') as $value)
		{
			cache($value, null);
		}
		
		cache('cache_list', null);
		return $this -> success('删除成功');
	}
}



















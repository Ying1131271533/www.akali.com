<?php
namespace app\wed\controller;

use think\Controller;
//use think\Db;

class Home extends Base
{
	protected $homeLogic;
	
	public function _initialize()
	{
		parent::_initialize();
		$this -> homeLogic = model('Home', 'logic');
	}
	
	public function index()
    {
		
		if(empty($this -> data))
		{
			$brand_name = model('Goods') -> get(1, [], 'goods');
			$this -> assign('brand_name', $brand_name -> toArray());
			
			// 缓存
			$this -> data = $this -> fetch();
			akali_cache($this -> data);
		}
		return $this -> data;
    }
	
	
	public function delcache($key, $m, $c, $a)
	{
		$data = cache('akali_cache');
		unset($data[$m][$c][$a][$key]);
		cache('akali_cache', $data);
		cache($key, null);
		return $this -> success('缓存已清除');
	}
	
	// 假如这里是后台缓存管理页面
	public function akali_cache()
	{
		$data = cache('akali_cache');
		if(!empty($data))
		{
			foreach($data as $mkey => $module)
			{
				echo '模块：' . $mkey . "<br/>";
				foreach($module as $ckey => $controller)
				{
					echo '控制器' . $ckey . "<br/>";
					foreach($controller as $akey => $action)
					{
						echo '方法名' . $akey . "<br/>";
						foreach($action as $key => $value)
						{
							echo $value . '-------------<a href="'.url('delcache', ['key' => $key, 'm' => $mkey, 'c' => $ckey, 'a' => $akey]).'">删除缓存</a><br/>';
						}
					}
				}
			}
			
			echo '---------<a href="all_cache">清除所有缓存</a>';
		}else
		{
			echo '---------<a href="/">没有缓存</a>';
		}
		
		echo '<pre>';
		print_r($data);
		echo '<pre>';
		
	/* 	
		// 找出缓存
		$cache = cache('page_index');
		if(! empty($cache))
		{
			cache('page_index', null);
			return '缓存已清除';
		}
		
		return '没有缓存';
	 */	
	}
	
	// 清除所有缓存
	public function all_cache()
	{
		$this -> homeLogic -> recursion_cache(cache('akali_cache'));
		cache('akali_cache', null);
		return $this -> success('清除成功');
	}
	
	
}


















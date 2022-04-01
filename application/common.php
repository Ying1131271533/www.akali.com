<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
 // \think\Route::domain('admin', 'admin');
 


// 应用公共文件

if(! function_exists('html_dcode'))
{
	function html_dcode($str)
	{
		return htmlspecialchars_decode($str);
	}
}

// 加密解密函数

if(! function_exists('encrypt'))
{
	function encrypt($string,$operation,$key='')
	{ 
		$key=md5($key); 
		$key_length=strlen($key); 
		  $string=$operation=='D'?base64_decode($string):substr(md5($string.$key),0,8).$string; 
		$string_length=strlen($string); 
		$rndkey=$box=array(); 
		$result=''; 
		for($i=0;$i<=255;$i++){ 
			   $rndkey[$i]=ord($key[$i%$key_length]); 
			$box[$i]=$i; 
		} 
		for($j=$i=0;$i<256;$i++){ 
			$j=($j+$box[$i]+$rndkey[$i])%256; 
			$tmp=$box[$i]; 
			$box[$i]=$box[$j]; 
			$box[$j]=$tmp; 
		} 
		for($a=$j=$i=0;$i<$string_length;$i++){ 
			$a=($a+1)%256; 
			$j=($j+$box[$a])%256; 
			$tmp=$box[$a]; 
			$box[$a]=$box[$j]; 
			$box[$j]=$tmp; 
			$result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256])); 
		} 
		if($operation=='D'){ 
			if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8)){ 
				return substr($result,8); 
			}else{ 
				return''; 
			} 
		}else{ 
			return str_replace('=','',base64_encode($result)); 
		} 
	}
	
}



/**
 * @var bool 页面缓存
 */
function akali_cache($data = '')
{
	// 基本参数
	$request 	= request();
	$module 	= $request -> module(); // 模块名
	$controller = $request -> controller(); // 控制器名
	$action 	= $request -> action(); // 方法名
	$param 		= $request -> param(); // 参数
	
	$cache_name = 'akali_cache';
	/* 
	[
		'module' => [
			'controller' => [
				'action' => [
					'key' => 'url',
					'key' => 'url',
					'key' => 'url',
					'key' => 'url',
					'key' => 'url',
				],
			],
		],
	]
	 */
	
	$key = url($module . '/' . $controller . '/' . $action, $param); //'模块/控制器/方法名/参数';
	
	if(! empty($data))
	{
		// 保存缓存
		$result = cache(md5($key), $data);
		
		// 读取管理缓存数组数据列表
		$gl = cache($cache_name);
		$gl[$module][$controller][$action][md5($key)] = $key;
		
		// 保存缓存名
		cache($cache_name, $gl);
		return $result;
	}
	
	// 取出页面缓存
	$cache = cache(md5($key));
	return $cache;
	
/* 	用法

	Base控制器
	$this -> data = akali_cache();
	
	普通控制器
	// 读取缓存
	if(empty($this -> data))
	{
		// 网页的逻辑代码
		$this -> data = $this -> fetch();
		akali_cache($this -> data);
	}
	
	return $this -> data;
 */	
}

/**
 * @description:  オラ!オラ!オラ!オラ!⎛⎝≥⏝⏝≤⎛⎝
 * @author: 神织知更
 * @time: 2022/03/31 21:56
 *
 * 递归找子级数据
 *
 * @param  array    $data		二维数组
 * @param  int      $pid		父级id
 * @return array				返回处理好的数组
 */
function get_child($array, $pid = 0)
{
	$temp = [];
	foreach($array as $key => $value)
	{
		if($value['pid'] == $pid)
		{
			$value['child'] = get_child($array, $value['id']);
			$temp[] = $value;
		}
	}
	return $temp;
}













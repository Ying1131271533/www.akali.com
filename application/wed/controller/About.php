<?php
namespace app\wed\controller;

use think\Controller;
//use think\Db;

class About extends Base
{
    public function index()
    {
		// 读取缓存
		if(empty($this -> data))
		{
			$about = model('About') -> order('id', 'desc') -> find(function($q){
				$q -> field('title, image, content');
			});
			
			$this -> assign('about', $about);
			
			$this -> data = $this -> fetch();
			akali_cache($this -> data);
		}
		
		return $this -> data;
    }
	
}


















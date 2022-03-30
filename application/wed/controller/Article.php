<?php
namespace app\wed\controller;

use think\Controller;
//use think\Db;

class Article extends Base
{
    public function index()
    {
		if(empty($this -> data))
		{
			$article = model('Article') -> order('id', 'desc') -> paginate(4);
			// $article = model('Article') -> paginate(function($q){
				// $q -> field('id, title, create_time');
			// });
			
			$this -> assign('article', $article);
			
			$this -> data = $this -> fetch();
			akali_cache($this -> data);
		}
		
		return $this -> data;
    }
	
    public function details()
    {
		$id = input('id/d');
		if(empty($id))
		{
			$article = model('Article') -> find(function($q) use($id){
				$q -> order('id', 'desc') -> field('id, title, image');
			});
		}
		
		if(! empty($id))
		{
			$article = model('Article') -> find(function($q) use($id){
				$q -> where('id', $id) -> field('id, title, image');
			});
		}
		
		$this -> assign('article', $article);
		
		return $this -> fetch();
    }
	
}


















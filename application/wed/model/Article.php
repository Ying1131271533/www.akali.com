<?php
namespace app\wed\model;

use think\Model;

class Article extends Model
{
	// 创建这个属性 就可以用 toArray 这个方法
	protected $resultSetType = 'collection';
	
	// protected $autoWriteTimestamp = false;
	
	public function desc()
	{
		return $this -> hasOne('ArticleDesc');
	}
	
	public function getContentAttr($value, $data)
	{
		return model('ArticleDesc') -> where('article_id', $data['id']) -> value('content');
	}
	
}


















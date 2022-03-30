<?php
namespace app\wed\controller;

use think\Controller;

class Base extends Controller
{
	protected $data;
	protected $companyData;
	
	public function _initialize()
	{
		parent::_initialize();
		$companyData = $this -> getCompany();
		$this -> assign('companyData', $companyData);
		
		$this -> data = akali_cache();
	}
	
	/**
     * @var bool 找出产品分类
     */
	public function getCategory()
	{
		// $cate = model() -> all(null, [], 'cateMun'); // 给个名字可以知道是什么名字
		
		$cate = get_child($cate);
		return $cate;
	}
	
	
	protected function getCompany()
	{
		$company = model('Company') -> cache(true) -> order('id', 'desc') -> find();
		return $company;
	}
	
}


















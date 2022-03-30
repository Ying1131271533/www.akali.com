<?php
namespace app\admin\controller;

class GoodsSpec extends Base
{
	// 规格逻辑模型
	protected $specLogic;
	
	public function _initialize()
	{
		parent::_initialize();
		$this -> specLogic = model('Spec', 'logic');
	}
	
	public function index()
    {
		$listData = $this -> specLogic -> getList();
		$this -> assign('listData', $listData);
		return $this -> fetch();
    }
	
	public function add()
	{
		if(request() -> isPost())
		{
			$result = $this -> specLogic -> edit(input());
			
			if($result !== true)
			{
				return $this -> error($result);
			}
			
			return $this -> success('保存成功');
		}
		
		if(input('?spec_id'))
		{
			$specData = $this -> specLogic -> getSpecData(input('spec_id/d'));
			$this -> assign('specData', $specData);
		}
		
		$typeData = model('GoodsType') -> all();
		$this -> assign('typeData', $typeData -> toArray());
		
		
		
		return $this -> fetch();
	}
	
	public function del()
	{
		
		
		return $this -> fetch();		
	}
	
}


















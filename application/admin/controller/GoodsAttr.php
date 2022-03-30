<?php
namespace app\admin\controller;

class GoodsAttr extends Base
{
	protected $attrLogic;
	
	public function _initialize()
	{
		parent::_initialize();
		$this -> attrLogic = model('Attribute', 'logic');
	}
	
	public function index()
    {
		$listData = $this -> attrLogic -> getList();
		
		$this -> assign('listData', $listData);
		
		return $this -> fetch();
    }
	
	public function add()
	{
		if(request() -> isPost())
		{
			$result = $this -> attrLogic -> edit(input());
			
			if($result !== true)
			{
				return $this -> error($result);
			}
			
			return $this -> success('保存成功');
		}
		
		if(input('?attr_id'))
		{
			$attrData = $this -> attrLogic -> getAttrData(input('attr_id/d'));
			$this -> assign('attrData', $attrData);
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


















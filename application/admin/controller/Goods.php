<?php
namespace app\admin\controller;

class Goods extends Base
{
	protected $goodsLogic;
	
	public function _initialize()
	{
		parent::_initialize();
		$this -> goodsLogic = model('Goods', 'logic');
	}
	
	public function index()
    {
		$data = $this -> goodsLogic -> getList(input());
		$this -> assign('data', $data);
		
		// 找出分类
		$cateLogic = model('Category', 'Logic');
		$cateData = $cateLogic -> recursionCate();		
		$cateInputHtml = $cateLogic -> recursionCateInput($cateData, input('category_id/d'));		
		$this -> assign('cateInputHtml', $cateInputHtml);
		
		// 找出品牌
		$brand = model('Brand') -> all();
		$this -> assign('brand', $brand);
		
		return $this -> fetch();
    }
	
	public function add()
	{
		if(request() -> isPost())
		{
			$result = $this -> goodsLogic -> edit(input());
			if($result !== true)
			{
				return $this -> error($result);
			}
			
			return $this -> success('保存成功', url('admin/goods/index'));
		}
		
		// 找出该商品
		if(input('?id'))
		{
			$goods = $this -> goodsLogic -> getInfo(input('id/d'));
			if(empty($goods))
			{
				return $this -> error('找不该商品');
			}
			
			$this -> assign('goods', $goods);
		}
	
		// 找出所有的商品模型
		$goodsType = $this -> goodsLogic -> getGoodsType();
		
		//如果有多个变量分配到视图 可以用数组		
		$this -> assign('goodsType', $goodsType);
		
			// 找出品牌
			$brand = model('Brand') -> all();
			$this -> assign('brand', $brand);
		
		if(! empty($goods))
		{	
			// 获取套餐
			//$keyArray = $goods -> specs() -> column('key');
			$keyArray = model('GoodsSpec') -> where('goods_id', $goods -> id) -> column('key');
			
			$itemId = [];		
			foreach($keyArray as $key => $value)
			{
				$temp = explode('_', $value);
				$itemId = array_merge($itemId, $temp);
			}
			
			// 去除重复数组
			$itemId = array_unique($itemId);
			$this -> assign('itemId', $itemId);
		}
		
		// 找出分类
		$cateLogic = model('Category', 'Logic');
		$cateData = $cateLogic -> recursionCate();		
		$cateInputHtml = $cateLogic -> recursionCateInput($cateData, ! empty($goods -> category_id) ? $goods -> category_id : 0);		
		$this -> assign('cateInputHtml', $cateInputHtml);
		
		return $this -> fetch();
	}
	
	
	public function edit()
	{
		if(request() -> isPost())
		{
			$result = $this -> goodsLogic -> edit(input());
			if($result !== true)
			{
				return $this -> error($result);
			}
			
			return $this -> success('保存成功', url('admin/goods/index'));
		}
		
		// 找出该商品
		if(input('?id'))
		{
			$goods = $this -> goodsLogic -> getInfo(input('id/d'));
			if(empty($goods))
			{
				return $this -> error('找不该商品');
			}
			
			$this -> assign('goods', $goods);
		}
	
		// 找出所有的商品模型
		$goodsType = $this -> goodsLogic -> getGoodsType();
		
		//如果有多个变量分配到视图 可以用数组		
		$this -> assign('goodsType', $goodsType);
		
			// 找出品牌
			$brand = model('Brand') -> all();
			$this -> assign('brand', $brand);
		
		if(! empty($goods))
		{	
			// 获取套餐
			//$keyArray = $goods -> specs() -> column('key');
			$keyArray = model('GoodsSpec') -> where('goods_id', $goods -> id) -> column('key');
			
			$itemId = [];		
			foreach($keyArray as $key => $value)
			{
				$temp = explode('_', $value);
				$itemId = array_merge($itemId, $temp);
			}
			
			// 去除重复数组
			$itemId = array_unique($itemId);
			$this -> assign('itemId', $itemId);
		}
		
		// 找出分类
		$cateLogic = model('Category', 'Logic');
		$cateData = $cateLogic -> recursionCate();		
		$cateInputHtml = $cateLogic -> recursionCateInput($cateData, ! empty($goods -> category_id) ? $goods -> category_id : 0);		
		$this -> assign('cateInputHtml', $cateInputHtml);
		
		return $this -> fetch();
	}
	
	public function ajaxGetGoodsType($type_id, $id = 0)
	{
		$html = '';
		$html .= $this -> goodsLogic -> getSpecHtml($type_id, $id);
		$html .= $this -> goodsLogic -> getAttrHtml($type_id, $id);
		
		die($html);
	}
	
	public function ajaxGetSpecGroup()
	{
		$params = input();
		$itemArray = ! empty($params['item']) ? $params['item'] : [];
		
		$html = $this -> goodsLogic -> getSpecGroupHtml($itemArray, input('id/d'));
		
		return ['html' => $html];
	}
	
	public function del()
	{
		
		
		return $this -> fetch();		
	}
	
}


















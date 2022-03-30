<?php
namespace app\wed\controller;

class Goods extends Base
{
	protected $goodsLogic;
	protected $seen;
	protected $like;
	
	public function _initialize()
	{
		parent::_initialize();
		$this -> goodsLogic = model('Goods', 'logic');
		
		// 把看过的商品数据从 cookie 中取出来
		$this -> seen = cookie('seen');
		
		if(empty($this -> seen))
		{
			$this -> seen = [];
		}
		
		// 把喜欢的商品数据从 cookie 中取出来
		$this -> like = cookie('like');
		
		if(empty($this -> like))
		{
			$this -> like = [];
		}
	}
	
	// 商品列表
	public function index()
	{
		// echo '<pre>';
		// print_r(cache('akali_cache'));
		// echo '<pre>';
		if(empty($this -> data))
		{
			//$attr = $this -> goodsLogic -> getAttr();
		
			$this -> assign('headerNavHtml', $this -> goodsLogic -> getNav());
			
			// 详情页的大分类 指向到商品首页的分类 添加样式
			$cateInput = input();
			if(! empty($cateInput))
			{
				$delai_cate_id = input('category_id');
				$this -> assign('delai_cate_id', $delai_cate_id);
			}
			
			// 找出分类列表
			$data = $this -> goodsLogic -> getList(input());
			
			$this -> assign('data', $data);
			
			$categoryNav = $this -> goodsLogic -> subnav();
			
			$this -> assign('categoryNav', $categoryNav);
			
			$this -> data = $this -> fetch();
			akali_cache($this -> data);
		}
		
		return $this -> data;
	}
	
	// 商品详情页面
	public function product_center()
	{
		if(empty($this -> data))
		{
			$id = input('id/d');
			if(empty($id))
			{
				return $this -> error('找不到该页面', url('wed/home/index'));
			}
			
			$goods = $this -> goodsLogic -> getInfo($id);
			
			// 添加喜欢的商品到 cookie
			if(array_key_exists($id, $this -> like))
			{
				$this -> like[$id] += 1;
			}else
			{
				$this -> like[$id] = 1;
			}
			
			// 添加看过商品到 cookie
			if(in_array($id, $this -> seen))
			{
				$key = array_search($id, $this -> seen);
				unset($this -> seen[$key]);
			}
			
			$this -> seen[$id] = $id;
			$this -> assign('goods', $goods);
			
			// 取出顶级分类
			$categoryNav = $this -> goodsLogic -> subnav();		
			$this -> assign('categoryNav', $categoryNav);
			
			// 获取选中商品的顶级父类
			$child = model('Category') -> where('id', $goods -> category_id) -> find();
			$cateParent = $goods -> category_id;
			if($child -> pid != 0)
			{
				$cateParent = $this -> goodsLogic -> parenCate($child -> pid);
			}
			
			$this -> assign('cateParent', $cateParent);
			
			// 套餐
			$spec = $this -> goodsLogic -> handelSpecItem($goods -> id);
			$this -> assign('spec', $spec);
			
			$this -> data = $this -> fetch();
			akali_cache($this -> data);
		}
		
		return $this -> data;
	}
	
	public function ajaxGoodsImge($cate_id)
	{
		return $this -> goodsLogic -> goodsImg($cate_id);
	}
	
	public function ajaxGetSpecPrice()
	{
		$item_id = input('item_id');
		$goods_id = input('goods_id');
		
		if(empty($item_id) || empty($goods_id))
		{
			return ['code' => 0, 'msg' => ''];
		}
		
		// 获取套餐价格
		$price = model('goodsSpec') -> where('key', $item_id) -> where('goods_id', $goods_id) -> value('spec_price');
		
		return ['code' => 1, 'spec_price' => $price];
	}
	
	// 对象销毁后 保存cookie
	public function __destruct()
	{
		cookie('seen', $this -> seen, 36000 * 24 * 30);
		
		cookie('like', $this -> like, 36000 * 24 * 30);
	}
	
}






























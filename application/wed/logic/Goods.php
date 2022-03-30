<?php
namespace app\wed\logic;

class Goods extends \app\wed\model\Goods
{
	public function getNav()
	{
		$handelData = $this -> recursionCate();
		$html = $this -> handelNavHtml($handelData);
		
		return $html;
	}

	protected function handelNavHtml($data)
	{
		$liHtml = '';
		foreach($data as $key => $value)
		{
			$liHtml .= "<li><a href='javascript:;'>{$value['cate_name']}</a><input type='hidden' value='{$value["id"]}'>";
			
			if(! empty($value['child']))
			{
				$liHtml .= $this -> handelNavHtml($value['child']);
			}
			
			$liHtml .= '</li>';
		}
		
		$html = "<ul>{$liHtml}</ul>";
		
		return $html;
		
	}
	
	// 获取商品规格
	public function handelSpecItem($goods_id = 0)
	{
		$goodsSpecItem = model('GoodsSpec') -> where('goods_id', $goods_id) -> select();
		$itemId = [];
		foreach($goodsSpecItem as $key => $value)
		{
			$temp = explode('_', $value -> key);
			$itemId = array_merge($itemId, $temp);
		}
		
		$itemId = array_unique($itemId);
		
		// 两种写法
		$specItem = model('SpecItem') -> whereIn('item_id', ! empty($itemId) ? $itemId : 0) -> select();
		//$specItem = model('SpecItem') -> where('item_id', 'in', ! empty($itemId) ? $itemId : 0) -> select();
		
		$itemArray = [];
		foreach($specItem as $key => $value)
		{
			$itemArray[$value -> spec_name][] = [
				'item_id' => $value -> item_id,
				'item_name' => $value -> item_name,
				'spec_id' => $value -> spec_id,
			];
		}
		
		return $itemArray;
	}
	
	
	// 递归找出子级
	public function recursionCate($pid = 0)
	{
		static $cateData;
		
		if(empty($cateData))
		{
			$cateData = model('Category') -> all();
		}
		
		$tempArray = [];
		foreach($cateData as $key => $value)
		{
			$temp = $value -> toArray();
			if($value -> pid == $pid)
			{
				$temp['child'] = $this -> recursionCate($value -> id);
				$tempArray[] = $temp;
			}
		}
		
		return $tempArray;
	}
	
	// 获取商品列表
	public function getList($params = [])
	{
		$where = null;
		
		if(! empty($params['category_id']))
		{
			// 找出自己以及自己子类id
			$childId = model('Category', 'logic') -> getChilId((int) $params['category_id']);
			
			// 再加上自己的id
			$childId[] = (int) $params['category_id'];
			$where['category_id'] = ['in', $childId];
		}
		
		if(! empty($params['keywords']))
		{
			// or 的关系
			// 商品的名称 商品品牌 属性 分类
			$where[] = function($db) use($params)
			{
				// 商品名称
				$db -> where('goods_name', 'like', "%{$params['keywords']}%");
				
				// 品牌名称 找到 id
				$bid = model('Brand') -> where('brand_name', 'like', "%{$params['keywords']}%") -> column('id');
				if(! empty($bid))
				{
					$db -> whereOr('brand_id', 'in', $bid);
				}
				
				// 属性
				$goods_id = model('GoodsAttr') -> where('attr_values', 'like', "{$params['keywords']}") -> column('goods_id');
				if(! empty($goods_id))
				{
					$db -> whereOr('id', 'in', $goods_id);
				}
			};
			
			// 有了分页再用
			//$query['keywords'] = $params['keywords'];
		}
		
		//$data = $this -> where($where) -> field('id', 'image');
		$data = $this -> where($where) -> select();
		return $data;
	}
	
	public function getInfo($goods_id = 0)
	{
		return model('Goods') -> get($goods_id);
	}
	
	// 最大分类
	public function subnav()
	{
		$categoryNav = model('Category') -> where('pid', 0) -> select();
		return $categoryNav;
	}
	
	// 商品的父分类
	public function parenCate($pid = 0)
	{
		
		static $cateData;
		if(empty($cateData))
		{
			$cateData = model('Category') -> all();
		}
		
		static $catetemp = [];
		foreach($cateData as $key => $value)
		{
			if($value -> id == $pid)
			{
				
				//$catetemp = $value -> id;
				$catetemp = [
					'cid' => $value -> id,
					'cate_name'=> $value -> cate_name,
				];
				
				$this -> parenCate($value -> pid);
			}
		}
		return $catetemp;
	}
	
	public function goodsImg($cate_id)
	{
		$data = $this -> getList(['category_id' => $cate_id]);
		
		$goodsImgHtml = '';
		
		foreach($data as $key => $value)
		{
			$cateUrl = url('wed/goods/product_center', ['id' => $value -> id]);
			$goodsImgHtml .= <<<AKALI
				<li>
					<a href="{$cateUrl}">

						<img class="img-responsive" src="/{$value -> image}" alt="{$value -> image}" />

					</a>
				</li>
AKALI;
		}
		
		echo $goodsImgHtml;
	}
	
}

























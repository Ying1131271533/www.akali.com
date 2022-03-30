<?php
namespace app\wed\logic;

use think\Model;

class Cart
{
	// 用来存储购物车的信息
	protected $data;
	
	public function __construct()
	{
		// 把购物车数据从 cookie 中取出来
		$this -> data = cookie('cart');
		if(empty($this -> data))
		{
			$this -> data = [];
		}
	}
	
	// 添加购物车
	public function add($goods_id, $key = '', $number = 1)
	{
		/* [
			'image' 		=> '',
			'goods_id' 		=> '',
			'goods_name'	=> '',
			'spec_name' 	=> '',
			'market_price' 	=> '',
			'shop_price' 	=> '',
			'number' 		=> '',
			'spec_price' 	=> '',
		];
		*/
		
		$arrayKey = $goods_id . (! empty($key) ? ('_' . $key) : '');
		
		// 判断该产品或套餐是否存在于购物车当中
		if(! empty($this -> data[$arrayKey]))
		{
			// 已经存在购物车当中，则修改数量
			$this -> edit($goods_id , $key, $number);
			return true;
		}
		
		// 取出该商品详情
		$goods = $this -> getGoodsInfo($goods_id);
		if(empty($goods))
		{
			return '商品不存在';
		}
		
		// 加入购物车的商品为套餐的时候
		if(! empty($key))
		{
			$goodsSpec = $goods -> specs() -> where('key', $key) -> find();
			//$goodsSpec = model('GoodsSpec') -> where('goods_id', $goods -> id) -> where('key', $key) -> find();
			if(empty($goodsSpec))
			{
				return '套餐不存在';
			}
		}
		
		// 添加商品或套餐回到购物车
		$this -> data[$arrayKey] = [
			'image' 		=> $goods -> image,
			'goods_id' 		=> $goods -> id,
			'goods_name'	=> $goods -> goods_name,
			'market_price' 	=> $goods -> market_price,
			'shop_price' 	=> $goods -> shop_price,
			'number' 		=> $number,
			'spec_name' 	=> ! empty($goodsSpec) ? $goodsSpec -> key_name : '',
			'spec_price' 	=> ! empty($goodsSpec) ? $goodsSpec -> spec_price : 0,
			'price' 		=> ! empty($goodsSpec -> spec_price) ? $goodsSpec -> spec_price : (! empty($goods -> shop_price) ? $goods -> shop_price : $goods -> market_price),
			'spec_key'		=> $key,
			'selected'		=> 1, // 购物车选中状态
		];
		
		return true;
	}
	
	// 修改购物车商品状态
	public function status($cart_id)
	{
		if(empty($this -> data[$cart_id]))
		{
			return '购物车中不存在该商品';
		}
		
		$this -> data[$cart_id]['selected'] = ! empty($this -> data[$cart_id]['selected']) ? 0 : 1;
		
		return true;
	}
	
	// 修改全部商品状态
	public function allStatus($check)
	{
		$status = 1;
		
		if($check == 'true')
		{
			$status = 1;
		}
		
		if($check == 'false')
		{
			$status = 0;
		}
		
		foreach($this -> data as $key => $value)
		{
			$this -> data[$key]['selected'] = $status;
		}
	}
	
	// 修改购物车
	public function edit($goods_id , $key = '', $number = 1)
	{
		$arrayKey = $goods_id . (! empty($key) ? ('_' . $key) : '');
		
		// 把商品或套餐的购物数量增加
		$this -> data[$arrayKey]['number'] = $number;
	}
	
	// 删除购物车
	public function del($cart_id)
	{
		if(empty($this -> data[$cart_id]))
		{
			return '购物车中不存在该商品';
		}
		
		unset($this -> data[$cart_id]);
		return true;
	}
	
	// 获取购物车
	public function getCart()
	{
		return $this -> data;
	}
	
	// 购物车统计
	public function total()
	{
		$count = 0;
		$price = 0;
		$number = 0;
		
		foreach($this -> data as $key => $value)
		{
			$count += $value['number'];
			if($value['selected'] == 1)
			{
				$price += $value['number'] * $value['price'];
				$number += $value['number'];
			}
		}
		
		return ['count' => $count, 'price' => $price, 'number' => $number];
	}
	
	// 获取商品详情
	protected function getGoodsInfo($goods_id)
	{
		static $goods;
		
		if(empty($goods[$goods_id]))
		{
			$goods[$goods_id] = model('Goods') -> get($goods_id);
		}
		
		return $goods[$goods_id];
	}
	
	// 对象销毁后 保存cookie
	public function __destruct()
	{
		// 保存购物车到 cookie
		cookie('cart', $this -> data, 36000*24*30);
	}
	
}


























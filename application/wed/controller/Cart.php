<?php
namespace app\wed\controller;

class Cart extends Base
{
	protected $cartLogic;
	
	public function _initialize()
	{
		parent::_initialize();
		$this -> cartLogic = model('Cart', 'logic');
	}
	
	// 购物车页面
	public function index()
	{
		$step = input('step');
		switch($step)
		{
			case 2: // 确认订单
				
				// 获取购物车信息
				$data = $this -> cartLogic -> getCart();
				$this -> assign('data', $data);
				
				// 购物车的商品总数
				$total = $this -> cartLogic -> total();
				$this -> assign('total', $total);
				
				return $this -> fetch('confirm_order');
				
				break;
			
			case 3: // 确认地址
				
				if(empty(session('user')))
				{
					return $this -> error('请先登录', url('wed/logins/index'));
				}
				
				$province = db('region') -> where('parent_id', 0) -> select();
				$this -> assign('province', $province);
				
				$user_id = session('user');
				$userAddress = db('address') -> where('user_id', $user_id['user_id']) -> select();
				
				$this -> assign('userAddress', $userAddress);
				
				return $this -> fetch('address');
				
				break;
			
			case 4:// 提交订单
				
				$address_id = input('address_id');
				if(! is_numeric($address_id))
				{
					$this -> error('收货地址有误', url('wed/cart/index', ['step' => 3]));
				}
				
				// 获取购物车信息
				$data = $this -> cartLogic -> getCart();
				$this -> assign('data', $data);
				
				// 购物车的商品总数
				$total = $this -> cartLogic -> total();
				$this -> assign('total', $total);
				
				// 获取收获信息
				$address = db('address') -> where('id' ,$address_id) -> find();
				if(empty($address))
				{
					$this -> error('收货地址有误', url('wed/cart/index', ['step' => 3]));
				}
				
				$this -> assign('address', $address);
				
				return $this -> fetch('pay');		
				break;
			
			default: // 我的购物车
			
				// 获取购物车信息
				$data = $this -> cartLogic -> getCart();
				$this -> assign('data', $data);
				
				// 购物车的商品总数
				$total = $this -> cartLogic -> total();
				$this -> assign('total', $total);
				
				return $this -> fetch();
				
				break;
			
		}
		
		
	}
	
	// 添加购物车
	public function add()
	{
		$goods_id = input('goods_id/d');
		
		$item_id  = input('item_id/s');
		if(empty($item_id))
		{
			$item_id = '';
		}
		
		$number	= input('number/d');
		if(empty($number))
		{
			$number = 0;
		}
		
		
		if(empty($goods_id))
		{
			return ['code' => 0, 'msg' => '添加购物车失败'];
		}
		
		$result = $this -> cartLogic -> add($goods_id, $item_id, $number);
		if($result !== true)
		{
			return ['code' => 0, 'msg' => $result];
		}
		
		$total = $this -> cartLogic -> total();
		
		return ['code' => 1, 'count' => $total['count']];
		//return $this -> fetch();
	}
	
	// 修改购物车
	public function edit()
	{
		
		
		return $this -> fetch();
	}
	
	// 删除购物车
	public function del()
	{
		$cart_id = input('cart_id');
		if(empty($cart_id))
		{
			return ['code' => 0, 'msg' => '参数错误'];
		}
		
		$result = $this -> cartLogic -> del($cart_id);
		if($result !== true)
		{
			return ['code' => 0, 'msg' => $result];
		}
		
		$total = $this -> cartLogic -> total();
		return $total;
	}
	
	// 选中状态时的选择框
	public function ajaxChangeStatus()
	{
		$cart_id = input('cart_id');
		if(empty($cart_id))
		{
			return ['code' => 0, 'msg' => '参数错误'];
		}
		
		// 修改购物车商品状态	
		$this -> cartLogic -> status($cart_id);
		$total = $this -> cartLogic -> total();
		
		return $total;
	}
	
	// 购物车修改全部状态
	public function ajaxAllStatus($check)
	{
		$this -> cartLogic -> allStatus($check);
		$total = $this -> cartLogic -> total();
		
		return $total;
	}
	
	public function ajaxGetCount()
	{
		$total = $this -> cartLogic -> total();
		return ['count' => $total['count']];
	}
	
	// 修改购物车
	public function ajaxEditCart($goods_id, $key = '', $number = 1)
	{
		$this -> cartLogic -> edit($goods_id, $key, $number);
		$total = $this -> cartLogic -> total();
		return $total;
	}
	
	// 省份获取城市
	public function ajaxRegion($region_id = 0)
	{
		$region = db('region') -> where('parent_id', $region_id) -> select();
		$html = '';
		
		foreach($region as $key => $value)
		{
			$html .= "<option value='{$value['id']}'>{$value['name']}</option>";
		}
		
		die($html);
	}
	
}












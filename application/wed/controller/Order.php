<?php
namespace app\wed\controller;

use think\DB;

class Order extends Base
{
	protected $cartLogic;
	protected $user;
	
	public function _initialize()
	{
		parent::_initialize();
		$this -> cartLogic = model('Cart', 'logic');
		$this -> user = session('user');
		if(empty($this -> user))
		{
			return $this -> error('请先登录');
		}
	}
	
	// 保存订单
	public function saveOrder()
	{
		$address_id = input('address_id/d');
		if(empty($address_id))
		{
			return ['code' => 0, 'msg' => '收货地址有误'];
		}
		
		$address = db('address') -> find($address_id);
		if(empty($address))
		{
			return ['code' => 0, 'msg' => '收货地址不存在'];
		}
		
		$total = $this -> cartLogic -> total();
		
		// 订单表
		$data = [
			'order_sn' => date('YmdHis', time()) . mt_rand(0, 9999),
			'order_status' => 0,
			'pay_status' => 0,
			'user_id' => $this -> user['user_id'],
			'address' => $address['address'],
			'phone' => $address['phone'],
			'name' => $address['name'],
			'postal' => $address['postal'],
			'total' => $total['price'],
		];
		
		// 验证数据
		
		
		// 保存数据
		DB::startTrans();
		
		$order_id = DB::name('order') -> insertGetId($data);
		if(empty($order_id))
		{
			DB::rollback();
			return ['code' => 0, 'msg' => '订单提交失败'];
		}
		
		$cart = $this -> cartLogic -> getCart();
		
		// 订单商品表
		$goods = [];
		foreach($cart as $key => $value)
		{
			if($value['selected'] == 1)
			{
				$goods[] = [
					'order_id' => $order_id,
					'goods_id' => $value['goods_id'],
					'market_price' => $value['market_price'],
					'shop_price' => $value['shop_price'],
					'number' => $value['number'],
					'spec_price' => $value['spec_price'],
					'spec_key' => $value['spec_key'],
				];
			}
		}
		
		$row = DB::name('order_goods') -> insertAll($goods);
		if(empty($row))
		{
			DB::rollback();
			return ['code' => 0, 'msg' => '订单提交失败'];
		}
		
		// 删除购物车中的商品
		foreach($goods as $key => $value)
		{
			$cart_id = $value['goods_id'] . (! empty($value['spec_key']) ? ('_' . $value['spec_key']) : '');
			$this -> cartLogic -> del($cart_id);
		}
		
		DB::commit();
		
		return ['code' => 1, 'msg' => '订单提交成功', 'order_sn' => $data['order_sn']];
	}
	
}


































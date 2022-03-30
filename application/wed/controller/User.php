<?php
namespace app\wed\controller;

use think\DB;

class User extends Base
{
	protected $orderModel;
	
	public function _initialize()
	{
		parent::_initialize();
		$this -> orderModel = model('Order');		
	}
	
	// 用户中心
	public function index()
	{
		
		//$goods = model('Order')->get();
		
		//dump($goods->goods()->select());
		
		if(! empty(session('user')))
		{
			$data = model('User') -> find(session('user')['user_id']);
		}
		
		if(empty(session('user')))
		{
			$data = [
				'image' => '/static/wed/img/woqi.jpg',
				'username' => '祁知更',
				'phone' => '15119498976',
			];
		}
		
		$this -> assign('data', $data);
		
		
		// 获取用户看过的商品
		$seenData = [];
		if(cookie('?seen'))
		{
			$seen = cookie('seen');
			$seen = array_reverse($seen);
			
			foreach($seen as $key => $value)
			{
				$seenData[] = model('goods') -> where('id', $value) -> find(function($q){
					$q -> field('id, image');
				});
			}
		}
		
		$this -> assign('seenData', $seenData);
		
		
		// 获取用户喜欢的商品
		$likeData = [];
		if(cookie('?like'))
		{
			$like = cookie('like');
			arsort($like);
			$like = array_keys($like);
			
			// 只拿五条
			$seep = 0;
			
			foreach($like as $key => $value)
			{
				$seep += 1;
				if($seep > 5)
				{
					break;
				}
				
				$likeData[] = model('goods') -> where('id', $value) -> find(function($q){
					$q -> field('id, image');
				});
			}
			
		}
		
		$this -> assign('likeData', $likeData);		
		
		return $this -> fetch();
	}
	
	// 个人信息
	public function personal()
	{
		if(empty($this -> data))
		{
			if(! session('?user'))
			{
				return $this -> error('请登录后再查看信息');
			}
			
			$id = session('user')['user_id'];
			$user = model('User') -> get($id);
			
			$this -> assign('user', $user);
			
			if(request() -> isPost())
			{
				$data = [
					'id' 		=> $id,
					'username' 	=> input('username/s'),
					'sex' 		=> input('sex/d'),
					'phone' 	=> input('phone/s'),
					'qq' 		=> input('qq/d'),
					'email' 	=> input('email/s'),
					'image' 	=> input('image/s'),
				];
				
				if(input('?password') || input('?password2'))
				{
					$data['password'] = input('password/s');
					$data['password2'] = input('password2/s');
				}
				
				// 验证验证码是否正确
				if(!captcha_check(input('vcode')))
				{
					//验证失败
					return $this -> error('验证码错误');
				};
				
				
				$valiResult = $this -> validate($data, [
					'username|用户名'	=> 'require|unique:user',
					'password|密码' 	=> 'confirm:password2',
					'sex|性别' 			=> 'require|number',
					'phone|手机号' 		=> 'require|regex:^1[3456789][0126789]\d{8}$',
					'qq|QQ' 			=> 'require|number',
					'email|邮箱' 		=> 'require',
				]);
				
				if($valiResult !== true)
				{
					return $this -> error($valiResult);
				}
				
				$data['password'] = md5($data['password']);
				
				unset($data['password2']);
				
				$result = model('user') -> update($data);
				if(empty($result))
				{
					return $this -> error('修改失败');
				}
				
				return $this -> success('修改成功', url('wed/user/index'));
				
			}
			
			$this -> data = $this -> fetch();
			// akali_cache($this -> data);
		}
		
		return $this -> data;
	}
	
	// 查看地址
	public function address()
	{
		if(empty(session('user')))
		{
			return $this -> error('请先登录', url('wed/logins/index'));
		}
		
		$province = db('region') -> where('parent_id', 0) -> select();
		$this -> assign('province', $province);
		
		$user_id = session('user');
		$userAddress = db('address') -> where('user_id', $user_id['user_id']) -> select();
		
		$this -> assign('userAddress', $userAddress);
		
		if(request() -> isAjax())
		{
			$user = session('user');
			
			$address_id = input('address_id/d');
			
			$address = db('address') -> where('user_id', $user['user_id']) -> update(['default' => 0]);
			if(empty($address))
			{
				return ['code' => 0, 'msg' => '设置失败'];
			}
			
			$address = db('address') -> where('id', $address_id) -> update(['default' => 1]);
			if(empty($address))
			{
				return ['code' => 0, 'msg' => '设置失败'];
			}
			
			return ['code' => 1, 'msg' => '设置成功'];
		}
		
		return $this -> fetch('address');
	}
		
	// 账户安全
	public function safety()
	{
		if(! session('?user'))
		{
			return $this -> error('请登录后再修改信息');
		}
		
		$id = session('user')['user_id'];
		$user = model('User') -> get($id);
		
		$this -> assign('user', $user);
		
		if(request() -> isPost())
		{
			$data = [
				'id' 		=> $id,
				'name' 		=> input('name/s'),
				'password' 	=> input('password2/s'),
				'password2' => input('password2/s'),
			];
			
			// 验证验证码是否正确
			if(!captcha_check(input('vcode')))
			{
				//验证失败
				return $this -> error('验证码错误');
			};
			
			
			$valiResult = $this -> validate($data, [
				'username|用户名'	=> 'require|unique:user',
				'password|密码' 	=> 'confirm:password2',
			]);
			
			if($valiResult !== true)
			{
				return $this -> error($valiResult);
			}
			
			$data['password'] = md5($data['password']);
			
			unset($data['password2']);
			
			$result = model('user') -> update($data);
			if(empty($result))
			{
				return $this -> error('修改失败');
			}
			
			return $this -> success('修改成功', url('wed/user/index'));
			
		}
		
		return $this -> fetch();
	}
	
	// ajax 待付款
	public function obligation()
	{
		if(request() -> isAjax())
		{
			$user = session('user');
			if(empty($user))
			{
				return ['code' => 0, 'msg' => '请登录在查看'];
			}
			
			$status = input('status/d');
			
			$order = $this -> orderModel
			-> where('order_status', $status)
			-> where('pay_status', 0)
			-> where($user['user_id'])
			-> find();
			
			$order_id = ! empty($order) ? $order -> id : '';
			
			if(empty($order_id) && $status === 0)
			{
				return ['code' => 0, 'msg' => '没有待付款商品'];
			}
			
			if(empty($order_id) && $status === 1)
			{
				return ['code' => 0, 'msg' => '没有待发货商品'];
			}
			
			if(empty($order_id) && $status === 2)
			{
				return ['code' => 0, 'msg' => '没有待收货商品'];
			}
			
			if(empty($order_id) && $status === 3)
			{
				return ['code' => 0, 'msg' => '没有待评价商品'];
			}
			
			if(empty($order_id) && $status === 4)
			{
				return ['code' => 0, 'msg' => '没有退款商品'];
			}
			
			$goods = $order -> goods() -> select();
			
			// $goods_id = db('order_goods') -> where('order_id', 'in', $order_id) -> column('goods_id');
			
			// $goods = model('Goods') -> where('id', 'in', $goods_id) -> select(function($q){
				// $q -> field('id, image');
			// }) -> toArray();
			
			$html = '';
			foreach($goods as $key => $value)
			{
				$html .= <<<AKALI
					<li>
					
						<a href="{url('wed/goods/product_center', {$value['id']})}">
						
							<img class="img-responsive" src="/{$value['image']}" alt="seen_product" style="width:156px;height:175px;"/>
							
						</a>
						
					</li>
AKALI;
			}
			
			if($status === 0)
			{
				return ['code' => 1, 'html' => $html, 'title' => '待付款'];
			}
			
			if($status === 1)
			{
				return ['code' => 1, 'html' => $html, 'title' => '待发货'];
			}
			
			if($status === 2)
			{
				return ['code' => 1, 'html' => $html, 'title' => '待收货'];
			}
			
			if($status === 3)
			{
				return ['code' => 1, 'html' => $html, 'title' => '待评价'];
			}
			
			if($status === 4)
			{
				return ['code' => 1, 'html' => $html, 'title' => '退款'];
			}
		}
	}
	
	// ajax 已买到的服装
	public function purchase()
	{
		if(request() -> isAjax())
		{
			$user = session('user');
			if(empty($user))
			{
				return ['code' => 0, 'msg' => '请登录在查看'];
			}
			
			$status = input('status/d');
			
			$order_id = $this -> orderModel
			-> where('pay_status', $status)
			-> where($user['user_id'])
			-> column('id');
			
			if(empty($order_id))
			{
				return ['code' => 0, 'msg' => '没有已买到的服装'];
			}
			
			$goods_id = db('order_goods') -> where('order_id', 'in', $order_id) -> column('goods_id');
			
			$goods = model('Goods') -> where('id', 'in', $goods_id) -> select(function($q){
				$q -> field('id, image');
			}) -> toArray();
			
			$html = '';
			foreach($goods as $key => $value)
			{
				$html .= <<<AKALI
					<li>
					
						<a href="{url('wed/goods/product_center', {$value['id']})}">
						
							<img class="img-responsive" src="/{$value['image']}" alt="seen_product" style="width:156px;height:175px;"/>
							
						</a>
						
					</li>
AKALI;
			}
			
			//$goods = $order -> goods() -> all();
			
			return ['code' => 1, 'html' => $html, 'title' => '已买到的服装'];
			
		}
	}
	
	// 用户地址
	public function ajaxSaveAddress()
	{
		if(request() -> isAjax())
		{
			$user = session('user');
			if(empty($user))
			{
				return ['code' => 0, 'msg' => '请登录在查看'];
			}
			
			$province = $this -> getAaeaName(input('province/d'));
			$city = $this -> getAaeaName(input('city/d'));
			$area = $this -> getAaeaName(input('area/d'));
			
			$address = $province . $city .$area . input('datailAddress/s');
			
			$data = [
				'name' => input('username/s'),
				'phone' => input('phone/s'),
				'address' => $address,
				'postal' => input('postal/d'),
				'user_id' => $user['user_id'],
				'default' => input('?defaultAddress') ? 1 : 0,
			];
			
			// 验证数据
			//$this ->validate($data, true);
			
			// 开启事务
			DB::startTrans();
			
			// 如果是默认地址
			if($data['default'] == 1)
			{
				$row = DB::name('address') -> where('user_id', $data['user_id']) -> update(['default' => 0]);
				if(empty($row))
				{
					DB::rollback();
					return ['code' => 0, 'msg' => '保存失败'];
				}
			}
			
			// 如果不是默认地址
			if(empty($data['default']))
			{
				$result = DB::name('address') -> where('user_id', $data['user_id']) -> where('default', 1) -> find();
			
				if(empty($result))
				{
					$data['default'] = 1;
				}
			}
			
			// 保存
			$id = DB::name('address') -> insertGetId($data);
			if(empty($id))
			{
				DB::rollback();
				return ['code' => 0, 'msg' => '保存失败'];
			}
			
			DB::commit();
			
			$setup = ! empty($data['default']) ? 'setup' : 'akali';
			
			$html = <<<AKALI
				<li>

					<div class="place_message default_massage">

						<p>收货人：{$data['name']}</p>

						<p>所在地区：{$data['address']}</p>

						<p>邮编：{$data['postal']}</p>

						<p>电话：{$data['phone']}</p>

					</div>

					<a class="{$setup}" href="###">设为默认地址</a>
					
					<a class="akali" href="###">删除</a>

				</li>
AKALI;
			
			return ['code' => 1, 'html' => $html];
		}
		
	}
	
	protected function getAaeaName($region_id)
	{
		return db('region') -> where('id', $region_id) -> value('name');
	}
	
}


























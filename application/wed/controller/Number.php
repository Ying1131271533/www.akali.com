<?php
namespace app\wed\controller;

use think\Controller;

class Number extends Controller
{
	protected $jmUserModel;
	protected $numberModel;
	protected $jmKdModel;
	public function _initialize()
	{
		parent::_initialize();
		$this -> jmUserModel = model('JmUser');
		$this -> numberModel = model('Number');
		$this -> jmKdModel = model('JmKd');
	}
	
	function index()
	{
		$key = input('key/s', '');
		$action = input('action/s', '');
		$kdid = input('kdid/d', 0);
		
		
		// 找出商家信息
		$jmUser = $this -> jmUserModel -> where('key', $key) -> find();
		
		preg_match('/^[a-zA-Z]+$/', $action) || $this -> varJson('非法调用');
		! empty($jmUser) || $this -> varJson('用户不存在', 100001);
		
		switch ($action) {
			// 获取快递单号
			case 'number':
				
				$where = [
					'kdid' => $kdid,
					'type' => 1,
				];
				
				// 开启事务
				$this -> jmUserModel -> startTrans();
				
				$number = $this -> numberModel -> where($where) -> value('number');
				! empty($number) or $this -> varJson('快递单号不足', 100002);
				
				// 等级成本价
				// $price = $this -> jmKdModel -> where('kdid', $kdid) -> value('level'.$jmUser['level']);
				// 统一成本价
				$price = $this -> jmKdModel -> where('kdid', $kdid) -> value('price');
				
				// 商家的余额是否足够
				if($jmUser['money'] < $price)
				{
					$this -> jmUserModel -> rollback();
					$this -> varJson('快递单号不足', 100003);
				}
				
				// 修改单号状态
				$type = $this -> numberModel -> save(['type' => 2], ['number' => $number]);
				if(empty($type))
				{
					$this -> jmUserModel -> rollback();
					$this -> varJson('发生故障，请刷新页面', 100005);
				}
				
				// 减少加盟商家余额
				$result = $this -> jmUserModel -> where('id', $jmUser['id']) -> setDec('money', $price);
				// dump($jmUser['id']);return;
				if(empty($result))
				{
					$this -> jmUserModel -> rollback();
					$this -> varJson('发生故障，请刷新页面', 100004);
				}
				
				$this -> jmUserModel -> commit();
				$this -> varJson('success', 0, ['number' => $number, 'cost_price' => $price],  $_SERVER['REMOTE_ADDR']);
				break;
			case 'numbers':
				$this -> varJson('这是批量下单');
				break;
			case 'count':
				$where = [
					'kdid' => $kdid,
					'type' => 1,
				];
				
				$count = $this -> numberModel -> where($where) -> count();
				
				$this -> varJson('success', 0, ['count' => $count],  $_SERVER['REMOTE_ADDR']);
				break;
			default:
				$this -> varJson('非法调用');
				break;
		}
	}
	
	
	// 发送的数据
	function varJson($msg = '', $code = 10000, $data = array(), $location = '') {
		$nuber = array();
		$nuber['code'] = $code ?: 0;
		$nuber['msg'] = $msg ?: ($data['code'] ? 'error' : 'success');
		$nuber['data'] = $data ?: array();
		$nuber['location'] = $location;
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($nuber, JSON_HEX_TAG);
		exit(0);
	}
	
}


















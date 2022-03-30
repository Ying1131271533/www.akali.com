<?php
namespace app\admin\controller;

use think\Db;

/**
 * ORM : 对象关系映射
 * 一张表为一个类（一个模型）
 * 一行数据为一个对象
 * 一个字段为一个属性
 */
 
class Message extends Base
{
	protected $messageModel;
	
	public function _initialize()
	{
		parent::_initialize();
		$this -> messageModel = model('Message');
		$this -> messageLogic = model('Message', 'logic');
	}
	
	
	// 留言列表
	public function index()
	{
		$message = $this -> messageModel -> order('id', 'desc') -> paginate(10);
		
		$this -> assign('message', $message);
		
		return $this -> fetch();
	}

	// 留言添加页面
	public function add()
	{
		if(request() -> isPost())
		{
			$result = $this -> messageLogic -> add(input());
			if($result !== true)
			{
				return $this -> error($result);
			}
			
			return $this -> success('保存成功', url('admin/message/index'));
		}
		
		return $this -> fetch();
	}
	

	// 留言修改
	public function edit()
	{
		$id = input('id/d');
		if(empty($id))
		{
			return $this -> error('参数错误');
		}
		
		$message = $this -> messageModel -> get($id);
		if(empty($message))
		{
			return $this -> error('该用户不存在');
		}
		
		$this -> assign('message', $message);
		
		if(request() -> isPost())
		{
			$data = [
				'id' => input('id/d'),
				'name' => input('name/s'),
				'phone' => input('phone/s'),
				'email' => input('email/s'),
				'content' => input('content/s'),
			];
			
			$result = $this -> messageLogic -> edit($data);
			
			if($result !== true)
			{
				return $this -> error($result);
			}
			
			return $this -> success('保存成功');
		}
		
		return $this -> fetch();
	}
	
	// 留言删除
	public function del()
	{
		$id = input('id/d');
		if(empty($id))
		{
			return ['code' => 0, 'msg' => '参数错误'];
		}
		
		if(request() -> isAjax())
		{
			$message = $this -> messageModel -> get($id);
			if(empty($message))
			{
				return $this -> error('该留言不存在');
			}
			
			$result = $message -> delete();
			if(empty($result))
			{
				return ['code' => 0, 'msg' => '删除失败'];
			}
			
			return ['code' => 1, 'msg' => '删除成功'];
		}
		
	}
	
}



















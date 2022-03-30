<?php
namespace app\admin\logic;

use think\Model;

class Message extends \app\admin\model\Message
{
	public function add($params)
	{
		$data = [
			'name' => $params['name'],
			'phone' => $params['phone'],
			'email' => $params['email'],
			'content' => $params['content'] = isset($params['content']) ? $params['content'] : '',
			'create_time' => time(),
		];
		
		$result = $this -> validate(true) -> save($data);
		
		if($result === false)
		{
			return $this -> getError();
		}
		
		if(empty($result))
		{
			return '保存失败';
		}
		
		return true;
	}
	
	public function edit($data)
	{
		// 验证数据
		$aboutResult = $this -> validate(true) -> isUpdate(true) -> save($data);
		
		if($aboutResult === false)
		{
			return $this -> getError();
		}
		
		if(empty($aboutResult))
		{
			return '保存失败';
		}
		
		return true;
		
	}
}

























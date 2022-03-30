<?php
namespace app\wed\controller;

use think\Controller;
//use think\Db;

class Message extends Base
{
    public function index()
    {
		$company = db('Company') -> order('id', 'desc') -> find();		
		$this -> assign('company', $company);
		
		return $this -> fetch();
    }
	
    public function add()
    {
		if(request() -> isAjax())
		{
			$data = [
				'name' => input('name'),
				'phone' => input('phone'),
				'email' => input('email'),
				'content' => input('content'),
				'create_time' => time(),
			];
			
			if($data['name'] == '姓名')
			{
				return ['code' => 0, 'msg' => '姓名不能为空'];
			}
			
			if($data['phone'] == '手机')
			{
				return ['code' => 0, 'msg' => '手机不能为空'];
			}
			/*
			$phoneText ='/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/';
			$phoneText2 = "/^0\d{2,3}(\-)?\d{7,8}$/";
			
			if(! preg_match($phoneText, $data['phone']) && ! preg_match($phoneText2, $data['phone']))
			{
				die(json_encode(['code' => 0, 'msg' => '电话格式不正确']));
			}
			
			if($data['email'] == '邮箱')
			{
				return ['code' => 0, 'msg' => '邮箱不能为空'];
			}
			
			$pattern = "/^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,3}$/";
				
			if(! preg_match($pattern, $data['email']))
			{
				die(json_encode(['code' => 0, 'msg' => '邮箱格式不正确']));
			}
			*/
			if($data['content'] == '留言')
			{
				return ['code' => 0, 'msg' => '留言不能为空'];
			}
			
			// 验证数据
			$result = $this -> validate($data, 'Message');
			
			if($result !== true)
			{
				return ['code' => 0, 'msg' => $result];
			}
			
			$result = db('message') -> insert($data);
			
			if(empty($result))
			{
				return ['code' => 0, 'msg' => '留言失败'];
			}
			
			return ['code' => 1, 'msg' => '留言成功'];
		}
		
		return ['code' => 0, 'msg' => '非法操作'];
    }
	
}


















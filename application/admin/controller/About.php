<?php
namespace app\admin\controller;

use think\Db;

class About extends Base
{
	protected $aboutModel;
	public function _initialize()
	{
		parent::_initialize();
		$this -> aboutModel = model('About');
	}
	
	// 介绍列表
	public function index()
	{
		$about = $this -> aboutModel -> order('id', 'desc') -> paginate(10);
		
		$this -> assign('about', $about);
		
		return $this -> fetch();
	}

	// 介绍添加页面
	public function add()
	{
		if(request() -> isPost())
		{
			$data = [
				'title' => input('title/s'),
				'image' => input('image/s'),
				'content' => input('content/s'),
				'create_time' => time(),
			];
			
			// 验证数据
			$aboutResult = $this -> validate($data, 'About');
			if($aboutResult !== true)			
			{
				return $this -> error($aboutResult);
			}
			
			// 保存数据
			$about = $this -> aboutModel -> save($data);
			if(empty($about))
			{
				return $this -> error('保存失败');
			}
			
			return $this -> success('保存成功', url('admin/about/index'));
			
		}
		
		return $this -> fetch();
	}
	

	// 介绍修改
	public function edit()
	{
		$id = input('id/d');
		if(empty($id))
		{
			return $this -> error('参数错误');
		}
		
		$about = $this -> aboutModel -> get($id);
		if(empty($about))
		{
			return $this -> error('该介绍不存在');
		}
		
		$this -> assign('about', $about);
		
		if(request() -> isPost())
		{
			$data = [
				'id' => $id,
				'title' => input('title/s'),
				'image' => input('image/s'),
				'content' => input('content/s'),
			];
			
			// 验证数据
			$aboutResult = $this -> validate($data, 'About');
			if($aboutResult !== true)			
			{
				return $this -> error($aboutResult);
			}
			
			// 保存数据
			$about = $this -> aboutModel -> update($data);
			if(empty($about))
			{
				return $this -> error('保存失败');
			}
			
			return $this -> success('保存成功', url('admin/about/index'));
			
		}
		
		return $this -> fetch();
	}
	
	// 介绍删除
	public function del()
	{
		$id = input('id/d');
		if(empty($id))
		{
			return ['code' => 0, 'msg' => '参数错误'];
		}
		
		if(request() -> isAjax())
		{
			$about = $this -> aboutModel -> get($id);
			if(empty($about))
			{
				return $this -> error('该介绍不存在');
			}
			
			$result = $about -> delete();
			if(empty($result))
			{
				return ['code' => 0, 'msg' => '删除失败'];
			}
			
			return ['code' => 1, 'msg' => '删除成功'];
		}
		
	}
	
}



















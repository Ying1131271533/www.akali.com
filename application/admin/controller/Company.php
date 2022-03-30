<?php
namespace app\admin\controller;

use think\Db;

class Company extends Base
{
	protected $companyModel;
	public function _initialize()
	{
		parent::_initialize();
		$this -> companyModel = model('Company');
	}
	
	// 介绍列表
	public function index()
	{
		$company = $this -> companyModel -> order('id', 'desc') -> paginate(10);
		
		$this -> assign('company', $company);
		
		return $this -> fetch();
	}

	// 介绍添加页面
	public function add()
	{
		if(request() -> isPost())
		{
			$data = [
				'address' => input('address/s'),
				'phone' => input('phone/s'),
				'preserve' => input('preserve/s'),
				'email' => input('email/s'),
				'postcode' => input('postcode/d'),
				'create_time' => time(),
			];
			
			// 验证数据
			$companyResult = $this -> validate($data, 'Company');
			if($companyResult !== true)			
			{
				return $this -> error($companyResult);
			}
			
			// 保存数据
			$about = $this -> companyModel -> save($data);
			if(empty($about))
			{
				return $this -> error('保存失败');
			}
			
			return $this -> success('保存成功', url('admin/company/index'));
			
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
		
		$company = $this -> companyModel -> get($id);
		if(empty($company))
		{
			return $this -> error('该信息不存在');
		}
		
		$this -> assign('company', $company);
		
		if(request() -> isPost())
		{
			$data = [
				'id' => input('id/d'),
				'address' => input('address/s'),
				'phone' => input('phone/s'),
				'preserve' => input('preserve/s'),
				'email' => input('email/s'),
				'postcode' => input('postcode/d'),
			];
			
			// 验证数据
			$companyResult = $this -> validate($data, 'Company');
			if($companyResult !== true)			
			{
				return $this -> error($companyResult);
			}
			
			// 保存数据
			$company = $this -> companyModel -> update($data);
			if(empty($company))
			{
				return $this -> error('保存失败');
			}
			
			return $this -> success('保存成功', url('admin/company/index'));
			
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
			$company = $this -> companyModel -> get($id);
			if(empty($company))
			{
				return $this -> error('该信息不存在');
			}
			
			$result = $company -> delete();
			if(empty($result))
			{
				return ['code' => 0, 'msg' => '删除失败'];
			}
			
			return ['code' => 1, 'msg' => '删除成功'];
		}
		
	}
	
}



















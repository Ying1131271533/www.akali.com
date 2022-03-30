<?php
namespace app\admin\controller;

class GoodsType extends Base
{
	public function index()
    {
		// 获取文章分类
		$cateData = db('goods_type') -> order('type_id', 'desc') -> select();
		
		// 分配到视图
		$this -> assign('cateData', $cateData);
		
		return $this -> fetch();
    }
	
	public function add()
	{
		if(request() -> isPost())
		{
			// 组装数据
			$data = [
				'type_name' => input('type_name'),
			];
			
			// 验证数据
			$valiResult = $this -> validate($data, 'GoodsType');
			if($valiResult !== true)
			{
				return $this -> error($valiResult);
			}
			
			// 添加数据
			$row = db('goods_type') -> insertGetId($data);
			
			if(empty($row))
			{
				return $this -> error('添加失败');
			}
			
			return $this -> success('添加成功', url('admin/goods_type/index'));
			
		}
		
		return $this -> fetch();
	}
	
	public function edit()
	{
		
		
		return $this -> fetch();
	}
	
	public function del()
	{
		
		
		return $this -> fetch();		
	}
	
}


















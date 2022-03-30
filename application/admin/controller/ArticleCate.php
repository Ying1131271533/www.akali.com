<?php
namespace app\admin\controller;

class ArticleCate extends Base
{
	// 分批框架里面 ArticleCate 等于 Article_cate

	// 文章分类管理
	public function index()
    {
		// 获取文章分类
		$cateData = db('article_cate') -> order('cid', 'desc') -> select();
		// 分配到视图
		$this -> assign('cateData', $cateData);
		
		return $this -> fetch();
    }
	
	// 文章分类添加页面
	public function add()
	{
		if(request() -> isPost())
		{
			// 组装数据
			$date = [
				'cate_name' => input('cate_name'),
			];
			
			// 验证数据
			$valiResult = $this -> validate($date, 'ArticleCate');
			if($valiResult !== true)
			{
				return $this -> error($valiResult);
			}
			
			// 添加数据
			$row = db('article_cate') -> insertGetId($date);
			
			if(empty($row))
			{
				return $this -> error('添加失败');
			}
			
			return $this -> success('添加成功', url('admin/article_cate/index'));
			
		}
		
		return $this -> fetch();
	}

	// 文章分类修改
	public function edit()
	{
		if(! input('?cid'))
		{
			return $this -> error('参数不正确');
		}
		
		$cid = input('cid');
		
		// 查询数据
		$cateData = db('article_cate') -> find($cid);
		if(empty($cateData))
		{
			return $this -> error('找不到该分类');
		}
		
		if(Request() -> isPost())
		{
			// 组装数据
			$data = [
				'cate_name' => input('cate_name'),
				'cid' 		=> $cid,
			];
		
			// 验证数据
			$valiResult = $this -> validate($data, 'ArticleCate');
			if($valiResult !== true)
			{
				$this -> error($valiResult);
			}
			
			// 修改数据
			$row = db('article_cate') -> update($data);
			
			if(empty($row))
			{
				$this -> error('修改失败');
			}
			
			return $this -> success('修改成功', url('admin/article_cate/index'));
		
		}
		
		// 分配变量到视图
		$this -> assign('cateData', $cateData);
		
		// 加载视图
		return $this -> fetch();
	}
	
	// 文章分类删除
	public function del()
	{
		if(! input('?cid'))
		{
			return $this -> error('参数错误');
		}
		
		$cid = input('cid');
		
		$row = db('article_cate') -> delete($cid);
		
		if(empty($row))
		{
			return $this -> error('删除失败', url('admin/article_cate/index'));
		}
		
		return $this -> success('删除成功', url('admin/article_cate/index'));
		
	}
	
}


















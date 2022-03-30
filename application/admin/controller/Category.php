<?php
namespace app\admin\controller;

class Category extends Base
{
	protected $cateModel;
	protected $cateLogic;
	
	public function _initialize()
	{
		parent::_initialize();		
		$this -> cateModel = model('Category');
		$this -> cateLogic = model('Category', 'logic');
	}
	
	// 分类管理
	public function index()
    {
		// 找出所有顶级分类
		$cateList = $this -> cateLogic -> getCateList(['pid' => 0]);
		$this -> assign('cateList', $cateList);
		
		return $this -> fetch();
    }
	
	// 分类添加
	public function add()
	{
		if(request() -> isPost())
		{
			// 组装数据
			$data = [
				'cate_name' => input('cate_name/s'),
				'pid' 		=> input('pid/d'),
				'path' 		=> '0',
			];
			
			// 触发器
			$this -> cateModel -> event('after_insert', function ($data) {
				// 找出父级分类的 path 的值
				$path = $this -> cateModel -> where('id', $data -> pid) -> value('path');
				$data -> path = (! empty($path) ? $path . '_' : '') . $data -> id;
				$data -> save();
			});
			
			// 验证数据
			$result = $this -> cateModel -> validate(true) -> save($data);
			if($result === false)
			{
				return $this -> error($this -> cateModel -> getError());
			}
			
			if(empty($result))
			{
				return $this -> error('添加失败');
			}
			
			return $this -> success('添加成功', url('admin/category/index'));
		}
		
		// 找出父类
		//$cateData = $this -> cateModel -> all();
		
		$cateData = $this -> cateLogic -> recursionCate();
		
		$inputHtml = $this -> cateLogic -> recursionCateInput($cateData);
		
		$this -> assign('inputHtml', $inputHtml);
		
		return $this -> fetch();
	}

	// 分类修改
	public function edit()
	{
		if(! input('?id'))
		{
			return $this -> error('参数错误');
		}
		
		$id = input('id/d');
		
		// 找出当前分类
		$data = $this -> cateModel -> get($id);
		if(empty($data))
		{
			return $this -> error('找不到该分类');
		}
		
		if(request() -> isPost())
		{
			// 组装数据
			$data = [
				'cate_name' => input('cate_name/s'),
				'pid' 		=> input('pid/d'),
				'id' 		=> $id,
				//'path' 		=> $id,
			];
			
			// 触发器
			$this -> cateModel -> event('after_update', function ($data) {
				// 找出当前分类的数据
				$cateData = $this -> cateModel -> get($data -> id);
				
				// 找出当前分类的父级分类数据
				$parentData = $this -> cateModel -> get(['id' => $data -> pid]);
				
				// 组装新的 path
				$pathStr = (! empty($parentData) ? $parentData -> path . '_' : '') .  $data -> id;
				
				// 当前分类的path 与 新组装出来的path不一致的时候
				if($cateData -> path != $pathStr)
				{
					// 把当前的path修改为新的path
					$data -> path = $pathStr;
					$data -> save();
					
					// 修改子类 path
					$childData = $this -> cateModel -> where('path', 'like', "{$cateData -> path}%") -> select();
					foreach($childData as $key => $value)
					{
						// 把子类中的path替换
						$value -> path = str_replace($cateData -> path, $pathStr, $value -> path);
						$value -> save();
					}
					
				}
				
			});
			
			// 验证数据
			$result = $this -> cateModel -> validate(true) -> isUpdate(true) -> save($data);
			if($result === false)
			{
				return $this -> error($this -> cateModel -> getError());
			}
			
			if(empty($result))
			{
				return $this -> error('编辑失败');
			}
			
			return $this -> success('编辑成功', url('admin/category/index'));
		}
		
		$this -> assign('data', $data);
		
		// 找出父类
		$cateData = $this -> cateLogic -> recursionCate();		
		$inputHtml = $this -> cateLogic -> recursionCateInput($cateData, $data -> pid);		
		$this -> assign('inputHtml', $inputHtml);
		
		return $this -> fetch();
	}
	
	// 分类删除
	public function del()
	{
		$id = input('id/d');
		if(empty($id))
		{
			return ['code' => 0, 'msg' => '参数错误'];
		}
		
		if(request() -> isAjax())
		{
			$cate = $this -> cateModel -> get($id);
			if(empty($cate))
			{
				return $this -> error('该分类不存在');
			}
			
			$result = $cate -> delete();
			if(empty($result))
			{
				return ['code' => 0, 'msg' => '删除失败'];
			}
			
			return ['code' => 1, 'msg' => '删除成功'];
		}
	}
	
	// ajax获取下级分类列表
	public function ajaxGetChildList($path = '')
	{
		if(empty($path))
		{
			return ['code' => 1, 'html' => ''];
		}
		
		$pathArray = explode('_', $path);
		$pid = end($pathArray);
		
		$cateList = $this -> cateLogic -> getCateList(['pid' => $pid]);
		$html = '';
		
		$paddingLeft = 'style="padding-left:' . (count($pathArray) * 3) . 'em"';
		
		foreach($cateList as $key => $value)
		{
			$childSpan = ! empty($value -> is_child) ? '<span class="glyphicon glyphicon-plus akali" style="padding:2px; font-size:12px;" onclick="rowClicked(this)"></span>' : '';
			
			$editUrl = url('admin/category/edit', ['id' => $value -> id]);
			
			$html .= <<<AKALI
				<tr data-path="{$value -> path}">
						<td>{$value -> id}</td>
						<td {$paddingLeft}>
							{$childSpan}
							{$value -> cate_name}
						</td>
						<td>
							<a href="{$editUrl}" style="margin-right:10px;">
								<span class="glyphicon glyphicon-pencil"></span>
							</a>								
							<a href="javascript:;" onclick="del(this, {$value -> id})">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						</td>
					</tr>
AKALI;
		
		}
		
		return ['code' => 1, 'html' => $html];
		
	}
	
}












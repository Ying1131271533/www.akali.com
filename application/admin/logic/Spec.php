<?php
namespace app\admin\logic;

use think\Model;

class Spec extends \app\admin\model\Spec
{
	public function getSpecData($params = 0)
	{
		return $this -> get($params);
	}
	
	public function getList($params = [])
	{
		return $this -> all();
	}
	
	public function edit($params = [])
	{
		$data = [
			'spec_name' => ! empty($params['spec_name']) ? $params['spec_name'] : '',
			'type_id' 	=> ! empty($params['type_id']) ? $params['type_id'] : 0,
		];
		
		// 当接收到 spec_id 的时候，是修改数据
		if(! empty($params['spec_id']))
		{
			$data['spec_id'] = $params['spec_id'];
		}
		
		// 开启事务
		$this -> startTrans();
		
		$result = $this -> validate(true) -> isUpdate(! empty($params['spec_id']) ? true : false) -> save($data);
		
		
		if($result === false)
		{
			return $this -> error($this -> getEroor());
		}
		
		if(empty($result) && empty($params['spec_id']))
		{
			$this -> rollback();
			return '保存失败';
		}
		
		if(empty($params['spec_values']))
		{
			$this -> rollback();
			return '选项值不能为空';
		}
		
		// 把接收到的选项字符串转换成数组
		$specItem = explode("\r\n", $params['spec_values']);
		if(! empty($params['spec_id']))
		{
			$requestItems = $specItem;
		
			// 找出旧的 items
			$oldItems = $this -> items() -> column('item_name');
			
			// $requestItems 与 $oldItems 数组的交集 为保留数据
			// $requestItems 与 $oldItems 数组的差集 为新增数据
			// $oldItems 与 $requestItems 数组的差集 为删除数据
			
			$addItems = array_diff($requestItems, $oldItems);
			$delItems = array_diff($oldItems, $requestItems);
			// 删除
			$this -> items() -> where('item_name', 'in', ! empty($delItems) ? $delItems : 0) -> delete();
			
			$specItem = $addItems;
		}
		
		$itemArray = [];
		
		// 数组去除重复数据
		array_unique($specItem);
		foreach($specItem as $key => $value)
		{
			if(! empty($value))
			{
				// 组装数据
				$itemArray[] = [
					'item_name' => $value,
				];
			}
		}
		
		$row = $this -> items() -> saveAll($itemArray);
		
		if(empty($row) && (empty($params['spec_id']) || ( empty($result) && ! empty($params['spec_id']))))
		{
			$this -> rollback();
			return '保存失败';
		}
		
		$this -> commit();
		return true;
	}
}

























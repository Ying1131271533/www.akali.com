<?php
namespace app\wed\logic;

use think\Model;

class Attribute extends \app\admin\model\Attribute
{
	public function getAttrData($attr_id)
	{
		return $this -> get($attr_id);
	}
	
	public function getList(array $params = [])
	{
		$listData = $this -> paginate();
		return $listData;
	}
	
	public function edit(array $params = [])
	{
		$data = [
			'attr_name' => (string) ! empty($params['attr_name']) ? $params['attr_name'] : '',
			'type_id'  => ! empty($params['type_id']) ? $params['type_id'] : '',
			'attr_index'  => ! empty($params['attr_index']) ? $params['attr_index'] : '',
			'attr_input_type'  => ! empty($params['attr_input_type']) ? $params['attr_input_type'] : '',
			'attr_values'  => ! empty($params['attr_values']) ? $params['attr_values'] : '',
		];
		
		if(! empty($params['attr_id']))
		{
			$data['attr_id'] = $params['attr_id'];
		}
		
		$result = $this -> validate(true) -> isUpdate(! empty($params['attr_id']) ? true : false) -> save($data);
		
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
}

























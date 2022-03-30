<?php
namespace app\wed\logic;

use think\Model;

class Category extends \app\wed\model\Category
{
	public function getChilId($pid = 0)
	{
		static $cateData;
		
		if(empty($cateData))
		{			
			$cateData = $this -> getCateList();
		}
		
		$tempArray = [];
		foreach($cateData as $key => $value)
		{
			if($value -> pid == $pid)
			{
				$temp = $this -> getChilId($value -> id);
				$tempArray[] = $value -> id;
				$tempArray = array_merge($tempArray, $temp);
			}
		}
		
		return $tempArray;
	}
	
	// 递归找出子级
	public function recursionCate($pid = 0)
	{
		static $cateData;
		
		if(empty($cateData))
		{			
			$cateData = $this -> getCateList();
		}
		
		$tempArray = [];
		foreach($cateData as $key => $value)
		{
			$temp = $value -> toArray();
			if($value -> pid == $pid)
			{
				$temp['child'] = $this -> recursionCate($value -> id);
				$tempArray[] = $temp;
			}
		}
		
		return $tempArray;
	}
	
	public function recursionCateInput($data = [], $select = 0, $connector = '')
	{
		if(empty($data))
		{
			return null;
		}
		
		$connector .= '----';
		
		$html = '';
		foreach($data as $key => $value)
		{
			$isSelected = $select == $value['id'] ? 'selected = "selected"' : '';
			
			$html .= <<<AKALI
			<option value="{$value['id']}" {$isSelected}>|-{$connector}{$value['cate_name']}</option>
AKALI;
			if(! empty($value['child']))
			{
				$html .= $this -> recursionCateInput($value['child'], $select, $connector);
			}
		}
		
		return $html;
	}
	
	public function getCateList($param = [])
	{
		return $this -> all($param);
	}
	
}


















<?php
namespace app\admin\logic;

use think\Model;

class Goods extends \app\admin\model\Goods
{
	// 获取商品列表
	public function getList($params = [])
	{
		$where = null;
		$query = [];
		if(! empty($params['keywords']))
		{
			$where['goods_name'] = ['like', "%{$params['keywords']}%"];
			$query['keywords'] = $params['keywords'];
		}
		
		if(! empty($params['brand_id']))
		{
			$where['brand_id'] = (int) $params['brand_id'];
			$query['brand_id'] = $params['brand_id'];
		}
		
		if(! empty($params['category_id']))
		{
			// 找出自己以及自己子类id
			$childId = model('Category', 'logic') -> getChilId((int) $params['category_id']);
			
			// 再加上自己的id
			$childId[] = (int) $params['category_id'];
			$where['category_id'] = ['in', $childId];
			$query['category_id'] = $params['category_id'];
		}
		
		$data = $this -> where($where) -> order('id', 'desc') -> paginate(5, false, ['query' => $query]);
		return $data;
	}
	
	// 获取商品信息
	public function getInfo($goods_id = 0)
	{
		return $this -> get($goods_id);
	}
	
	// 添加保存数据
	public function edit($params)
	{
		// 组装数据
		$goodsData = [
			'goods_name' => ! empty($params['goods_name']) ? $params['goods_name'] : '',
			'category_id' => ! empty($params['category_id']) ? $params['category_id'] : 0,
			'brand_id' => ! empty($params['brand_id']) ? $params['brand_id'] : 0,
			'market_price' => ! empty($params['market_price']) ? $params['market_price'] : 0,
			'shop_price' => ! empty($params['shop_price']) ? $params['shop_price'] : 0,
			'image' => ! empty($params['image']) ? $params['image'] : '',
			'type_id' => ! empty($params['type_id']) ? $params['type_id'] : 0,
		];
		
		// 更新数据的时候，把主键组装进数组
		if(! empty($params['id']) && $params['id'] > 0)
		{
			$goodsData['id'] = $params['id'];
		}
		// 开启事务
		$this -> startTrans();
		
		$goodsResult = $this -> validate(true) -> isUpdate(! empty($goodsData['id']) ? true : false) -> save($goodsData);
		if($goodsResult === false)
		{
			$this -> rollback();
			return $this -> getError();
		}
		
		$status = false;
		
		if(empty($goodsResult) && empty($goodsData['id']))
		{
			$this -> rollback();
			return '保存失败';
		}
		
		if(! empty($goodsResult))
		{
			$status = true;
		}
		
		// 保存相册
		if(! empty($goodsData['id']))
		{
			// 如果是更新数据的时候，先把数据库中的相册全部删除
			$this -> imgs() -> delete();
		}
		
		if(! empty($params['photo']))
		{
			$imgs = [];
			foreach($params['photo'] as $key => $value)
			{
				$imgs[]['path'] = $value;
			}
			
			// 验证缺少
			$imgResult = $this -> imgs() -> saveAll($imgs);
			$status = true;
			
			if(empty($imgResult))
			{
				$this -> rollback();
				return '保存失败';
			}
		}
		
		// 保存套餐
		if(! empty($goodsData['id']))
		{
			// 如果是更新数据的时候，先把数据库中的套餐全部删除
			$this -> specs() -> delete();
		}
		
		if(! empty($params['spec_price']))
		{
			$spec = [];
			foreach($params['spec_price'] as $key => $value)
			{
				$spec[] = [
					'key' 		 => $key,
					'spec_price' => $value,
					'key_name' 	 => ! empty($params['key_name'][$key]) ? $params['key_name'][$key] : '',
				];
			}
			// 验证缺少
			$specResult = $this -> specs() -> saveAll($spec);
			$status = true;
			if(empty($specResult))
			{
				$this -> rollback();
				return '保存失败';
			}
		}
		
		// 保存属性
		if(! empty($goodsData['id']))
		{
			// 如果是更新数据的时候，先把数据库中的属性全部删除
			$this -> attrs() -> delete();
		}
		
		if(! empty($params['attr']))
		{
			$attr = [];
			foreach($params['attr'] as $key => $value)
			{
				$attr[] = ['attr_values' => $value, 'attr_id' => $key];
			}
			// 验证缺少
			$attrResult = $this -> attrs() -> saveAll($attr);
			$status = true;
			if(empty($attrResult))
			{
				$this -> rollback();
				return '保存失败';
			}
		}
		
		// 保存商品详情
		if(! empty($params['content']))
		{
			if(! empty($goodsData['id']))
			{
				// 验证缺少
				$attrResult = $this -> desc -> save(['content' => $params['content']]);
				$status = true;
			}else
			{
				$attrResult = $this -> desc() -> save(['content' => $params['content']]);
				$status = true;
			}
			
			if(empty($attrResult))
			{
				$this -> rollback();
				return '保存失败';
			}
		}
		
		if( ! empty($goodsData['id']) && $status === false)
		{
			$this -> rollback();
			return '保存失败';
		}
		
		$this -> commit();
		return true;		
	}
	
	// 获取规格组合 html 内容
	public function getSpecGroupHtml($item, $id)
	{
		if(empty($item))
		{
			return '';
		}
		
		// 把接收的规格数组处理 '规格id' => ['规格选项id']
		$specArray = [];
		foreach($item as $key => $value)
		{
			$temp = explode('_', $value);
			$specArray[$temp[0]][] = $temp[1];
		}
		
		// 通过递归处理套餐组合
		$itemGroup = $this -> handleSpecGroup($specArray);
		
		// 遍历套餐组合
		$specNameTd = '';
		$specItemTr = '';
		foreach($itemGroup as $key => $value)
		{
			// 查询规格选项的值
			$tempData = model('SpecItem') -> where('item_id', 'in', $value) -> order('spec_id') -> select();
			
			// 定义一个空的规格名称td变量
			$tempSpecItemTd = '';
			
			// 定义一个空的规格名称数组 用来存放规格名称
			$key_name = [];
			
			// 遍历规格选项数组
			foreach($tempData as $k => $val)
			{
				// 当 key == 0 的时候输出表格标题
				if($key == 0)
				{
					$specNameTd .= '<td><b>'. $val -> spec -> spec_name .'</b></td>';
				}
				// 得到规格选项名称的td内容
				$tempSpecItemTd .= '<td>'. $val -> item_name .'</td>';
				$key_name[] = $val -> item_name;
			}
			
			$key = implode('_', $value);
			$key_name = implode('_', $key_name);
			$spec_price = 0;
			// 当接收到商品 id 的时候，从数据库获取价格
			if(! empty($id))
			{
				$spec_price = model('GoodsSpec') -> where('goods_id', $id) -> where('key', $key) -> value('spec_price');
			}
			
			// 每一行套餐的 td
			$specItemTr .= <<<AKALI
				<tr>
					{$tempSpecItemTd}
					<td><input name="spec_price[{$key}]" type="text" class="form-control" value="{$spec_price}"></td>
					<input type="hidden" name="key_name[{$key}]" value="{$key_name}">
				</tr>
AKALI;
			
		}
		
		// 整个套餐 table 内容
		$itemTableHtml = <<<AKALI
			<table class="table table-bordered" id="spec_input_tab">
				<tbody>
					<tr>
						{$specNameTd}
						<td><b>价格</b></td>
					 </tr>
					{$specItemTr}
				</tbody>
			</table>
AKALI;
		
		
		return $itemTableHtml;
	}
	
	
/*
	// 数组选项组合递归方法的思想
	$arr = [
		[1, 2, 3],
		['a', 'b', 'c'],
		['e', 'f', 'g'],
	];
	
	foreach($arr[0] as $key => $value)
	{
		foreach($arr[1] as $ke => $val)
		{
			foreach($arr[2] as $k => $v)
			{
				$temp[] = $value . '_' . $val . '_' . $v;
			}
		}
	}
	
	dump($temp);
*/
	
	// 处理获取套餐组合
	public function handleSpecGroup($itemArray, $temp = [])
	{
		if(empty($itemArray))
		{
			return false;
		}
		
		static $data = [];
		
		// 先取出数组的第一项，并且删除第一项
		$fristArray = array_shift($itemArray);
		
		// 遍历得到一项数组
		foreach($fristArray as $key => $value)
		{
			$temp[] = $value;
			$this -> handleSpecGroup($itemArray, $temp);
			if(empty($itemArray))
			{
				$data[] = $temp;
			}
			array_pop($temp);
		}
		
		return $data;
	}
	
	public function getGoodsType()
	{
		return model('GoodsType') -> all(function($q){
			$q -> field('type_id, type_name');
		});
	}
	
	// 获取商品规格 html内容
	public function getSpecHtml($type_id)
	{
		$specs = model('Spec') -> where('type_id', $type_id) -> select();
		$html = '';
		if(! empty($specs))
		{
			$specHtml = '';
			foreach($specs as $key => $value)
			{
				$specHtml .= <<<AKALI
					<div class="form-group">
						<label for="title" class="col-sm-2 control-label">{$value -> spec_name}</label>
						<div class="col-sm-10">
						{$this -> getSpecItem($value)}
						</div>
					</div>
AKALI;
			}
			
			$html = <<<AKALI
				<div class="panel panel-default spec-table">
					<div class="panel-heading">商品规格</div>
					<div class="panel-body">
						{$specHtml}
					</div>
				</div>
AKALI;
		}
		
		return $html;
	}
	
	public function getSpecItem($specObj)
	{
		$btnHtml = '';
		foreach($specObj -> items as $key => $value)
		{
			$btnHtml .= '<button type="button" data-spec_id="'. $value -> spec_id .'" data-item_id="'. $value -> item_id .'" class="btn btn-default spec-item-btn" style="margin-right:10px;">'. $value -> item_name .'</button>';
		}
		
		return $btnHtml;
	}
	
	// 获取属性表单 html 内容
	public function getAttrHtml($type_id, $id = 0)
	{
		$attrs = model('Attribute') -> where('type_id', $type_id) -> select();
		
		$html = '';
		if(! empty($attrs))
		{
			$inputHtml = '';
			
			foreach($attrs as $key => $value)
			{
			
				$inputHtml .= $this -> getInputHtml($value, $id);
			}
			
			$html .= <<<AKALI
				<div class="panel panel-default">
					<div class="panel-heading">商品属性</div>
					<div class="panel-body">
						{$inputHtml}
					</div>
				</div>
AKALI;
		}
		
		return $html;
	}
	
	// 根据输入类型 生成表单
	protected function getInputHtml($data = [], $id = 0)
	{
		$attr_value = '';
		if(! empty($id))
		{
			$attr_value = model('GoodsAttr') -> where('attr_id', $data -> attr_id) -> where('goods_id', $id) -> value('attr_values');
		}
		
		switch($data -> getData('attr_input_type'))
		{
			case 1:
				$item = explode("\r\n", $data -> attr_values);
				$itemHtml = '';
				
				foreach($item as $key => $value)
				{
					$itemHtml .= '<option '. ($attr_value == $value ? 'selected' : '') .'>'. $value .'</option>';
				}
				
				$inputHtml = <<<AKALI
					<select class="form-control" name="attr[{$data -> attr_id}]" >
						<option value="0">请选择{$data -> attr_name}</option>
							{$itemHtml}
					</select>
AKALI;
				break;
			case 2:
				$inputHtml = '<textarea class="form-control" name="attr['.$data -> attr_id.']">'. $attr_value .'</textarea>';
				break;
			case 0:
			default:
				$inputHtml = '<input type="text" class="form-control" name="attr['.$data -> attr_id.']" value="'. $attr_value .'">';
				break;
		}
		$html = <<<AKALI
			<div class="form-group">
				<label for="title" class="col-sm-2 control-label">{$data -> attr_name}</label>
				<div class="col-sm-10">
					{$inputHtml}
				</div>
			</div>
AKALI;
	
		return $html;
	
	}
	
}

























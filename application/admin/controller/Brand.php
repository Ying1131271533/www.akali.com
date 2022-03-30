<?php
namespace app\admin\controller;


// 分批框架里面 ArticleCate 等于 Article_cate
class Brand extends Base
{
	protected $brandModel;
	
	public function _initialize()
	{
		parent::_initialize();
		
		// 实例化brand数据模型 因为多个地方都需要用到	
		$this -> brandModel = model('Brand');
	}
	
	// 品牌管理
	public function index()
    {
		// 获取品牌
		$brandList = $this -> brandModel -> order('id', 'desc') -> paginate(10);
		
		// 分配到视图
		$this -> assign('brandList', $brandList);
		
		return $this -> fetch();
    }
	
	// 品牌添加
	public function add()
	{
		if(request() -> isPost())
		{
			// 组装数据
			$data = [
				'brand_name' => input('brand_name/s'),
				'logo' 		 => input('logo/s'),
			];
			
			// 验证数据
			$result = $this -> brandModel -> validate(true) -> save($data);
			if($result === false)
			{
				// 验证失败 输出错误信息
				return $this -> error($this -> brandModel -> getError());
			}
			
			// 数据保存失败
			if(empty($result))
			{
				return $this -> error('保存失败');
			}
			
			return $this -> success('保存成功', url('admin/brand/index'));
		}
		
		return $this -> fetch();
		
/*		
		$brandModel = new BrandModel;
		
		// 保存
		//$brandModel -> save(['brand_name' => '诺基亚']);
		
		// 更新 要加入主键
		$brandModel -> isUpdate(true) -> save(['brand_name' => '小米Max', 'id' => 1]);
		
		$brandData = $brandModel -> get(['brand_name' => '小米']);
		
		$brandData = $brandModel -> where('id', 1) -> select(); 
		
		foreach($brandData as $key => $value)
		{
			//echo $value -> brand_name;
			//dump($value -> toArray());
			//dump($value -> toJson());
			dump($value -> getData());
		}
		
		// db() -> insert(['band_name' => '小米']);
		
		//$bandModel -> insert(['brand_name' => '苹果', 'logo' => '']);
*/		
		
	}

	// 品牌修改
	public function edit()
	{
		if(! input('?id'))
		{
			return $this -> error('参数错误');
		}
		
		$id = input('id/d');
		
		// 获取品牌信息
		$brandData = $this -> brandModel -> get($id);
		if(empty($brandData))
		{
			return $this -> error('该品牌不存在');
		}
		
		if(request() -> isPost())
		{
			// 组装数据
			$data = [
				'brand_name' => input('brand_name/s'),
				'logo' 		 => input('logo/s'),
				'id' 		 => $id,
			];
			
			// 验证数据
			$result = $this -> brandModel -> validate(true) -> isUpdate(true) -> save($data);
			if($result === false)
			{
				// 验证失败 输出错误信息
				return $this -> error($brandModel -> getError());
			}
			
			// 数据保存失败
			if(empty($result))
			{
				return $this -> error('修改失败');
			}
			
			// 当有新图片上传的时候 删除原来Logo图片
			if(! empty($brandData -> logo) && $brandData -> logo != $data['logo'] && file_exists($brandData -> logo))
			{
				unlink($brandData -> logo);
			}
			
			return $this -> success('修改成功', url('admin/brand/index'));
			
		}
		
		$this -> assign('brandData', $brandData);
		
		// 加载视图
		return $this -> fetch();
	}
	
	// 品牌删除
	public function del()
	{
		if(! input('?id'))
		{
			return $this -> error('参数错误');
		}
		
		$id = input('id/d');
		
		$brandData = $this -> brandModel -> get($id);
		
		if(empty($brandData))
		{
			return $this -> error('该品牌不存在');
		}
		
		// 找该品牌下面的产品是否存在
		// 能不找多条数据 就不找多条
		$goodsData = model('Goods') -> get(['brand_id' => $id]);
		
		if(! empty($goodsData))
		{
			return $this -> error('请删除该品牌的所有商品后，再执行该操作');
		}
		
		// 删除品牌
		$row = $brandData -> delete($id);
		
		if(empty($row))
		{
			return $this -> error('删除失败');
		}
		
		if(! empty($brandData -> logo) && file_exists($brandData -> logo))
		{
			unlink($brandData -> logo);
		}
		
		return $this -> success('删除成功', url('admin/brand/index'));
		
	}
	
}


















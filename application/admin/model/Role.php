<?php
namespace app\admin\model;

use think\Model;

class Role extends Model
{
	// 创建这个属性 就可以用 toArray 这个方法
	protected $resultSetType = 'collection';
	public function nodes()
	{
		//								关联的表   中间表	 关联表主键 当前表主键
		// return $this -> belongsToMany('Node', 'role_node', 'node_id', 'role_id');
		return $this -> belongsToMany('Node');
	}
}


















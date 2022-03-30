<?php
namespace app\admin\controller;

class Rbac extends Base
{
	protected $adminModel;
	protected $adminLogic;
	protected $roleModel;
	protected $roleLogic;
	protected $nodeModel;
	protected $nodeLogic;
	
	public function _initialize()
	{
		parent::_initialize();
		$this -> adminModel = model('Admin');
		$this -> adminLogic = model('Admin', 'logic');
		$this -> roleModel 	= model('Role');
		$this -> roleLogic 	= model('Role', 'logic');
		$this -> nodeModel 	= model('Node');
		$this -> nodeLogic 	= model('Node', 'logic');
	}
	
	// 管理员列表
	public function index()
	{
		$admin = $this -> adminModel -> all();
		
		$this -> assign('admin', $admin);
		return $this -> fetch();
	}
	
	// 管理员状态
	public function admin_status()
	{
		$id = input('id/d');
		$status = input('status/d');
		$result = $this -> adminModel -> where(['id' => $id]) -> update(['status' => $status]);
		if(empty($result))
		{
			return $this -> error($this -> adminModel -> getError());
		}
		return $this -> success('修改成功');
	}
	
	// 管理员添加
	public function admin_add()
	{
		if(request() -> isPost())
		{
			$param = input();
			$data = [
				'username'	=> $param['username'],
				'password'	=> $param['password'],
				'password2' => $param['password2'],
			];
			
			// dump($data);return;
		/* 	
			$valiResult = $this -> validate($data, 'Rbac');
			if($valiResult !== true)
			{
				// return ['code' => 0, 'msg' => $valiResult];
				return $this -> error($valiResult, url('admin_add'));
			}
		 */	
		 
		 
			// 如果提示 admin_id 不存在的话  那么刷新整个页面 不要只刷新提交过来的那个页面
			
			
			// 开启事务
			$this -> roleModel -> startTrans();
			$result = $this -> adminModel -> validate(true) -> allowField(true) -> save($data);
			if($result === false)
			{	
				// 回滚事务
				$this -> roleModel -> rollback();
				return $this -> error($this -> adminModel -> getError());
			}
			
			if(! empty($param['role']))
			{
				$adminRole = $this -> adminModel -> roles() -> saveAll(array_filter($param['role']));
				if(empty($adminRole))
				{
					// 回滚事务
					$this -> roleModel -> rollback();
					return $this -> error($this -> adminModel -> getError());
				}
			}
			
			$this -> roleModel -> commit();
			return $this -> success('管理员添加成功', url('index'));
		}
		
		$role = $this -> roleModel -> all();
		$this -> assign('role', $role);
		
		return $this -> fetch();
	}
	
	// 管理员修改
	public function admin_edit()
	{
		$id = input('id/d');
		if(empty($id))
		{
			return $this -> error('缺少参数');
		}
		
		if(request() -> isPost())
		{
			$id = input('id/d');
			$admin = $this -> adminModel -> get($id);
			if(empty($admin))
			{
				return $this -> error('该用户不存在');
			}
			
			$param = input();
			$data = [
				'id'		=> $id,
				'username'	=>input('username/s'),
			];
			
			$valiName = 'AdminPass';
			if(! empty(input('password/s')) || ! empty(input('password2/s')))
			{
				$data['password'] = $param['password'];
				$data['password2'] = $param['password2'];
				$valiName = 'Admin';
			}
			
			// dump($data);return;
		/* 	
			$valiResult = $this -> validate($data, 'Rbac');
			if($valiResult !== true)
			{
				// return ['code' => 0, 'msg' => $valiResult];
				return $this -> error($valiResult, url('admin_add'));
			}
		 */	
			// 开启事务
			$this -> roleModel -> startTrans();
			$result = $this -> adminModel -> validate($valiName) -> allowField(true) -> isUpdate(true) -> save($data);
			if($result === false)
			{
				$this -> adminModel -> rollback();
				return $this -> error($this -> adminModel -> getError());
			}
			
			$adminRole = $admin -> roles;
			if(! empty($adminRole -> toArray()))
			{
				db('admin_role') -> where(['admin_id' => $id]) -> delete();
			}
			
			if(! empty($param['role']))
			{
				$adminRole = $admin -> roles() -> saveAll(array_filter($param['role']));
				if(empty($adminRole))
				{
					// 回滚事务
					$this -> roleModel -> rollback();
					return $this -> error($this -> adminModel -> getError());
				}
			}
			
			$this -> roleModel -> commit();
			return $this -> success('管理员修改成功', url('index'));
		}
		
		$admin = $this -> adminModel -> get($id);
		$this -> assign('admin', $admin);
		$this -> assign('adminRole', $admin -> roles);
		$role = $this -> roleModel -> all();
		$this -> assign('role', $role);
		
		return $this -> fetch();
	}
	
	// 管理员删除
	public function admin_del()
	{
		$id = input('id/d');
		if(empty($id))
		{
			return $this -> error('缺少参数');
		}
		
		$admin = $this -> adminModel -> get($id);
		if(empty($admin))
		{
			return $this -> error('用户名不存在');
		}
		
		$temp = [];
		foreach($admin -> roles as $value)
		{
			$temp[] = $value -> id;
		}
		
		try
		{
			if(! empty($temp))
			{
				$admin -> roles() -> detach($temp);
			}
			$admin -> delete();
			return $this -> success('删除成功');
		}catch(Exception $e)
		{
			throw new Exception('删除出错');
		}
		
	}
	
	// 角色列表
	public function role()
	{
		$role = $this -> roleModel -> all();
		$this -> assign('role', $role);
		
		return $this -> fetch();
	}
	
	// 角色添加
	public function role_add()
	{
		if(request() -> isPost())
		{
			$data = [
				'name' => input('name/s'),
				'explain' => input('explain/s'),
			];
			// 开启事务
			$this -> roleModel -> startTrans();
			$result = $this -> roleModel -> validate(true) -> allowField(true) -> save($data);
			if(empty($result))
			{
				// 回滚事务
				$this -> roleModel -> rollback();
				return $this -> error($this -> roleModel -> getError());
			}
			
			$param = input();
			$node = $param['node'];
			if(!empty($node))
			{
				$nodeResult = $this -> roleModel -> nodes() -> saveAll($node);
				if(empty($nodeResult))
				{
					// 回滚事务
					$this -> roleModel -> rollback();
					return $this -> error($this -> roleModel -> getError());
				}
			}
			// 提交事务
			$this -> roleModel -> commit();
			return $this -> success('角色添加成功');
		}
		
		$node = $this -> nodeModel -> all();
		$node = get_child($node);
		$this -> assign('node', $node);
		
		return $this -> fetch();
	}
	
	// 角色修改
	public function role_edit()
	{
		$id = input('id/d');
		if(empty($id))
		{
			return $this -> error('缺少参数', url('role'));
		}
		
		if(request() -> isPost())
		{
			$data = [
				'id' => input('id/d'),
				'name' => input('name/s'),
				'explain' => input('explain/s'),
			];
			// 开启事务
			$this -> roleModel -> startTrans();
			$result = $this -> roleModel -> validate(true) -> isUpdate(true) -> save($data);
			if($result === false)
			{
				// 回滚事务
				$this -> roleModel -> rollback();
				return $this -> error($this -> roleModel -> getError());
			}
			
			// 删除原本的权限
			$temp = [];
			foreach($this -> roleModel -> nodes as $value)
			{
				$temp[] = $value['id'];
			}
			
			if(! empty($temp))
			{
				$this -> roleModel -> nodes() -> detach($temp);
			}
			
			$param = input();
			if(! empty($param['node']))
			{
				$result = $this -> roleModel -> nodes() -> saveAll($param['node']);
				if(empty($result))
				{
					// 回滚事务
					$this -> roleModel -> rollback();
					return $this -> error($this -> roleModel -> getError());
				}
			}
			
			$this -> roleModel -> commit();
			return $this -> success('角色修改成功', url('role'));
		}
		
		$role = $this -> roleModel -> get($id);
		$this -> assign('role', $role);
		
		$role_node = $role -> nodes -> toArray();
		// 取出所拥有的节点id
		$access  = [];
		foreach($role_node as $value)
		{
			$access[] = $value['id'];
		}
		$this -> assign('access', $access);
		
		$node = $this -> nodeModel -> all();
		$node = get_child($node);
		$this -> assign('node', $node);
		
		return $this -> fetch();
	}
	
	// 角色删除
	public function role_del($id)
	{
		if(empty($id) || ! is_numeric($id))
		{
			return $this -> error('缺少参数');
		}
		
		$role = $this -> roleModel -> get($id);
		if(empty($role))
		{
			return $this -> error('角色不存在');
		}
		
		db('role_node') -> where('role_id', $id) -> delete();
		$result = $role -> delete();
		if(empty($result))
		{
			return $this -> error('删除失败');
		}
		
		return $this -> success('角色已删除');
	}
	
	// 节点列表
	public function node()
	{
		$node = $this -> nodeModel -> order('local') -> select();
		$node = get_child($node);
		$this -> assign('node', $node);
		
		return $this -> fetch();
	}
	
	// 节点添加
	public function node_add()
	{
		if(request() -> isPost())
		{
			$data = [
				'name' => input('name/s'),
				'title' => input('title/s'),
				'level' => input('level/d'),
				'pid' => input('pid/d'),
				'show' => input('show/d'),
				'local' => input('local/d'),
			];
			
			$result = $this -> nodeModel -> validate(true) -> allowField(true) -> save($data);
			if(empty($result))
			{
				return $this -> error($this -> nodeModel -> getError());
			}
			
			return $this -> success('添加成功', url('node'));
		}
		
		return $this -> fetch();
	}
	
	// 节点修改
	public function node_edit()
	{
		$id = input('id');
		if(empty($id))
		{
			return $this -> error('缺少参数', url('node'));
		}
		
		if(request() -> isPost())
		{
			$data = [
				'id' => $id,
				'name' => input('name/s'),
				'title' => input('title/s'),
				'level' => input('level/d'),
				'pid' => input('pid/d'),
				'show' => input('show/d'),
				'local' => input('local/d'),
			];
			
			$result = $this -> nodeModel -> validate(true) -> isUpdate(true) -> save($data);
			if(empty($result))
			{
				return $this -> error($this -> nodeModel -> getError());
			}
			
			return $this -> success('修改成功', url('node'));
		}
		
		$data = $this -> nodeModel -> get($id);
		$this -> assign('data', $data);
		return $this -> fetch();
	}
	
	// 节点删除
	public function node_del()
	{
		$id = input('id');
		if(empty($id))
		{
			return $this -> error('缺少参数', url('node'));
		}
		
		$node = $this -> nodeModel -> get($id);
		if(empty($node))
		{
			return $this -> error('找不到该节点', url('node'));
		}
		
		if($node -> pid == 0)
		{
			$child = $node -> where(['pid' => $id]) -> find();
			if(!empty($child))
			{
				return $this -> error('先删除子节点');
			}
		}
		
		$result = $node -> delete();
		if(empty($result))
		{
			return $this -> error('删除失败');
		}
		
		return $this -> success('删除成功');
	}
}


















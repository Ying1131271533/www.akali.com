<?php
namespace app\admin\controller;

use think\Controller;

class Auth extends Controller
{
	// 配置权限类属性
	private $_config = [
		// 权限管理开关
		'no' => true,
		// 权限管理控制类型 1：即时控制 2：登录控制
		'type' => 1,
		// 数据表名字
		'table' => [
			'admin' => 'admin',
			'admin_role' => 'admin_role',
			'role' => 'role',
			'role_node' => 'role_node',
			'node' => 'node',
		],
		// 例外 不需要权限
		'exception' => [],
		// 超级管理员
		'super' => [],
		// 只显示权限的页面
		'show' => true,
	];
	
	public function _initialize()
	{
		parent::_initialize();
		
		// 读取权限配置
		$config = config('rbac');
		if(! empty($config))
		{
			// 合并数组 相同的 后面替换前面
			$this -> _config = array_merge($this -> _config, $config);
		}
		
	}
	
	// 检查用户是否有访问该节点的权限
	public function check($id = '', $controller = '', $action = '')
	{
		// 是否开启权限控制
		if($this -> _config['no'] === false)
		{
			return true;
		}
		
		$controller = ! empty($controller) ? $controller : request() -> controller();
		$action = ! empty($action) ? $action : request() -> action();
		
		// 控制器的名字 转换小写 以免出错 Goods = goods
		$controller = strtolower($controller);
		$action = strtolower($action);
		
		// 找出session用户id
		if(empty($id))
		{
			$session = session('admin');
			$id = $session['id'];
		}
		
		if(in_array($session['username'], $this -> _config['super']))
		{
			return true;
		}
		
		// 例外
		if(isset($this -> _config['exception'][$controller]))
		{
			if(is_string($this -> _config['exception'][$controller]) && $this -> _config['exception'][$controller] === 'all')
			{
				return true;
			}else if(in_array($action, $this -> _config['exception'][$controller]))
			{
				return true;
			}
		}
		
		// 通过id找到管理员的信息
		$admin = $this -> getAdmin($id);
		if(empty($admin))
		{
			return false;
		}
		
		if($admin['status'] == 2)
		{
			return 2;
		}
		
		
		if($this -> _config['type'] == 1)
		{
			// 获取权限数组
			$access = $this -> getAccess($id);
		}else
		{
			$access = $session['access'];
		}
		
		
		if(empty($access))
		{
			return false;
		}
		
		// 判断是否拥有访问该节点的权限
		if(! isset($access[$controller]))
		{
			return false;
		}
		
		if(! in_array($action, $access[$controller]))
		{
			return false;
		}
		
		return true;
	}
	
	// 找出所拥有的节点信息
	public function getAccess($id)
	{
		// 通过管理员 找到管理员-角色信息
		$adminRole = $this -> getAdminRole($id);
		if(empty($adminRole))
		{
			return false;
		}
		
		// 通角色 找到角色-节点信息
		$roleNode = $this -> getRoleNode($adminRole);
		if(empty($roleNode))
		{
			return false;
		}
		
		// 找出所拥有的节点信息 不用判断 因为必须有数据的 要不然上面都跳出了
		$node = $this -> getNode($roleNode);
		return $node;
	}
	
	// 找出所拥有的节点信息
	public function getShowNode($id)
	{
		$admin = $this -> getAdmin($id);
		if($this -> _config['no'] === false || in_array($admin['username'], $this -> _config['super']))
		{
			$showNode = $this -> getNodeAll();
			
		}else
		{
			$adminRole = $this -> getAdminRole($id);
			$roleNode = $this -> getRoleNode($adminRole);
			$showNode = db($this -> _config['table']['node']) -> where('id', 'in', $roleNode) -> where('show', 1) -> order('local') -> select();
			if(! empty($this -> _config['exception']))
			{
				$exceptionNode = $this -> exceptionNode($this -> _config['exception']);
				
				$exceptionNode = array_values($exceptionNode);
				$showNode = array_values($showNode);
				$showNode = array_merge($exceptionNode, $showNode);
				
				// dump($showNode);return;
			}
		}
		
		$showNode = array_unique($showNode, SORT_REGULAR);
		
		$showNode = get_child($showNode);
		return $showNode;
	}
	
	// 获取所有节点
	public function getNodeAll()
	{
		$showNode = db($this -> _config['table']['node']) -> where('show', 1) -> order('local') -> select();
		return get_child($showNode);
	}
	
	// 获取例外节点
	protected function exceptionNode($data)
	{
		$temp = [];
		foreach($data as $key => $value)
		{
			if(is_string($value) && $value === 'all')
			{
				$allNmae = db($this -> _config['table']['node']) -> where(['name' => $key, 'pid' => 0]) -> where('show', 1) -> order('local') -> select();
				if(! empty($allNmae))
				{
					$action = db($this -> _config['table']['node']) -> where(['pid' => $allNmae[0]['id']]) -> where('show', 1) -> order('local') -> select();
					$temp = $temp + $allNmae + $action;
					
					$temp = array_values($temp);
					$allNmae = array_values($allNmae);
					$action = array_values($action);
					$temp = array_merge($action, $allNmae, $temp);
				}
			}
			
			if(is_array($value) && ! empty($value))
			{
				$allNmae = db($this -> _config['table']['node']) -> where(['name' => $key, 'pid' => 0]) -> where('show', 1) -> order('local') -> select();
				$action = db($this -> _config['table']['node']) -> where('name', 'in', $value) -> where('show', 1) -> order('local') -> select();
				
				$temp = array_values($temp);
				$allNmae = array_values($allNmae);
				$action = array_values($action);
				$temp = array_merge($action, $allNmae, $temp);
			}
		}
		// dump($temp);return;
		return $temp;
	}
	
	// 找出所拥有的节点
	public function getNode($roleNode)
	{
		$data = db($this -> _config['table']['node']) -> where('id', 'in', $roleNode) -> select();
		$temp = [];
		foreach($data as $key => $value)
		{
			// 找出父节点
			// $parent = $this -> getNodeInfoAkali($value['pid']);
			$parent = $this -> getNodeInfoAkali($value['pid'], $data);
			if(! empty($parent))
			{
				$temp[strtolower($parent['name'])][] = strtolower($value['name']);
			}
		}
		return $temp;
	}
	
	// 找出父节点 - 阿卡丽
	protected function getNodeInfoAkali($id, $data)
	{
		foreach($data as $key => $value)
		{
			if($value['id'] == $id)
			{
				return $value;	
			}
		}
	}
	
	// 找出父节点
	protected function getNodeInfo($id)
	{
		static $node = null;
		if(! isset($node[$id]))
		{
			$node[$id] = db($this -> _config['table']['node']) -> find($id);
		}
		return $node[$id];
	}
	
	// 找出角色的节点信息
	protected function getRoleNode($roleNode)
	{
		$data = db($this -> _config['table']['role_node']) -> where('role_id', 'in', $roleNode) -> column('node_id');
		 return array_unique($data);
	}
	
	// 找出管理员的角色信息
	protected function getAdminRole($adminRole)
	{
		$data = db($this -> _config['table']['admin_role']) -> where('admin_id', $adminRole) -> column('role_id');
		return $data;
	}
	
	// 找出管理员信息
	protected function getAdmin($id)
	{
		$data = db($this -> _config['table']['admin']) -> field('id,username,status') -> find($id);
		return $data;
	}
}













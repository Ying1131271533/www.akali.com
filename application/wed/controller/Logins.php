<?php
namespace app\wed\controller;

class Logins extends Base
{
   // 登录
   public function index()
    {		
		if(! empty(cookie('auto')))
		{
			$auto = cookie('auto');
			$user = db('user') -> where('username', $auto['username']) -> find();
			
			if(empty($user))
			{
				return $this -> error('该用户不存在, 请重新登录');
			}
			
			// 保存登录状态
			session('user', [
				'user_id' 	=> $auto['user_id'],
				'username' 	=> $auto['username'],
			]);
			
			// return $this -> redirect(url('wed/user/index'));
			return $this -> error('请先退出登录');
		}
		
		if(request() -> isAjax())
		{
			$data = [
				'username'	=> input('username/s'),
				'password' 	=> input('password/s'),
				'auto'		=> input('auto'),
			];
			
			// 验证数据
			$valiResult = $this -> validate($data, 'Logins');
			if($valiResult !== true)
			{
				return ['code' => 0, 'msg' => $valiResult];
			}
			
			// 找出该用户
			$userData = db('user') -> where('username', $data['username']) -> find();
			if(empty($userData))
			{
				return ['code' => 0, 'msg' => '该用户不存在'];
			}
			
			// 比对密码
			if(md5($data['password']) !== $userData['password'])
			{
				return ['code' => 0, 'msg' => '密码错误'];
			}
			
			// 保存登录状态
			session('user', [
				'user_id' 	=> $userData['id'],
				'username' 	=> $userData['username'],
			]);
			
			// 自动登录
			if($data['auto'] === '1')
			{
				cookie('auto', [
					'user_id' 	=> $userData['id'],
					'username' 	=> $userData['username'],
				], 36000*24*30);
			}
			
			return ['code' => 1];
		}
		
		return $this -> fetch();
    }
	
	// 注册
    public function reg()
    {
		if(request() -> isPost())
		{
			$data = [
				'username' 	=> input('username/s'),
				'password' 	=> input('password/s'),
				'password2' => input('password2/s'),
				'sex' 		=> input('sex/d'),
				'phone' 	=> input('phone/d'),
				'qq' 		=> input('qq/d'),
				'email' 	=> input('email/s'),
				'image' 	=> input('image/s'),
			];
			
			// 验证验证码是否正确
			if(!captcha_check(input('vcode')))
			{
				//验证失败
				return $this -> error('验证码错误');
			};
			
			$valiResult = $this -> validate($data, [
				'username|用户名'	=> 'require|unique:user',
				'password|密码' 		=> 'require|confirm:password2',
				'sex|性别' 			=> 'require',
				'phone|手机号' 		=> 'require|regex:^1[3456789][0126789]\d{8}$',
				'sex|性别' 			=> 'require|number',
				'qq|性别' 			=> 'require|number',
				'email|邮箱' 		=> 'require',
			]);
			
			if($valiResult !== true)
			{
				return $this -> error($valiResult);
			}
			
			// 删除 passdword2
			unset($data['password2']);
			
			
			$user_id = model('user') -> insertGetId($data);
			if(empty($user_id))
			{
				return $this -> error('注册失败');
			}
			
			// 保存登录状态
			session('user', [
				'user_id' => $user_id,
				'username' => $data['username'],
			]);
			
			return $this -> success('注册成功', url('wed/user/index'));
			
		}
		
		return $this -> fetch();
    }
	
	public function logout()
	{
		// 清除session
		session('user', null);
		
		// 清除cookie
		cookie('auto', null);
		
		return $this -> success('退出成功', url('wed/logins/index'));
		
	}
	
	// 是否已登录
	public function isLogin()
	{
		if(session("?user"))
		{
			return 1;
		}
		
		return 0;
	}
	
	
}


















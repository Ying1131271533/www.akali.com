<?php
	header("content-type:text/html;charset=utf-8");
	
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']))
	{
		$action = isset($_POST['action']) ? $_POST['action'] : '';
		switch($action)
		{
			case 'phone' : //检查电话
				
				if(empty($_POST['phone']))
				{
					die(json_encode(['error' => true, 'msg' => '电话不能为空']));
				}
				
				if(strlen($_POST['phone']) < 5)
				{
					die(json_encode(['error' => true, 'msg' => '电话不能少于五位数']));
				}
				
				$phone = $_POST['phone'];
				
				$phoneText ='/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/';
				$phoneText2 = "/^0\d{2,3}(\-)?\d{7,8}$/";
				
				if(! preg_match($phoneText, $phone) && ! preg_match($phoneText2, $phone))
				{
					die(json_encode(['error' => true, 'msg' => '电话格式不正确']));
				}
				
				die(json_encode(['error' => false]));
				
				break;
				
				case 'email' : //检查邮箱
				
				if(empty($_POST['email']))
				{
					die(json_encode(['error' => true, 'msg' => '邮箱不能为空']));
				}
				
				$email = $_POST['email'];
				
				$pattern = "/^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,3}$/";
				
				if(! preg_match($pattern, $email))
				{
					die(json_encode(['error' => true, 'msg' => '邮箱格式不正确']));
				}
				
				die(json_encode(['error' => false]));
				
				break;
				
				case 'content' : //检查留言
				
				if(empty($_POST['content']))
				{
					die(json_encode(['error' => true, 'msg' => '留言不能为空']));
				}
				
				die(json_encode(['error' => false]));
				
				break;
				
			case 'vcode' : //验证码
			
				if(empty($_POST['vcode']))
				{
					die(json_encode(['error' => true, 'msg' => '验证码不能为空']));
				}
				
				$vcode = $_POST['vcode'];
				
				if(strtolower($vcode) != strtolower($_SESSION['vcodes']))
				{
					die(json_encode(['error' => true, 'msg' => '验证码不正确']));
				}
				
				die(json_encode(['error' => false]));
				
				break;
			default : //登录
				logins();
				break;
		}
	}
	
	function logins()
	{
		if(empty($_POST['phone']))
		{
			die(json_encode(['error' => true, 'msg' => '电话不能为空']));
		}
		
		if(strlen($_POST['phone']) < 5)
		{
			die(json_encode(['error' => true, 'msg' => '电话不能少于五位数']));
		}
		
		$phone = $_POST['phone'];
		
		$phoneText ='/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/';
		$phoneText2 = "/^0\d{2,3}(\-)?\d{7,8}$/";
		
		if(! preg_match($phoneText, $phone) && ! preg_match($phoneText2, $phone))
		{
			die(json_encode(['error' => true, 'msg' => '电话格式不正确']));
		}
		
		if(empty($_POST['email']))
		{
			die(json_encode(['error' => true, 'msg' => '邮箱不能为空']));
		}
		
		$email = $_POST['email'];
		
		$pattern = "/^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,3}$/";
		
		if(! preg_match($pattern, $email))
		{
			die(json_encode(['error' => true, 'msg' => '邮箱格式不正确']));
		}
		
		if(empty($_POST['content']))
		{
			die(json_encode(['error' => true, 'msg' => '留言不能为空']));
		}
		
		if(empty($_POST['vcode']))
		{
			die(json_encode(['error' => true, 'msg' => '验证码不能为空']));
		}
		
		if(strtolower($_POST['vcode']) != strtolower($_SESSION['vcodes']))
		{
			die(json_encode(['error' => true, 'msg' => '验证码不正确']));
		}
		
		
		
		//组装数据
		$data = array(
			'phone' 		=> isset($_POST['phone']) ? $_POST['phone'] : '',
			'email' 		=> isset($_POST['email']) ? $_POST['email'] : '',
			'content' 		=> isset($_POST['content']) ? $_POST['content'] : '',
			'create_time' 	=> date('Y-m-d H:i:s'),
		);
		
		//插入数据
		$result = insert('guestbook', $data);
		
		if(empty($result))
		{
			die(json_encode(['error' => true, 'msg' => '提交失败']));
		}
		
		die(json_encode(['error' => false, 'msg' => '提交成功']));
	}
	
	$rec_goods = select('goods', 'is_rec=1', "*", null, 0, 3);
	
	$rec_about = find('about_us', 'is_rec=1');
	
	$rec_news = find('article', 'is_rec=1');
	// 把字符串时间转换成时间戳
	$rec_news_time = strtotime($rec_news['create_time']);
	
	$news = select('article', 'is_rec != 1', "*", null, 0, 3);
	foreach($news as $key => $value)
	{
		// 把字符串时间转换成时间戳
		$news[$key]['create_time'] = strtotime($value['create_time']);
	}
	
	$companyMessage = find('company_message');
	
	$bannerHtml = bannerHtml();
	
	$data = [
		'rec_goods' 		=> $rec_goods,
		'rec_about' 		=> $rec_about,
		'rec_news' 			=> $rec_news,
		'rec_news_time' 	=> $rec_news_time,
		'news' 				=> $news,
		'companyMessage'	 => $companyMessage,
		'bannerHtml' 		=> $bannerHtml,
	];
	
	view($data);
	
?>




















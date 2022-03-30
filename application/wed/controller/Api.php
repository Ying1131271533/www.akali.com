<?php
namespace app\wed\controller;

use think\Db;

class Api extends Base
{
	// 上传图片
	public function upload()
	{
		if(Request() -> isPost())
		{
			// 获取表单上传文件 例如上传了001.jpg
			$file = request() -> file('image');
			// 移动到框架应用根目录/public/uploads/ 目录下 419430
			$info = $file -> validate(['size' => 419430, 'ext' => 'jpg,png,gif,jpeg']) -> move(ROOT_PATH . 'public' . DS . 'uploads');
			
			if($info)
			{
				$path = 'uploads/' . date('Ymd') . '/' . $info -> getFilename();
				// 为什么不用这种呢 $path = 'uploads/' . $info -> getSaveName();
				return json(['status' => 1, 'path' => $path]);
	/*			// 成功上传后 获取上传信息
				// 输出 jpg
				echo $info->getExtension();
				// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
				echo $info->getSaveName();
				// 输出 42a79759f284b767dfcb2a0197904287.jpg
				echo $info->getFilename();
	*/			
			}else
			{
			/*	
				// 验证图片
				$info = $file -> validate(['size' => 419430, 'ext' => 'jpg,png,gif,jpeg']) -> move(ROOT_PATH . 'public' . DS . 'uploads');
				
				if($info === false)
				{
					// 验证失败 输出错误信息
					dump($info -> getError);
				}
			*/	
				return json(['status' => 0, 'msg' => '上传失败']);
			}
		}
		
		return $this -> fetch();
	}
	
	public function del($src)
	{
		foreach($src as $key => $value)
		{
			// 删除文章图片文件
			if(! empty($value) && file_exists($value))
			{
				unlink($value);
			}
		}
		
		return;
	}
	
}



















<?php
namespace app\weixin\controller;

class Index extends \think\Controller
{
    public function index()
    {
		$wx = new \weixin\WinXinApi;
		
		// 验证数据
		// 收发信息
		$wx -> valid() -> responseMsg();
    }
	
}


















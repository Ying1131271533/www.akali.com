<?php
namespace app\admin\controller;

class Home extends Base
{
	public function _initialize()
	{
		parent::_initialize();
	}
	
	public function index()
    {
		$config = config('rbac');
		if($config['show'] === true)
		{
			$Auth = new Auth;
			session('showNode', null);
			$showNode = session('showNode');
			if(empty($showNode))
			{
				if(in_array('金克丝', $config['super']) || in_array('akali', $config['super']))
				{
					$showNode = $Auth -> getNodeAll();
				}else
				{
					$id = session('admin')['id'];
					$showNode = $Auth -> getShowNode($id);
				}
			}
			
			session('showNode', $showNode);
			$this -> assign('showNode', $showNode);
			return $this -> fetch('index_auth');
		}
		
		return $this -> fetch('index');
    }
	
	public function age()
	{
		echo '金克丝';
	}
	
	public function welcome()
    {
		return $this -> fetch();
    }
	
	public function akali()
	{
		// 列表页链接
		// $url = 'http://www.verydm.com/manhua/sangnv';
		// $urlList = 'http://www.ess32.com/ssmh/list_53_5.html';
		// $urlList = 'http://www.ess32.com/ssmh/list_53_4.html';
		// $urlList = 'http://www.ess32.com/ssmh/list_53_3.html';
		// $urlList = 'http://www.ess32.com/ssmh/list_53_2.html';
		// $urlList = 'http://www.ess32.com/ssmh/list_53_1.html';
		
		
		// 单集链接
		$url = 'http://www.hhimm.com/cool274155/1.html?s=8&d=0';
		// $url = 'https://manhua.dmzj.com/smzxtrinityblood/61330.shtml#@page=1';
		
		// dump(cookie('bu'));
		// dump(cookie('ye'));
		// return;
		// 正则表达式
		
		// 绅士漫画
		$prge = [
			'txtPrge' => '/http:\/\/(.+)/', // 以网站地址 txt文件存放路径
			'linkUrlPrge' => '/(http:\/\/.+?)\//', // 网站地址
			'nameUrlPrge' => '/<title>(.+?)<\/title>/', // 网站名称
			'listUrlPrge' => '/<li>\s*<a\s*href=[\'"](.+?)[\'"]\s*class=[\'"]pic\s*show[\'"]/', // 目录列表
			'titListUrlPrge' => '/<span class="bt">(.+?)<\/span>/', // 目录名称
			'pageUrlPrge' => '/共(\d*)页/', // 页数
			'picUrlPrge' => '/<img\s*.+?=[\'"](h.+?)[\'"]/', // 图片链接
			'titDanUrlPrge' => '/<h1.+?>(.+?)<\/h1>/', // 单集目录名称
		];
		
		
		
		// 百度贴吧
		/* $prge = [
			'txtPrge' => '/https:\/\/(.+)/', // 以网站地址 txt文件存放路径
			'linkUrlPrge' => '/(https:\/\/.+?)\//', // 网站地址
			'nameUrlPrge' => '/<a\s*rel=[\'"]noreferrer[\'"]\s*title=[\'"](.+?)[\'"]/', // 网站名称
			'tiebaPrge' => '/<p class="card_slogan">(.+?)<\/p>/', // 贴吧名称
			'listUrlPrge' => '/<a\s*rel=[\'"]noreferrer[\'"]\s*href=[\'"](.+?)[\'"]\s*title=[\'"].+?[\'"]/', // 目录列表
			'titListUrlPrge' => '/<a\s*rel=[\'"]noreferrer[\'"]\s*href=[\'"].+?[\'"]\s*title=[\'"](.+?)[\'"]/', // 目录名称列表
			'picUrlPrge' => '/<img\s*class=[\'"]BDE_Image[\'"]\s*pic_type=.*?src=[\'"](.+?)[\'"]/', // 图片链接
		]; */
		
		// 图片保存路径
		$path = ROOT_PATH . 'public' . DS . 'uploads/';
		
		// 列表页 txt文件 保存路径
		$matchPath = ROOT_PATH . 'public' . DS . 'uploads/' . 'match/';
		
		// 第几话
		$bu = cookie('bu');
		// $bu = 9;
		// $bu = 0;
		
		// 页数
		$ye = cookie('ye');
		// $ye = 5;
		
		// 单集页数
		$dye = cookie('dye');
		// $ye = 1;
		
		$Sang = new Sang();
		
		// $Sang -> shenShi($urlList, $prge, $path, $matchPath, $bu, $ye, true);
		$pics = $Sang -> show($urlList, $prge, $path, $matchPath, $bu, $ye, true);
		
		// $Sang -> sheng($data, $path, $dye);
		$Sang -> hanHan($url, $prge, $path, $dye);
	}
	
	// 酷狗视频地址 已失效
	public function youku()
	{
		
		$url = 'https://v.youku.com/v_show/id_XMzkxMTQ5MzI1Mg==.html?spm=a2h0k.11417342.soresults.dtitle';
		$Youku = new Youku();
		dump($url);
		
		$link = $Youku -> getYoukuFlv($url);
		return;
	}
	
	
	
	// 退出登录
	public function logout()
    {
		// 清除session
		session('admin', null);
		session('showNode', null);
		
		// 清除cookie
		cookie('admin', null);
		
		return $this -> redirect(url('admin/login/index'));
    }
	
}


















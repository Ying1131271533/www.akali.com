<?php
namespace app\admin\controller;

use think\Db;

class Sang
{
	/**
	 * 显卡图片
	 *
	 * @authorwyl
	 */
	public function show($urlList, $prge = [], $path, $matchPath, $bu = null, $ye = null, $iconv = false)
	{
		if(empty($urlList) || empty($prge) || empty($path) || empty($matchPath))
		{
			echo '缺少数据';
			return;
		}
		
		$linkRow = preg_match($prge['linkUrlPrge'], $urlList, $linkMatches);
		$content = file_get_contents($urlList);
		// dump($content);
		// return;
		
		// $listUrlPrge = '/<li>\s*<a\s*href=[\'"](.+?)[\'"]\s*class=[\'"]pic\s*show[\'"]/';
		$listRow = preg_match_all($prge['listUrlPrge'], $content, $listMatches);
		
		// $titListUrlPrge = '/<span class="bt">(.+?)<\/span>/';
		$titListRow = preg_match_all($prge['titListUrlPrge'], $content, $titListMatches);
		
		$listMatches[1] = array_slice($listMatches[1], 2, 41);
		$listMatches[1] = array_reverse($listMatches[1]);
		dump($titListMatches[1]);
		dump($listMatches[1]);
		return;
		$pics = [];
		foreach($listMatches[1] as $key => $value)
		{
			if((int)$key == 2)
			{
				break;
			}
			
			// $url = $listMatches[1][cookie('bu')];
			$url = $linkMatches[1] . $value;
			// dump($url);
			// return;
			
			$content = file_get_contents($url);
			
			// dump($savePath);
			// return;
			// 睡眠
			// $rnd = rand(2000, 5000);
			// sleep(1.0 * $rnd / 1000);
			$picListRow = preg_match_all($prge['picUrlPrge'], $content, $picListMatches);
			// dump($picListMatches[1]);
			$pics = array_merge($pics, $picListMatches[1]);
			// dump($pics);
		
		}
		return $pics;
		
		
	}
	
	
	/**
	 * 百度贴吧 失败
	 *
	 * @authorwyl
	 */
	public function sang($urlList, $prge = [], $path, $matchPath, $bu = null, $ye = null, $iconv = false)
	{
		if(empty($urlList) || empty($prge) || empty($path) || empty($matchPath))
		{
			echo '缺少数据';
			return;
		}
		
		cookie('bu', $bu, 3600*24);
		cookie('ye', $ye, 3600*24);
		
		// dump(cookie('bu'));
		// dump(cookie('ye'));
		// return;
		
		// $linkUrlPrge = '/(http:\/\/.+?)\//';
		$linkRow = preg_match($prge['linkUrlPrge'], $urlList, $linkMatches);
		$txtRow = preg_match($prge['txtPrge'], $urlList, $txtMatches);
		$txtName = $this -> strFilter($txtMatches[1]);
		// dump(str_replace("/", "-", $txtMatches[1]));
		// dump($txtName);
		// return;
		
		if(file_exists($matchPath . $txtName . '.txt'))
		{
			$content = file_get_contents($matchPath . $txtName . '.txt');
			
		}else
		{
			// 创建txt文本
			if($iconv === true)
			{
				$content = file_get_contents($urlList);
			}else
			{
				$content = $this -> getFiles($urlList, $linkMatches[1], '', '', false);
				$content = iconv('gb2312', 'utf-8//IGNORE', $content);
			}
			
			file_put_contents($matchPath . $txtName . '.txt', $content);
		}
		// dump($iconv);
		// dump($content);
		// return;
		
		// 网站名称
		// $nameUrlPrge = '/<title>(.+?)<\/title>/';
		$nameRow = preg_match($prge['nameUrlPrge'], $content, $nameMatches);
		$name = $nameMatches[1];
		$name  = $this -> strFilter($name);
		
		// 贴吧名称
		$nameRow = preg_match($prge['tiebaPrge'], $content, $tiebaMatches);
		$tieba = $tiebaMatches[1];
		$tieba  = $this -> strFilter($tieba);
		// dump($tieba);
		// return;
		
		// $listUrlPrge = '/<li>\s*<a\s*href=[\'"](.+?)[\'"]\s*class=[\'"]pic\s*show[\'"]/';
		$listRow = preg_match_all($prge['listUrlPrge'], $content, $listMatches);
		
		// $titListUrlPrge = '/<span class="bt">(.+?)<\/span>/';
		$titListRow = preg_match_all($prge['titListUrlPrge'], $content, $titListMatches);
		
		// $listMatches[1] = array_slice($listMatches[1], 0, 8);
		// $titListMatches[1] = array_slice($titListMatches[1], 0, 8);
		cookie('bu') OR cookie('bu', 0, 3600*24);
		// dump(cookie('bu'));
		// dump(cookie('ye'));
		// dump($listMatches[1]);
		// dump($titListMatches[1]);
		// return;
		foreach($listMatches[1] as $key => $value)
		{
			if(strpos($value, '/p/') === false)
			{
				cookie('bu', (int)$key + 1);
				continue;
			}
			
			// dump('www.ess32.com' . $matches[1][cookie('bu')]);
			// return;
			if(count($listMatches[1]) <= (int)cookie('bu'))
			{
				break;
			}
			
			// $url = $listMatches[1][cookie('bu')];
			$url = $linkMatches[1] . $listMatches[1][cookie('bu')];
			// dump($url);
			// return;
			
			// 转格式
			if($iconv === true)
			{
				$content = file_get_contents($url);
			}else
			{
				$content = $this -> getFiles($url, $linkMatches[1], '', '', false);
				$content = iconv('gb2312', 'utf-8//IGNORE', $content);
			}
			
			// 漫画标题
			$title = $titListMatches[1][cookie('bu')];
			
			
			$title  = $this -> strFilter($title);
			// dump($titMatches);
			// dump($title);
			// return;
			
			
			$savePath = $path . $name .'/'. $tieba .'/'. $title .'/';
			// dump($savePath);
			// return;
			$savePath = iconv('utf-8', 'gbk', $savePath);
			is_dir($savePath) OR mkdir($savePath, 0777, true);
			// dump($titleMatches[1]);
			cookie('ye') OR cookie('ye', 0, 3600*24);
			// dump($savePath);
			// return;
			
			$picListRow = preg_match_all($prge['picUrlPrge'], $content, $picListMatches);
			// dump($picListMatches[1]);
			// return;
			
			$page = count($picListMatches[1]) - 1;
			
			for($p = (int)cookie('ye'); $p <= $page; $p++)
			{
				// 文件名
				$fileName = $p . substr($picListMatches[1][$p], -4);
				if(strpos($fileName, '.') === false)
				{
					$fileName = '.' . $fileName;
					
				}
				// dump($picListMatches[1][$p]);
				// dump($linkMatches[1]);
				// dump($savePath);
				// dump($fileName);
				// return;
				// 创建图片
				// file_put_contents('123.jpg', $picListMatches[1][$p]);
				
				$this -> getFiles($picListMatches[1][$p], $linkMatches[1], $savePath, $fileName);
				return;
				// 记录页数
				cookie('ye', $p, 3600*24);
				
				if($p >= $page)
				{
					// 采集完成后将页数和话数变为空
					cookie('ye', null);
					cookie('bu', (int)cookie('bu') + 1);
				}
				
				// break;
			}
			
			dump($page);
			// continue;
			return;
		}
		
		cookie('bu', null);
		
	}
	
	/**
	 * e绅士漫画资源网
	 *
	 * @authorwyl
	 */
	public function shenShi($urlList, $prge = [], $path, $matchPath, $bu = null, $ye = null)
	{
		if(empty($urlList) || empty($prge) || empty($path) || empty($matchPath))
		{
			echo '缺少数据';
			return;
		}
		
		cookie('bu', $bu, 3600*24);
		cookie('ye', $ye, 3600*24);
		
		// dump(cookie('bu'));
		// dump(cookie('ye'));
		// return;
		
		// $linkUrlPrge = '/(http:\/\/.+?)\//';
		$linkRow = preg_match($prge['linkUrlPrge'], $urlList, $linkMatches);
		$txtRow = preg_match($prge['txtPrge'], $urlList, $txtMatches);
		$txtName = str_replace("/", "_", $txtMatches[1]);
		// dump(str_replace("/", "-", $txtMatches[1]));
		// dump($linkMatches);
		// return;
		
		if(file_exists($matchPath . $txtName . '.txt'))
		{
			$content = file_get_contents($matchPath . $txtName . '.txt');
			
		}else
		{
			// 创建txt文本
			$content = $this -> getFiles($urlList, $linkMatches[1], '', '', false);
			// $content = file_get_contents($urlList);
			$content = iconv('gb2312', 'utf-8//IGNORE', $content);
			file_put_contents($matchPath . $txtName . '.txt', $content);
		}
		// dump($content);
		// return;
		
		// 网站名称
		// $nameUrlPrge = '/<title>(.+?)<\/title>/';
		$nameRow = preg_match($prge['nameUrlPrge'], $content, $nameMatches);
		$name = $nameMatches[1];
		$name  = $this -> strFilter($name);
		
		// $listUrlPrge = '/<li>\s*<a\s*href=[\'"](.+?)[\'"]\s*class=[\'"]pic\s*show[\'"]/';
		$listRow = preg_match_all($prge['listUrlPrge'], $content, $listMatches);
		
		// $titListUrlPrge = '/<span class="bt">(.+?)<\/span>/';
		$titListRow = preg_match_all($prge['titListUrlPrge'], $content, $titListMatches);
		
		// $listMatches[1] = array_slice($listMatches[1], 0, 8);
		// $titListMatches[1] = array_slice($titListMatches[1], 0, 8);
		cookie('bu') OR cookie('bu', 0, 3600*24);
		// dump(cookie('bu'));
		// dump(cookie('ye'));
		// dump($listMatches[1]);
		// return;
		foreach($listMatches[1] as $key => $value)
		{
			// dump('www.ess32.com' . $matches[1][cookie('bu')]);
			// return;
			if(count($listMatches[1]) <= (int)cookie('bu'))
			{
				break;
			}
			
			// $url = $listMatches[1][cookie('bu')];
			$url = $linkMatches[1] . $listMatches[1][cookie('bu')];
			
			$content = $this -> getFiles($url, $linkMatches[1], '', '', false);
			// $content = file_get_contents($urlList);
			// 转格式
			$content = iconv('gb2312', 'utf-8//IGNORE', $content);
			// file_put_contents($matchPath . 'www.ess32.com.txt', $content);
			// $content = file_get_contents($matchPath . 'www.ess32.com.txt');
			
			
			// $pageUrlPrge = '/共(\d*)页/';
			// $titleUrlPrge = '/<h1\s*data-spm=[\'"]\d*[\'"]>\s*(.+?)\s*<\/h1>/'; 示例
			$pageRow = preg_match($prge['pageUrlPrge'], $content, $pageMtches);
			// dump($prge['pageUrlPrge']);
			// dump($pageUrlPrge);
			// dump($pageMtches);
			// return;
			if(empty($pageMtches[1]))
			{
				cookie('bu', (int)cookie('bu') + 1);
				continue;
			}
			
			$page = (int)$pageMtches[1];
			// $page = 1000;
			
		/* 	
			$titleUrlPrge = '/<h1.+?>(.+?)<\/h1>/';
			$titleRow = preg_match($titleUrlPrge, $content, $titleMatches);
		 */	
			
			// 漫画标题
			$title = $titListMatches[1][cookie('bu')];
			
			
			$title  = $this -> strFilter($title);
			// dump($titMatches);
			// dump($title);
			// return;
			
			
			$savePath = $path . $name .'/'. $title .'/';
			// dump($savePath);
			// return;
			$savePath = iconv('utf-8', 'gbk', $savePath);
			is_dir($savePath) OR mkdir($savePath, 0777, true);
			// dump($titleMatches[1]);
			cookie('ye') OR cookie('ye', 1, 3600*24);
			// dump($savePath);
			// return;
			
			for($p = (int)cookie('ye'); $p <= $page; $p++)
			{
				$picUrl = $url;
				if($p > 1)
				{
					$picUrl = str_replace(".html", "_" . $p . ".html", $url);
				}
				
				// 记录页数
				cookie('ye', $p, 3600*24);
				
				// return;
				// 转格式
				$content = $this -> getFiles($picUrl, $linkMatches[1], '', '', false);
				
				// $content = file_get_contents($picUrl);
				$content = iconv('gb2312', 'utf-8//IGNORE', $content);
				// file_put_contents($matchPath . 'ess32_view.txt', $content);
				// $content = file_get_contents($matchPath . 'ess32_view.txt');
				
				// $picUrlPrge = '/<img\s*src=[\'"](.+?)[\'"]/';
			/* 	
				if(strpos($url, 'ssmh') !== false || strpos($url, 'wuyiniao') !== false)
				{
					$picUrlPrge = '/<img\s*src=[\'"](.+?)[\'"]/';
					
				}else if(strpos($url, 'ribenmanhua') !== false)
				{
					$picUrlPrge = '/<img\s*alt=[\'"].+?src=[\'"](.+?)[\'"]/';
				}
			 */	
				
				$row = preg_match($prge['picUrlPrge'], $content, $picMatches);
				
				// dump($picMatches[1]);
				// dump($picMatches);
				// return;
				
				
				if(empty($row))
				{
					continue;
					
				}else
				{
					// 图片后缀名
					$fileName = $p . substr($picMatches[1], -4);
					if(strpos($fileName, '.') === false)
					{
						$fileName = '.' . $fileName;
						
					}
					// dump($picMatches[1]);
					// dump($fileName);
					// return;
					// file_put_contents($savePath . $fileName, $picMatches[1]);
					
					// 睡眠
					// $rnd = rand(2000, 5000);
					// sleep(1.0 * $rnd / 1000);
					// 创建图片
					$this -> getFiles($picMatches[1], $linkMatches[1], $savePath, $fileName);
					
				}
				
				if($p >= $page)
				{
					// 采集完成后将页数和话数变为空
					cookie('ye', null);
					cookie('bu', (int)cookie('bu') + 1);
					
					break;
				}
				
				// break;
			}
			
			dump($pageMtches[1]);
			// continue;
			return;
		}
		
		cookie('bu', null);
		
	}
	
	
	/**
	 * 保存单集
	 *
	 * @authorwyl
	 */
	public function danji($url, $prge = [], $path, $matchPath, $dye = null)
	{
		if(empty($url) || empty($prge) || empty($path) || empty($matchPath))
		{
			echo '缺少数据';
			return;
		}
		
		cookie('dye', $dye, 3600*24);
		
		// dump(cookie('ye'));
		// return;
		
		// $linkUrlPrge = '/(http:\/\/.+?)\//';
		$linkRow = preg_match($prge['linkUrlPrge'], $url, $linkMatches);
		$txtRow = preg_match($prge['txtPrge'], $url, $txtMatches);
		$txtName = str_replace("/", "_", $txtMatches[1]);
		// dump(str_replace("/", "-", $txtMatches[1]));
		// dump($linkMatches);
		// return;
		
		$content = $this -> getFiles($url, $linkMatches[1], '', '', false);
		$content = iconv('gb2312', 'utf-8//IGNORE', $content);
		// dump($content);
		// return;
		
		// 网站名称
		// $nameUrlPrge = '/<title>(.+?)<\/title>/';
		$nameRow = preg_match($prge['nameUrlPrge'], $content, $nameMatches);
		$name = $nameMatches[1];
		$name  = $this -> strFilter($name);
		// dump($content);
		// return;
		
		// $pageUrlPrge = '/共(\d*)页/';
		// $titleUrlPrge = '/<h1\s*data-spm=[\'"]\d*[\'"]>\s*(.+?)\s*<\/h1>/'; 示例
		$pageRow = preg_match($prge['pageUrlPrge'], $content, $pageMtches);
		// dump($prge['pageUrlPrge']);
		// dump($pageUrlPrge);
		// dump($pageMtches);
		// return;
		$page = (int)$pageMtches[1];
		// $page = 1000;
		
	/* 	
		$titleUrlPrge = '/<h1.+?>(.+?)<\/h1>/';
		$titleRow = preg_match($titleUrlPrge, $content, $titleMatches);
	 */	
		
		// 漫画标题
		preg_match($prge['titDanUrlPrge'], $content, $titMatches);
		$title = $titMatches[1];
		// dump($titMatches);
		// return;
		
		$title  = $this -> strFilter($title);
		// dump($titMatches);
		// dump($title);
		// return;
		
		
		$savePath = $path . $name .'/'. $title .'/';
		// dump($savePath);
		// return;
		$savePath = iconv('utf-8', 'gbk', $savePath);
		is_dir($savePath) OR mkdir($savePath, 0777, true);
		// dump($titleMatches[1]);
		cookie('dye') OR cookie('dye', 1, 3600*24);
		// dump($savePath);
		// return;
		
		for($p = (int)cookie('dye'); $p <= $page; $p++)
		{
			$picUrl = $url;
			if($p > 1)
			{
				$picUrl = str_replace(".html", "_" . $p . ".html", $url);
			}
			
			// 记录页数
			cookie('dye', $p, 3600*24);
			
			// return;
			// 转格式
			$content = $this -> getFiles($picUrl, $linkMatches[1], '', '', false);
			
			// $content = file_get_contents($picUrl);
			$content = iconv('gb2312', 'utf-8//IGNORE', $content);
			
			$row = preg_match($prge['picUrlPrge'], $content, $picMatches);
			
			// dump($picMatches[1]);
			// dump($picMatches);
			// return;
			
			
			if(empty($row))
			{
				continue;
				
			}else
			{
				// 文件名
				$fileName = $p . substr($picMatches[1], -4);
				if(strpos($fileName, '.') === false)
				{
					$fileName = '.' . $fileName;
					
				}
				
				// file_put_contents($savePath . $fileName, $picMatches[1]);
				// dump($savePath . $fileName);
				// return;
				
				// 创建图片
				$this -> getFiles($picMatches[1], $linkMatches[1], $savePath, $fileName);
				
			}
			
			if($p >= $page)
			{
				// 采集完成后将页数变为空
				cookie('dye', null);
				
				break;
			}
			
			// break;
		}
	}
	
	
	/**
	 * 丧女漫画
	 *
	 * @authorwyl
	 */
	public function sangNv()
	{
		// 丧女漫画地址
		$link = 'http://www.verydm.com';
		$content = file_get_contents($matchPath . 'sang.txt');
		// file_put_contents('sang.txt', $content); 
		$listUrlPrge = '/<li>\s*<a\s*href=[\'"](.+?)[\'"]\s*target=.+?a>/';
		// $titleUrlPrge = '/<h1\s*data-spm=[\'"]\d*[\'"]>\s*(.+?)\s*<\/h1>/'; 示例
		$row = preg_match_all($listUrlPrge, $content, $matches);
		
		// dump($matches[1]);
		// return;
		if(empty($row))
		{
			return $this -> error('采集失败');
		}
		
		$matches[1] = array_reverse($matches[1]);
		unset($matches[1][0]);
		// dump($matches[1]);
		$matches[1] = array_slice($matches[1], 38, 88);
		// dump($matches[1]);
		// return;
		foreach($matches[1] as $key => $value)
		{
			for($p = 1; $p <= 100; $p++)
			{
				$url = 'http://www.verydm.com' . $value . '&p=' . $p;
				$content = file_get_contents($url);
				// file_put_contents('sang_view.txt', $content);
				// echo $url;
				// return;
				$listUrlPrge = '/<img\s*src=[\'"](.+?)[\'"]\s*id=[\'"]mainImage2[\'"].+?>/';
				$row = preg_match($listUrlPrge, $content, $matches);
				$jiUrlPrge = '/<span>第(.+?)话<\/span>/';
				$jiRow = preg_match($jiUrlPrge, $content, $jiMatches);
				// echo $fileName;
				// return;
				// dump($matches[1]);
				// dump($jiMatches[1]);
				// return;
				
				if(empty($row) || empty($jiRow))
				{
					$p = 101;
				}else
				{
					// 文件名
					$fileName = substr($matches[1], -7);
					
					// 保存路径
					$path = ROOT_PATH . 'public' . DS . 'uploads/sang/' . $jiMatches[1] . '/';
					
					// 如果文件夹不存在，将以递归方式创建该文件夹
					is_dir($path) OR mkdir($path, 0777, true);
					// 保存图片
					$this -> getFiles($matches[1], $link, $path, $fileName);
				}
			}
			// break;
		}
	}
	
	
	/**
	 * 汗汗漫画
	 *
	 * @authorwyl
	 */
	public function hanHan()
	{
		// 丧女漫画地址
		$link = 'http://www.verydm.com';
		$content = file_get_contents($matchPath . 'sang.txt');
		// file_put_contents('sang.txt', $content); 
		$listUrlPrge = '/<li>\s*<a\s*href=[\'"](.+?)[\'"]\s*target=.+?a>/';
		// $titleUrlPrge = '/<h1\s*data-spm=[\'"]\d*[\'"]>\s*(.+?)\s*<\/h1>/'; 示例
		$row = preg_match_all($listUrlPrge, $content, $matches);
		
		// dump($matches[1]);
		// return;
		if(empty($row))
		{
			return $this -> error('采集失败');
		}
		
		$matches[1] = array_reverse($matches[1]);
		unset($matches[1][0]);
		// dump($matches[1]);
		$matches[1] = array_slice($matches[1], 38, 88);
		// dump($matches[1]);
		// return;
		foreach($matches[1] as $key => $value)
		{
			for($p = 1; $p <= 100; $p++)
			{
				$url = 'http://www.verydm.com' . $value . '&p=' . $p;
				$content = file_get_contents($url);
				// file_put_contents('sang_view.txt', $content);
				// echo $url;
				// return;
				$listUrlPrge = '/<img\s*src=[\'"](.+?)[\'"]\s*id=[\'"]mainImage2[\'"].+?>/';
				$row = preg_match($listUrlPrge, $content, $matches);
				$jiUrlPrge = '/<span>第(.+?)话<\/span>/';
				$jiRow = preg_match($jiUrlPrge, $content, $jiMatches);
				// echo $fileName;
				// return;
				// dump($matches[1]);
				// dump($jiMatches[1]);
				// return;
				
				if(empty($row) || empty($jiRow))
				{
					$p = 101;
				}else
				{
					// 文件名
					$fileName = substr($matches[1], -7);
					
					// 保存路径
					$path = ROOT_PATH . 'public' . DS . 'uploads/sang/' . $jiMatches[1] . '/';
					
					// 如果文件夹不存在，将以递归方式创建该文件夹
					is_dir($path) OR mkdir($path, 0777, true);
					// 保存图片
					$this -> getFiles($matches[1], $link, $path, $fileName);
				}
			}
			// break;
		}
	}
	
	
	
	
	/**
	 * 圣魔之血 保存失败
	 *
	 * @authorwyl
	 */
	public function sheng($data = [], $path, $dye = null)
	{
		if(empty(empty($data) || empty($path) || empty($matchPath)))
		{
			echo '缺少数据';
			return;
		}
		
		
		// 保存路径
		$savePath = $path . $data['name'] .'/'. $data['title'] .'/';
		$savePath = iconv('utf-8', 'gbk', $savePath);
		is_dir($savePath) OR mkdir($savePath, 0777, true);
		
		cookie('dye', $dye, 3600*24);
		cookie('dye') OR cookie('dye', 1, 3600*24);
		
		
		for($p = (int)cookie('dye'); $p <= $data['page']; $p++)
		{
			// 圣魔之血
			$picUrl = $data['picUrl']. $p .$data['fileSuffixName'];
			
			// 记录页数
			cookie('dye', $p, 3600*24);
			
			// 图片生成名称
			$fileName = $p . $data['fileSuffixName'];
			
			// 创建图片
			$this -> getFiles($picUrl, $data['url'], $savePath, $fileName);
			
			if($p >= $data['page'])
			{
				// 采集完成后将页数变为空
				cookie('dye', null);
				
				break;
			}
			
			// break;
		}
	}
	
	/**
	 * 据说很牛的保存图片代码
	 *
	 * @authorwyl
	 */
	public function getFiles($url, $link, $savePath, $fileName, $file = true)
	{
		// dump($url);
		// dump($link);
		// return;
		$curl = curl_init($url); //初始化  
		curl_setopt($curl, CURLOPT_HEADER, FALSE);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE); //将结果输出到一个字符串中，而不是直接输出到浏览器
		curl_setopt($curl, CURLOPT_REFERER, $link); //最重要的一步，手动指定 Referer
		$re = curl_exec($curl); //执行
		if (curl_errno($curl))
		{
			curl_close($curl);
			return NULL;
		}
		
		curl_close($curl);
		
		if($file)
		{
			// 生成文件
			file_exists($savePath . $fileName) OR file_put_contents($savePath . $fileName, $re);
		}else
		{
			return $re;
		}
		
		// return;
	}
	
	/**
	 * PHP字符串中特殊符号的过滤方法介绍
	 *
	 * @authorwyl
	 */
	public function strFilter($str)
	{
		$str = str_replace('/', '-', $str);
		$str = str_replace('\\', '-', $str);
		$str = str_replace(':', '-', $str);
		$str = str_replace('*', '-', $str);
		$str = str_replace('?', '-', $str);
		$str = str_replace('<', '-', $str);
		$str = str_replace('>', '-', $str);
		$str = str_replace('|', '-', $str);
		$str = str_replace('"', '-', $str);
		$str = str_replace('・', '-', $str);
		
		// $str = str_replace('·', '', $str);
		// $str = str_replace('~', '', $str);
		// $str = str_replace('!', '', $str);
		// $str = str_replace('！', '', $str);
		// $str = str_replace('@', '', $str);
		// $str = str_replace('#', '', $str);
		// $str = str_replace('$', '', $str);
		// $str = str_replace('￥', '', $str);
		// $str = str_replace('%', '', $str);
		// $str = str_replace('^', '', $str);
		// $str = str_replace('……', '', $str);
		// $str = str_replace('&', '', $str);
		// $str = str_replace('*', '', $str);
		// $str = str_replace('(', '', $str);
		// $str = str_replace(')', '', $str);
		// $str = str_replace('（', '', $str);
		// $str = str_replace('）', '', $str);
		// $str = str_replace('-', '', $str);
		// $str = str_replace('_', '', $str);
		// $str = str_replace('——', '', $str);
		// $str = str_replace('+', '', $str);
		// $str = str_replace('=', '', $str);
		// $str = str_replace('|', '', $str);
		// $str = str_replace('\\', '', $str);
		// $str = str_replace('[', '', $str);
		// $str = str_replace(']', '', $str);
		// $str = str_replace('【', '', $str);
		// $str = str_replace('】', '', $str);
		// $str = str_replace('{', '', $str);
		// $str = str_replace('}', '', $str);
		// $str = str_replace(';', '', $str);
		// $str = str_replace('；', '', $str);
		// $str = str_replace(':', '', $str);
		// $str = str_replace('：', '', $str);
		// $str = str_replace('\'', '', $str);
		// $str = str_replace('"', '', $str);
		// $str = str_replace('“', '', $str);
		// $str = str_replace('”', '', $str);
		// $str = str_replace(',', '', $str);
		// $str = str_replace('，', '', $str);
		// $str = str_replace('<', '', $str);
		// $str = str_replace('>', '', $str);
		// $str = str_replace('《', '', $str);
		// $str = str_replace('》', '', $str);
		// $str = str_replace('.', '', $str);
		// $str = str_replace('。', '', $str);
		// $str = str_replace('/', '', $str);
		// $str = str_replace('、', '', $str);
		// $str = str_replace('?', '', $str);
		// $str = str_replace('？', '', $str);
		
		
		return trim($str);
	}
	
}







































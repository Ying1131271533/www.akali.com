<?php
namespace weixin;

class WinXinApi
{
	// token
	protected $token = 'akali';
	
	// 客户的账号
	protected $fromUsername;
	
	// 自己的账号
	protected $toUsername;
	
	// 接收到的内容
	protected $keyword;
	
	// 接收到的消息的时间
	protected $time;
	
	// 处理用户信息方法
    public function responseMsg()
    {
		//获取微信post过来的数据
		$postStr = file_get_contents('php://input');
		
      	//extract post data
		if (!empty($postStr))
		{
			/* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
			   the best way is to check the validity of xml by yourself */
			libxml_disable_entity_loader(true);
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			
			$this -> fromUsername 	= $postObj->FromUserName;
			$this -> toUsername 	= $postObj->ToUserName;
			$this -> keyword 		= trim($postObj->Content);
			$this -> time 			= time();
			
			if(! empty($this -> keyword))
			{
				$msgType = "text";
				$contentStr = "Welcome to wechat world!";
				
				if($this -> keyword == '阿卡丽')
				{
					$contentStr = "暗影之拳";
					// $contentStr = "中文@日文";
				}
				
				// 翻译
				$keyword = explode('@', $this -> keyword);
				if(count($keyword) == 2)
				{
					$contentStr = $this -> baiduFanyi($keyword[0], $keyword[1]);
					$msgType = "text";
				}
				
				// 图片识别
				if($this -> keyword == "H")
				{
					// $str = substr($this -> keyword, 1)
					$contentStr = $this -> pic();
					$msgType = "text";
				}
				
				// 判断消息类型
				switch($msgType)
				{
					case "text":
						$resultStr = $this -> textTpl($contentStr);
						break;
				}
				
				echo $resultStr;
				
			}else
			{
				echo "Input something...";
			}

        }else {
        	echo "";
        	exit;
        }
    }
	
	// 百度翻译
	protected function baiduFanyi($q, $lan = '英语')
	{
		// $q = '需要翻译的内容'
		$from = 'zh';
		$to = 'en';
		switch($lan)
		{
			case '英文';
			case '英语';
				$to = 'en';
				break;
				
			case '日文';
			case '日语';
				$to = 'jp';
				break;
				
			case '粤语';
				$to = 'yue';
				break;
		}
		
		$appid 	= '20170406000044226';
		$key 	= 'tCHaVGmVwu84iv_2j8NJ';
		$salt 	= mt_rand(10000, 99999);
		$sign 	= md5($appid . $q . $salt . $key);
		
		$url = "http://api.fanyi.baidu.com/api/trans/vip/translate?q={$q}&from={$from}&to={$to}&appid={$appid}&salt={$salt}&sign={$sign}";
		
		$result = file_get_contents($url);
		
		// 把json数据转换成数据
		$data = json_decode($result, true);
		
		if(! empty($data['error_code']))
		{
			return '翻译出错';
		}
		
		// 翻译结果
		return '翻译结果：' . $data['trans_result'][0]['dst'];
		
	}
	
	// 色情图片识别等级
	protected function pic()
	{
		$ch = curl_init();
		$url = 'http://apis.baidu.com/idl_baidu/pornfilter/pornfilter';
		$header = array(
			'Content-Type:application/x-www-form-urlencoded',
			'apikey: 15795363b9e1bbe43773d2665662ce0b',
		);
		
		$data = '{
			"params": [
				{
					"image": "D:\0.jpg",
					"versionnum": "1.0",
					"logid": 1,
					"cmdid": "cmdid",
					"appid": "appid",
					"clientip": "10.23.34.5",
					"type": "type"
				}
			],
			"jsonrpc": "2.0",
			"method": "classify",
			"id": 12345
		}';
		
		// 添加apikey到header
		curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
		// 添加参数
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// 执行HTTP请求
		curl_setopt($ch , CURLOPT_URL , $url);
		$res = curl_exec($ch);

		$level = json_decode($res, true);
		return '色情等级为：' . $level['result']['_ret']['confidence_level'];
		
	}
	
	// 文本消息模版
	protected function textTpl($contentStr)
	{		
		$tpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					<FuncFlag>0</FuncFlag>
					</xml>";
		
		$resultStr = sprintf($tpl, $this -> fromUsername, $this -> toUsername, $this -> time, 'text', $contentStr);
		
		return $resultStr;
	}
	
	// 验证
	public function valid()
    {
		$echoStr = input('echostr');

		//valid signature , option
        if(! empty($echoStr) && $this->checkSignature())
		{
        	echo $echoStr;
        	exit;
        }
		
		return $this;
    }
	
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (empty($this -> token)) {
            throw new \Exception('TOKEN is not defined!');
        }
        
        $signature = input('signature');
        $timestamp = input('timestamp');
        $nonce = input('nonce');
		
		$tmpArr = array($this -> token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}



















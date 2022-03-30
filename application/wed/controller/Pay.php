<?php
namespace app\wed\controller;

use think\DB;

class Pay extends Base
{
	public function _initialize()
	{
		parent::_initialize();
		
		$this -> config = config();
		vendor('pay.alipay.alipay_core');
		vendor('pay.alipay.alipay_md5');
		vendor('pay.alipay.AlipayNotify');
		vendor('pay.alipay.AlipaySubmit');
	}
	
	public function alipay() {
		$order = db('order') -> where('order_sn', input('order_sn/s')) -> find();
		if(empty($order)){
			return $this -> error('找不到该订单');
		}
		
		/**************************请求参数**************************/
        //商户订单号，商户网站订单系统中唯一订单号，必填
		$out_trade_no = $order['order_sn'];

        //订单名称，必填
		$subject = '阿卡丽神秘商店';

		//付款金额，必填
		$total_fee = $order['total'];

		// 商品描述，可空
		$body = '阿卡丽 鬼舞姬';
		
		$alipay_config = $this -> config['alipay'];
		
		//构造要请求的参数数组，无需改动
		$parameter = array(
			"service"       => $alipay_config['service'],
			"partner"       => $alipay_config['partner'],
			"seller_id"  	=> $alipay_config['seller_id'],
			"payment_type"	=> $alipay_config['payment_type'],
			"notify_url"	=> $alipay_config['notify_url'],
			"return_url"	=> $alipay_config['return_url'],
			
			"anti_phishing_key"=>$alipay_config['anti_phishing_key'],
			"exter_invoke_ip"=>$alipay_config['exter_invoke_ip'],
			"out_trade_no"	=> $out_trade_no,
			"subject"	=> $subject,
			"total_fee"	=> $total_fee,
			"body"	=> $body,
			"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
			
		);
		
		//建立请求
		$alipaySubmit = new \AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
		echo $html_text;
	}
	
	// 给支付宝看的地址
	public function notify_url() {
		//计算得出通知验证结果
		$alipayNotify = new \AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();

		if($verify_result){//验证成功
		
			$out_trade_no = input('out_trade_no');

			//支付宝交易号

			$trade_no = input('trade_no');

			//交易状态
			$trade_status = input('trade_status');


			if($_POST['trade_status'] == 'TRADE_FINISHED' || $_POST['trade_status'] == 'TRADE_SUCCESS') 
			{
				db('order') -> where('order_sn', $out_trade_no) -> update([		
				
					'order_status' 	=> 1,
					'pay_status' 	=> 1, 
				
				]);
			}
			
			echo 'success';		// 请不要修改或删除
			
		}else{
			//验证失败
			
			echo 'fail';
			
		}
	}
	
	// 用户看的地址
	public function return_url() {
		//计算得出通知验证结果
		$alipayNotify = new \AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();

		if($verify_result){//验证成功
		
			$out_trade_no = input('out_trade_no');

			//支付宝交易号

			$trade_no = input('trade_no');

			//交易状态
			$trade_status = input('trade_status');

			
			if(! empty($trade_status)) 
			{
				db('order') -> where('order_sn', $out_trade_no) -> update([		
				
					'order_status' 	=> 1,
					'pay_status' 	=> 1, 
				
				]);
			}else
			{
				db('order') -> where('order_sn', $out_trade_no) -> update([		
				
					'order_status' 	=> 0,
					'pay_status' 	=> 0, 
				
				]);
			}
			
			return $this -> fetch();
			
		}else{
			//验证失败
			
			return $this -> fetch();
			
		}
	}
	
}


























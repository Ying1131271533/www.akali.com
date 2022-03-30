<?php
namespace app\web\controller;

class ToolModel{
　　/**
     * [http 调用接口函数]
     * @Author GeorgeHao
     * @param  string       $url     [接口地址]
     * @param  array        $params  [数组 || json字符串] (GET提交方式的传入$params必须是数组),(POST 提交方式的传入 $params 必须是json字符串形式)
     * @param  string       $method  [GET\POST\DELETE\PUT]
     * @param  array        $header  [HTTP头信息]
     * @param  integer      $timeout [超时时间]
     * @return [type]                [接口返回数据]
     */
    public static function restCall($url, $params, $method = 'GET', $header = array(), $timeout = 10000)
	{
　　　　// POST 提交方式的传入 $set_params 必须是字符串形式
        $opts = array(
            CURLOPT_TIMEOUT => $timeout,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HEADER => true,
            CURLOPT_NOBODY => false,
            CURLOPT_HTTPHEADER => $header
        );

        /* 根据请求类型设置特定参数 */
        switch (strtoupper($method)) {
            case 'GET':
                if(empty($params)){
                    $opts[CURLOPT_URL] = $url;
                } else {
                    $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
                }
                break;
            case 'POST':
                $opts[CURLOPT_URL] = $url;
                $opts[CURLOPT_POST] = 1;
                $opts[CURLOPT_POSTFIELDS] = $params;
                break;
            case 'UPLOAD':
                $opts[CURLOPT_URL] = $url;
                $opts[CURLOPT_POST] = 1;
                $opts[CURLOPT_POSTFIELDS] = $params;
                break;

　　　　　　　case 'DOWNLOAD':
                $opts[CURLOPT_URL] = $url;
                $opts[CURLOPT_POSTFIELDS] = $params;
                break;
            case 'DELETE':
                if(empty($params)){
                    $opts[CURLOPT_URL] = $url;
                } else {
                    $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
                }
//                $opts[CURLOPT_URL] = $url;
                $opts[CURLOPT_HTTPHEADER] = array("X-HTTP-Method-Override: DELETE");
                $opts[CURLOPT_CUSTOMREQUEST] = 'DELETE';
                $opts[CURLOPT_POSTFIELDS] = $params;
                break;
            case 'PUT':
                $opts[CURLOPT_URL] = $url;
                $opts[CURLOPT_POST] = 0;
                $opts[CURLOPT_CUSTOMREQUEST] = 'PUT';
                $opts[CURLOPT_POSTFIELDS] = $params;
                break;
            default:
                echo "不支持的请求方式！";
                break;
        }

        /* 初始化并执行curl请求 */
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data = curl_exec($ch);
        $error = curl_error($ch);
		// var_dump($error);
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != '200') {
            echo "<br/>http请求错误。";
        }
        // 根据请求方式判断是否返回头部消息
        switch (strtoupper($method)) {
            case 'GET':
　　　　　　　　  //除去header消息
        　　　　$headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        　　　　$headerData = substr($data, 0, $headerSize);
        　　　　$bodyData = substr($data, $headerSize);
        　　　　return $bodyData;
        　　break;
    　　　　case 'POST':
        　　　　//除去header消息
        　　　　$headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        　　　　$headerData = substr($data, 0, $headerSize);
        　　　　$bodyData = substr($data, $headerSize);
        　　　　return $bodyData;
        　　break;
    　　　　case 'UPLOAD':
        　　　　$headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        　　　　$headerData = substr($data, 0, $headerSize);
        　　　　$bodyData = substr($data, $headerSize);
        　　　　return $bodyData;
        　　break;
    　　　　case 'DOWNLOAD':
        　　　　return $data;
        　　break;
    　　　　case 'DELETE':
        　　　　return $data;
        　　break;
    　　　　case 'PUT':
        　　　　return $data;
        　　break;
    　　　　default:
        　　　　echo "不支持的请求方式！";
        　　break;
　　　　}
　　　　return $data;
　　}

	
　　/**
 　　* json数据强制转字符串类型
 　　* @param array $array 待转换的数组
 　　* @return string 转换后的json字符串
 　　* @author chunkuan <urcn@qq.com>
 　　*/
　　public static function json_encode_s($array){
    　　foreach($array as &$v){
        　　$v = (string) $v;
    　　}
    　　return json_encode($array);
　　}
}
















<?php

#取代Span斷行
if (!function_exists('item_span'))
{
	function item_span( $str ){

		$strdata = str_replace( "\n" ,'</span>'."\n".'</div>'."\n".'<div class="detail-list">'."\n".'<span class="detail-name">'."\n".'</span>'."\n".'<span>',$str);

		return $strdata;
	}
}

#除掉符號
if (!function_exists('strp_xx'))
{
	function strp_xx( $str='' ){
		$strarray = array(
			'/',
		);
		$strdata = str_replace( $strarray , '', $str );
		return $strdata;
	}
}

#找出最低價
if (!function_exists('serch_min'))
{
	function serch_min( $array=array() ){

		if( !empty( $array ) ){

			$val = $array[0];
			$i=0;
			$k=99;
			foreach( $array as $row ){
				if( $row <= $val and $row > 0 ){
					$val = $row;
					$k=$i;
				}
				$i++;
			}
			return $val.','.$k;
		}


	}
}


#確認管理員狀態
if (!function_exists('check_website_access'))
{
	function check_website_access( $data ){

		if( empty( $data['user'] ) ){
			go_showmsg('','/admin/login');
		}else{

			$readkey = check_view_access( $data['user']['User_gid'] );
			
			if( !$readkey ){
				go_showmsg("您的帳號無權限使用後臺系統喔！", "/admin/login/logout/PUBURL" );
				exit();
			}
		}

	}
}

#管理員等級
if (!function_exists('check_view_access'))
{
	function check_view_access( $User_gid ){

		$readkey = false;
		if( !empty( $User_gid ) ){
			switch ( $User_gid ) {
				case 1:
					$readkey = true;
					break;
				case 2:
					$readkey = true;
					break;
				case 3:
					$readkey = true;
					break;
				case 4:
					$readkey = true;
					break;
				case 5:
					$readkey = true;
					break;
				default:
					$readkey = false;
					break;
			}
		}
		return $readkey;
	}
}

#決定標題
if (!function_exists('site_title'))
{
	function site_title($title,$site){
		#決定網頁標題
		if(!empty($title)){
			return $title . ' - ' . $site['Site_name'];
		}else{
			return $site['Site_name'];
		}
	}
}

#隨機產生7碼亂數密碼
if (!function_exists('redirect_url'))
{

	function generatorPassword($password_len=7)
	{
		$password = '';

		// remove o,0,1,l
		$word = 'abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ0123456789';
		$len = strlen($word);

		for ($i = 0; $i < $password_len; $i++) {
			$password .= $word[rand() % $len];
		}

		return $password;
	}
}

#錯誤跳轉
if (!function_exists('go_showmsg'))
{
	function go_showmsg($msg, $url='')
	{
		if (trim($msg) != "")
		{
			header("content-type: text/html; charset=utf-8");
			echo "<script>";
			echo "alert('".$msg."');";
			if ($url == '')
				echo "history.back(-1);";
			else
				echo "location.href = '".$url."';";
			echo "</script>";
			exit;
		}elseif(trim($url) != ""){
			header("content-type: text/html; charset=utf-8");
			echo "<script>";
			if ($url == '')
				echo "history.back(-1);";
			else
				echo "location.href = '".$url."';";
			echo "</script>";
			exit;
		}
	}
}

#顯示陣列內容
if (!function_exists('show_debug'))
{
	function show_debug($object){
		echo 'Debug Information:';
		echo '<pre>';
		print_r($object);
		echo '</pre>';
	}
}

#自訂字串編碼
if (!function_exists('str_encode'))
{
	function str_encode($str='')
	{
		$key = 'pwd=!account!';
		$encode = base64_encode($key).base64_encode(base64_encode($str)).base64_encode($key);
		$encode = str_replace('=', '__', $encode);
		//$encode = base64_encode($str);
		return $encode;
	}
}

#自訂字串解碼
if (!function_exists('str_decode'))
{
	function str_decode($str='')
	{
		$key = 'pwd=!account!';
		$str = str_replace('__', '=', $str);
		$dekey = base64_encode($key);
		$decode = str_replace($dekey,null,$str);
		$decode = base64_decode(base64_decode($decode));
		//$decode = base64_decode($str);
		return $decode;
	}
}

#字串隱碼幾個字元
if (!function_exists('str_hidden'))
{
	function str_hidden($value, $num)
	{
		$res = '';
		if ($value != '')
		{
			$res = substr_replace($value, '***', $num);
		}
		
		return $res;
	}
}

#金錢格式
if (!function_exists('money_format_1'))
{
	function money_format_1($number=0, $type=1) {
		$res = 0;
		if ($number > 0)
		{
			$res = number_format($number, 0, '.' ,',');
		}
		if ($type == 1)
		{
			$res = '$'.$res;
		}
		
		return $res;
	}
}

#是否為日期格式
if (!function_exists('is_date'))
{
	function is_date($date) {
	
		$unixTime = strtotime($date);
	
		if (!$unixTime)   //strtotime轉換失敗，日期格式顯然不對
	    	return false;
		else
			return true;
	}
}

#特殊符號轉換
if (!function_exists('symbol_conversion'))
{
	function symbol_conversion($str) {
	
		$symbol_array = array(".",",","'",'"'," ","\r","\n");
		$new_symbol_array = array("。","，","’","＂",null,null,null);
		$str = str_replace($symbol_array,$new_symbol_array,$str);
		return $str;
	}
}

#返回週幾
if (!function_exists('return_week'))
{
	function return_week( $date ){

		$week = date("w" , strtotime( $date ));		
		switch ( $week ) {
			case 0:
				return '(週日)';
				break;
			case 1:
				return '(週一)';
				break;
			case 2:
				return '(週二)';
				break;
			case 3:
				return '(週三)';
				break;
			case 4:
				return '(週四)';
				break;
			case 5:
				return '(週五)';
				break;
			case 6:
				return '(週六)';
				break;
		}
	}
}

#洗牌演算法
if (!function_exists('shuffle'))
{
	function shuffle( $data ){

		if( is_array($data) ){
			if( count($data) > 3 ){
				$array_max = count($data)-1;
				foreach ($data as $item) {
					$index_01 = rand(0,$array_max);
					$index_02 = rand(0,$array_max);
					$temp = $data[$index_01];
					$data[$index_01] = $data[$index_02];
					$data[$index_02] = $temp;
				}
			}
			#return $data;
		}else{
			#return array();
		}

	}
}

#強制使用SSL安全連線
if( !function_exists("opensslpage") ){
	function opensslpage( $mod = 'https' ){

		define( 'PAGESSLMOD' , $mod );

		if( SLL ){
			if( ( empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] !== "on" ) ){
				$RealMod = 'http';
			}else{
				$RealMod = 'https';
			}

			if( $mod != $RealMod ){
				header('Location: '.$mod.'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] );
				exit;
			}
		}

	}
}

#驗證台灣身分證字號
if (!function_exists('check_personal_id')){
	function check_personal_id($check){
		if (!preg_match('/^[A-Z][1-2][0-9]{8}$/', $check)) {
			return false;
		}
		$keyTable = array(
			'A' => 10, 'B' => 11, 'C' => 12, 'D' => 13, 'E' => 14, 'F' => 15, 'G' => 16, 'H' => 17,
			'I' => 34, 'J' => 18, 'K' => 19, 'L' => 20, 'M' => 21, 'N' => 22, 'O' => 35, 'P' => 23,
			'Q' => 24, 'R' => 25, 'S' => 26, 'T' => 27, 'U' => 28, 'V' => 29, 'W' => 32, 'X' => 30,
			'Y' => 31, 'Z' => 33
		);
		$n1 = $keyTable[$check[0]];
		$checksum = intval($n1 / 10) + ($n1 % 10) * 9;
		for ($i = 1; $i < 9; $i++) {
			$checksum += $check[$i] * (9 - $i);
		}
		return (substr(10 - ($checksum % 10), 0, 1) == $check[9]);
	}
}

#计算两个日期相隔多少年，多少月，多少天
if (!function_exists('diffDate')){
	/*
	*function：计算两个日期相隔多少年，多少月，多少天
	*param string $date1[格式如：2011-11-5]
	*param string $date2[格式如：2012-12-01]
	*return array array('年','月','日');
	*/
	function diffDate($date1,$date2){

		$date1 = date( 'Y-m-d' , strtotime($date1) );
		$date2 = date( 'Y-m-d' , strtotime($date2) );

		if(strtotime($date1)>strtotime($date2)){
			$tmp=$date2;
			$date2=$date1;
			$date1=$tmp;
		}
		list($y1,$m1,$d1)=explode('-',$date1);
		list($y2,$m2,$d2)=explode('-',$date2);
		$y=$y2-$y1;
		$m=$m2-$m1;
		$d=$d2-$d1;

		if($d<0){
			$d+=(int)date('t',strtotime("-1 month $date2"));
			$m--;
		}
		if($m<0){
			$m+=12;
			$y--;
		}
		return array('year'=>$y,'month'=>$m,'day'=>$d);
	}
}

#顯示系統維護中
if (!function_exists('show_syserr')){
	function show_syserr(){
		show_error( "我們遇到了一些問題，很快就能夠重新為您服務！" , 500 , '系統正在維護');
	}
}

#返回幾天後的日期
if(!function_exists('adddate')){
	function adddate( $n=0 ){
		return date('Y-m-d',strtotime(date('Y-m-d').'+'.$n.' day'));
	}
}

#返回幾天前的日期
if(!function_exists('subdate')){
	function subdate( $n=0 ){
		return date('Y-m-d',strtotime(date('Y-m-d').'-'.$n.' day'));
	}
}

//製造亂碼
if( !function_exists("make_slat") ){
	function make_slat( $max=5 ){

		#產生slat干擾碼
		$str = '';
		for($i=1;$i<=$max;$i++){
			$n = rand(1,3);
			switch($n){
				case 1;
					$str = $str . chr(rand(65,90)); #大寫英文
					break;
				case 2;
					$str = $str . chr(rand(97,122)); #小寫英文
					break;
				case 3;
					$str = $str . chr(rand(48,57)); #數字
					break;
			}
		}
		$slat = $str;

		return $slat;
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the framework as light-weight as possible only the
| absolute minimal resources are loaded by default. For example,
| the database is not connected to automatically since no assumption
| is made regarding whether you intend to use it.  This file lets
| you globally define which systems you would like loaded with every
| request.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
| These are the things you can load automatically:
|
| 1. Packages
| 2. Libraries
| 3. Drivers
| 4. Helper files
| 5. Custom config files
| 6. Language files
| 7. Models
|
*/

/*
| -------------------------------------------------------------------
|  Auto-load Packages
| -------------------------------------------------------------------
| Prototype:
|
|  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
|
*/

$autoload['packages'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| These are the classes located in the system/libraries folder
| or in your application/libraries folder.
|
| Prototype:
|
|	$autoload['libraries'] = array('database', 'email', 'session');
|
| You can also supply an alternative library name to be assigned
| in the controller:
|
|	$autoload['libraries'] = array('user_agent' => 'ua');
*/

$autoload['libraries'] = array(
	'database',// 資料庫
	'form_validation',// 表單驗證
	'session',// session 
	'form_builder',// 表單產生 https://github.com/yuyaun/codeigniter_bootstrap_form_builder
	'template',// 樣板 https://github.com/yuyaun/codeigniter-template
	'curl',// Curl https://github.com/yuyaun/codeigniter-curl
);


/*
| -------------------------------------------------------------------
|  Auto-load Drivers
| -------------------------------------------------------------------
| These classes are located in the system/libraries folder or in your
| application/libraries folder within their own subdirectory. They
| offer multiple interchangeable driver options.
|
| Prototype:
|
|	$autoload['drivers'] = array('cache');
*/

$autoload['drivers'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['helper'] = array('url', 'file');
*/

$autoload['helper'] = array('url');


/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files.  Otherwise, leave it blank.
|
*/

$autoload['config'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Language files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['language'] = array('lang1', 'lang2');
|
| NOTE: Do not include the "_lang" part of your file.  For example
| "codeigniter_lang.php" would be referenced as array('codeigniter');
|
*/

$autoload['language'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['model'] = array('first_model', 'second_model');
|
| You can also supply an alternative model name to be assigned
| in the controller:
|
|	$autoload['model'] = array('first_model' => 'first');
*/

$autoload['model'] = array();

// 設定時區
date_default_timezone_set('Asia/Taipei');

// @ian 增加資料 help
function p($result = '') {
	echo "-----";
	if(!empty($result)) {
		echo "<pre>";
		print_r($result);
		echo "</pre>";
	} else {
		echo '為空值';
	}
	echo "-----";
	exit;
} 

function formOptionArray($dataAry = array(), $valuestr = 'name', $label = '請選擇') {
		$option = array();
		$option[''] = $label;

		foreach ($dataAry as $key => $value) {
			$option[$value['id']] = $value[$valuestr];
		}
		return $option;
} 

// notification error
function flashError($message) {
	$CI =& get_instance();
	$message = array(
		'message' => $message, 
		'status' => 'error', 
	);
	$CI->session->set_flashdata('notification', $message);
}

// notification success
function flashSuccess($message) {
	$CI =& get_instance();
	$message = array(
		'message' => $message, 
		'status' => 'success', 
	);
	$CI->session->set_flashdata('notification', $message);
}


// 取得 Menu 資訊
function select_submenu($id) {
	$CI =&get_instance();
	$row = $CI->db->get_where('backmainmenu', array('id' => $id,))->row_array();
	$link = site_url("backend/".$row['link']);
	$row['link'] = $link.'?panel=' . $id;
	$row['insertlink'] = $link . '?ipanel=' . $id;
	$row['modifylink'] = $link . '?mpanel=' . $id;
	$row['recoverlink'] = $link . '?rpanel=' . $id;
	$row['typelink'] = $link . '?tpanel=' . $id;
	return $row;
}

// Array 排序
function arraySort($arrays, $array, $sort) {
	// Down
	if($array['sort'] > $sort) {
		foreach ($arrays as $key => $value) {
			if($value['sort'] >= $sort) {
				$arrays[$key]['status'] = 'UP'; 
				$arrays[$key]['sort'] = $arrays[$key]['sort'] + 1; 
			}
		}
	}

	// UP
	if($array['sort'] < $sort) {
		foreach ($arrays as $key => $value) {
			if($value['sort'] <= $sort) {
				$arrays[$key]['status'] = 'Down'; 
				$arrays[$key]['sort'] = $arrays[$key]['sort'] - 1; 
			}
		}
	}

	// 當下 Sort 調整
	foreach ($arrays as $key => $value) {
		if($array['id'] == $value['id']) {
			$arrays[$key]['sort'] = $sort;
			$arrays[$key]['status'] = 'Current'; 
		}
	}
	usort($arrays, function($a, $b) { return $b['sort'] - $a['sort']; });

	foreach ($arrays as $key => $value) {
		$arrays[$key]['sort'] = count($arrays) - $key;
	}
	return $arrays;
}


//money setting
function verifyEnougth(){//已出貨的消費滿3600可以進入黃金待審區
	return "3600";
}
function shipEnougth(){//消費滿500可以使用購物金折抵
	return "500";
}
function getGold(){//每次審核通過則發送50元購物金
	return "50";
}
function bonusEnougth(){//每滿100可以拿到1點紅利
	return "100";
}

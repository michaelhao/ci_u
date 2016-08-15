<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once './vendor/autoload.php';

class ExportExcel extends CI_Controller
{
	public function orderExcel(){
		$storeAcc = $this->input->get('acc');
		$from = $this->input->get('from');
		$to = $this->input->get('to');
		$to_end = $to." 23:59:59";

		if ($storeAcc==0) {
			$file_name="所有";
			$orders=$this->db->order_by('id', 'desc')->where('created_at >=', $from)->where('created_at <=', $to_end)->get_where('order', array())->result_array();	
		}else{
			list($IDstore, $IDacc)=explode("-", $storeAcc);//分店-店員
			if ($IDstore==0) {
				$file_name="線上";
				$orders=$this->db->order_by('id', 'desc')->where('created_at >=', $from)->where('created_at <=', $to_end)->get_where('order', array('store_from'=>0))->result_array();	
			}else{
				$store=$this->db->get_where('store', array('id'=>$IDstore, 'recover'=>0))->row_array();
				if ($IDacc==0) {
					$file_name=$store['name'];
					$orders=$this->db->order_by('id', 'desc')->where('created_at >=', $from)->where('created_at <=', $to_end)->get_where('order', array('store_from'=>$IDstore))->result_array();	
				}else{
					$clerk=$this->db->get_where('store_account', array('id'=>$IDacc, 'recover'=>0))->row_array();
					$file_name=$store['name']."_".$clerk['name'];
					$orders=$this->db->order_by('id', 'desc')->where('created_at >=', $from)->where('created_at <=', $to_end)->get_where('order', array('store_from'=>$IDstore, 'store_clerk'=>$IDacc))->result_array();	
				}
			}
		}
		$total = 0;//總金額
		foreach ($orders as $key => $order) {
			$total = $total + $order['order_total'];
		}

		$file = $file_name."訂單".$from."_".$to;//檔案名稱

		$PHPExcel=new PHPExcel();
		$PHPExcel->getProperties()->setTitle($file);
		//指定目前要編輯的工作表 ，預設0是指第一個工作表
		$PHPExcel->setActiveSheetIndex(0);
		//在欄位A1 寫入文字
		// $PHPExcel->getActiveSheet()->setCellValue('A1', '測試');
		$titleWrite = array('訂單編號' , '訂單狀態' , '支付方式' , '下單分店' , '承辦店員' , '付款狀態' , '收件人' , '訂單金額' , '購物金折抵' , '收件人電話' , '收件人地址' , '訂單出貨時間' , '訂單建立時間' , '備註' , '訂單明細');
		for ($i=0; $i < 15; $i++) { 
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i, 1, $titleWrite[$i]);
		}

		$row=2;
		foreach ($orders as $key => $order) {
			
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row ,$order['order_id']);
			switch ($order['status']) {
				case 1:
					$status = "待處理";
					break;
				case 2:
					$status = "已出貨";
					break;
				case 3:
					$status = "訂單註銷";
					break;
				default:
					$status = "error";
					break;
			}
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row ,$status);
			switch ($order['order_payclass']) {
				case "ATM":
                    $payclass = "ATM 轉帳付款";
                    break;
                case "CreditCard":
                    $payclass = "信用卡付款";
                    break;
                case "CVS":
                    $payclass = "超商代碼繳費";
                    break;
                case "COD":
                    $payclass = "貨到付款";
                    break;
                case 'Cash':
                    $payclass = "現金付款";
                    break;
                default:
                    $payclass = "error";
                    break;
			}
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row ,$payclass);//實體店家要顯示什麼?
			//下單分店
			$store=$this->SC_id_to_name(1, $order['store_from']);
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row ,$store);
			//承辦店員
			$clerk=$this->SC_id_to_name(2, $order['store_clerk']);
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row ,$clerk);

			if ($order['order_status']==1) {
				$status = "未付款";
			}else{
				$status = "已付款";
			}
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row ,$status);
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row ,$order['order_postname']);
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row ,$order['order_total']);
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row ,$order['order_redeem']);

			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row ,$order['order_postphone']);
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row ,$order['order_postaddr']);
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row ,$order['order_postdate']);
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row ,$order['created_at']);
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $row ,$order['note']);
			$details=$this->db->get_where('order_detail', array('order_id'=>$order['order_id'],'recover'=>0))->result_array();
			$content_detail="";//csv
			foreach ($details as $key => $detail) {
				$content_detail.=$detail['order_pname']."*".$detail['order_pcount'];
				if ($detail != end($details)) {
					$content_detail.= ",";
				}
			}
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $row ,$content_detail);
			
			$row++;
		}
		$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row ,"總金額 : ".$total);

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename='.$file.".xls");
		header('Cache-Control: max-age=0');
		 
		$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;

	}


	public function SC_id_to_name($SC, $id){//DB中的id轉name
		if ($SC==1) {//1.分店 2.店員
			if($id==0){
				return "線上下單";
			}else{
				$SorC=$this->db->get_where('store', array('id'=>$id))->row_array();
				return $SorC['name'];
			}
		}else{
			if ($id==0) {
				return "無";
			}else{
				$SorC=$this->db->get_where('store_account', array('id'=>$id))->row_array();
				return $SorC['name'];
			}
		}
	}



	public function memberExcel(){
		$file_name = "會員資料".date("YmdHis");

		$PHPExcel=new PHPExcel();
		$PHPExcel->getProperties()->setTitle($file_name);
		//指定目前要編輯的工作表 ，預設0是指第一個工作表
		$PHPExcel->setActiveSheetIndex(0);
		//在欄位A1 寫入文字
		// $PHPExcel->getActiveSheet()->setCellValue('A1', '測試');
		$titleWrite = array('會員編號' , '帳號' , '姓名' , '手機' , 'email' , '身分證字號' , '地址' , '生日' , '會員身分' , '購物金' , '紅利點' , '註冊來源' , '註冊時間' , '會員狀態');
		for ($i=0; $i < 14; $i++) { 
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i, 1, $titleWrite[$i]);
		}

		$users=$this->db->order_by('id', 'asc')->get_where('users', array())->result_array();
		$row=2;
		foreach ($users as $key => $user) {
			
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row ,$user['id']);
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row ,$user['account']);
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row ,$user['name']);
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row ,$user['phone']);
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row ,$user['email']);
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row ,$user['identity']);
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row ,$user['address']);
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row ,$user['birthday']);
			switch ($user['member_level']) {
				case '0':
					$level="普通會員";
					break;
				case '1':
					$level="黃金會員";
					break;
				default:
					$level="error";
					break;
			}
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row ,$level);
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row ,$user['gold']);
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row ,$user['bonus']);
			if ($user['register_from']==0) {
				$register_from="線上註冊";
			}else{
				$from=$this->db->get_where('store', array('id'=>$user['register_from']))->row_array();
				$register_from=$from['name'];
			}
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row ,$register_from);
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row ,$user['dt']);
			switch ($user['isactive']) {
				case '1':
					$isactive="正常";
					break;
				case '2':
					$isactive="停權";
					break;
				default:
					$isactive="error";
					break;
			}
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $row ,$isactive);
			
			$row++;
		}

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename='.$file_name.".xls");
		header('Cache-Control: max-age=0');
		 
		$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;


	}



}
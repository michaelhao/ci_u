<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function insert()
	{
		$order_id = date('ymd').''.substr(time(), -4).'0000';

		// 寫入資料庫
		$input = array(
			'order_id' => $order_id, 
			'order_uid' => 0, 
			'order_total' => $this->input->post('order_total'), 
			'order_payclass' => $this->input->post('order_payclass'),
			'order_status' => $this->input->post('order_status'),
			'order_postname' => $this->input->post('order_postname'), 
			'order_postphone' => $this->input->post('order_postphone'), 
			'order_postaddr' => $this->input->post('order_postaddr'), 
			'note' => $this->input->post('note'), 
			'order_uid' => $this->input->post('order_uid'),
			'order_paytime' => $this->input->post('order_paytime'),
			'status' => $this->input->post('status'),
			'created_at' => date('Y-m-d H:i:s'), 
			'order_postdate' => $this->input->post('order_postdate'),

		);
		$this->db->insert('order', $input); 
		$last_id = $this->db->insert_id();
		
		flashSuccess('新增資料成功。');

		// 導回原本的頁面
		// $panel= $this->input->post("panel");
		// $row=select_submenu($panel);
		// redirect($row["link"], 'refresh');
		$panel= $this->input->post("panel");
		$row=select_submenu($panel);
		$url = $row["modifylink"]."&mpanel=".$panel."&id=".$last_id;
		redirect($url, 'refresh');
	}

	public function insert_detail()
	{
		$id=$this->input->post("id");
		$row=$this->db->get_where('order', array('id' => $id,))->row_array();
		$order_id=$row['order_id'];
// p($order_id);
		// 寫入資料庫
		$input = array(
			'order_id' => $order_id, 
			'order_pid' => 0, 
			'order_pname' => $this->input->post('order_pname'), 
			'order_pcount' => $this->input->post('order_pcount'),
			'order_psubtotal' => $this->input->post('order_psubtotal'),
			'created_at' => date('Y-m-d H:i:s'), 

		);
		$this->db->insert('order_detail', $input); 
		
		flashSuccess('新增資料成功。');

		// 導回原本的頁面
		$order =$this->db->get_where('order', array('order_id' => $order_id,))->row_array();
		$panel= 6;
		$row=select_submenu($panel);
		redirect($row["modifylink"]."&mpanel=".$panel."&id=".$order['id'], 'refresh');
	}

	public function modify()
	{
		// 寫入資料庫
		$input = array(
			'order_postdate' => $this->input->post('order_postdate'),//出貨日期
			'updated_at' => date('Y-m-d H:i:s'), 
		);
		if ($this->input->post('order_status')) {//付款狀態
			$input['order_status'] = $this->input->post('order_status');
		}
		if ($this->input->post('status')) {//出貨狀態
			$input['status'] = $this->input->post('status');
			//如果改成訂單註銷->要把庫存加回來
			if ($this->input->post('status')==3) {
				$the_order = $this->db->get_where('order', array('id'=>$this->input->post("id")))->row_array();
				if ($the_order['status']==1) {//原本是待處理
					if ($the_order['order_payclass']=="COD") {//貨到付款
						$order_details = $this->db->get_where('order_detail', array('order_id' => $the_order['order_id']))->result_array();
						foreach ($order_details as $key => $order_detail) {
		                    $product = $this->db->get_where('product', array('id' => $order_detail['order_pid']))->row_array(); 
		                    //是否要判斷抓到運費時不用動作??  
		                    $update_product = array(
		                        'qty' => $product['qty'] + $order_detail['order_pcount'], 
		                    );
		                    $this->db->where('id' , $order_detail['order_pid']);
		                    $this->db->update('product', $update_product); 
		                }
					}else{//歐付寶的有付過錢才需要把庫存加回來
						if ($the_order['order_status']==2) {
							$order_details = $this->db->get_where('order_detail', array('order_id' => $the_order['order_id']))->result_array();
							foreach ($order_details as $key => $order_detail) {
			                    $product = $this->db->get_where('product', array('id' => $order_detail['order_pid']))->row_array(); 
			                    //是否要判斷抓到運費時不用動作??  
			                    $update_product = array(
			                        'qty' => $product['qty'] + $order_detail['order_pcount'], 
			                    );
			                    $this->db->where('id' , $order_detail['order_pid']);
			                    $this->db->update('product', $update_product); 
			                }
						}
					}
				}
			}
		}

		// p($input);
		$this->db->where('id', $this->input->post("id"));
		$this->db->update('order', $input); 

		// 發送紅利&累計購物金
		$this->load->model('user_model');
		$this->user_model->bonus($this->input->post("id"));
		
		flashSuccess('修改資料成功。');

		// 導回原本的頁面
		$panel= $this->input->post("panel");
		$row=select_submenu($panel);
		redirect($row["link"], 'refresh');
	}
	public function modify_detail()
	{
		// 寫入資料庫
		$input = array(
			'order_pname' => $this->input->post('order_pname'), 
			'order_pcount' => $this->input->post('order_pcount'),
			'order_psubtotal' => $this->input->post('order_psubtotal'),
			'updated_at' => date('Y-m-d H:i:s'), 
		);
		$this->db->where('id', $this->input->post("id"));
		$this->db->update('order_detail', $input); 
		
		flashSuccess('修改資料成功。');

		// 導回原本的頁面
		$order_detail =$this->db->get_where('order_detail', array('id' => $this->input->post("id"),))->row_array();
		$order =$this->db->get_where('order', array('order_id' => $order_detail['order_id'],))->row_array();
		$panel= 6;
		$row=select_submenu($panel);
		redirect($row["modifylink"]."&mpanel=".$panel."&id=".$order['id'], 'refresh');
	}

	public function delete_detail() {
		// 寫入資料庫
		$input = array(
			'recover' => 1, 
			'updated_at' => date('Y-m-d H:i:s'), 
		);
		$this->db->where('id', $this->input->get("id"));
		$this->db->update('order_detail', $input); 

		flashSuccess('刪除資料成功。');

		// 導回原本的頁面
		$order_detail =$this->db->get_where('order_detail', array('id' => $this->input->get("id"),))->row_array();
		$order =$this->db->get_where('order', array('order_id' => $order_detail['order_id'],))->row_array();
		$panel= 6;
		$row=select_submenu($panel);
		redirect($row["modifylink"]."&mpanel=".$panel."&id=".$order['id'], 'refresh');
	}




}



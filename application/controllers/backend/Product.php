<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function sort()
	{
		// 抓出需要被排序的資料
		$product = $this->db->get_where('product', 
			array('id' => $this->input->get("id"),)
		)->row_array();
		// p($product);
		// 抓出一起排序的資料
		$products = $this->db->get_where('product', 
			array(
				'panel' => $product['panel'],
				'type' => $product['type'],
				'recover' => $product['recover']
			)
		)->result_array();

		// 處理排序的資料
		$products = arraySort($products, $product, $this->input->get("sort"));

		foreach ($products as $key => $product) {
			$this->db->where('id', $product["id"]);
			$input = array(
					'sort' => $product["sort"],
					'updated_at' => date('Y-m-d H:i:s'),
			);
			$this->db->update('product', $input); 
		}

	}

	public function delete()
	{
		// 寫入資料庫
		$this->db->where('id', $this->input->get("id"));
		$input = array(
				'recover' => 1,
				'updated_at' => date('Y-m-d H:i:s'),
		);
		$this->db->update('product', $input); 
		flashSuccess('刪除資料成功。');

		// 導回原本的頁面
		$panel=$this->input->get("panel");
		$row=select_submenu($panel);
		redirect($row["link"], 'refresh');
	}

	public function insert()
	{
		$price = $this->input->post('price');
		$special_offer = $this->input->post('special_offer');
		if ($price<0) {
			$price = 0;
		}
		if ($special_offer<0) {
			$special_offer = 0;
		}
		// 寫入資料庫
		$input = array(
			'panel' => $this->input->post('panel'), 
			'type' => $this->input->post('type'), 
			'kind' => $this->input->post('kind'), 
			'name' => $this->input->post('name'), 
			'price' => $price,
			'special_offer' => $special_offer,
			'pay_method' => $this->input->post('pay_method'), 
			'transport_method' => $this->input->post('transport_method'), 
			'description' => $this->input->post('description'), 
			'content' => $this->input->post('content'), 
			'qty' => $this->input->post('qty'), 
			'show' => $this->input->post('show'),
			'created_at' => date('Y-m-d H:i:s'), 
		);
		$this->db->insert('product', $input); 
		$insert_last_id = $this->db->insert_id();

		// 更新 SORT
		$articles_count =$this->db->get_where('product', array(
			'panel' => $this->input->post('panel'),
			'type' => $this->input->post('type'),
			'recover' => 0
		))->num_rows();
		$this->db->where('id', $insert_last_id);
		$this->db->update('product', array('sort' => $articles_count, )); 

		// 查詢對應的 IMAGE 資料，更新 IMAGE
		$images = $this->db->get_where('image', array(
			'file_timestamp' => $this->input->post('file_timestamp'),
		))->result_array();
		foreach ($images as $key => $image) {
			$this->db->where('id', $image['id']);
			$this->db->update('image', array('source_id' => $insert_last_id, )); 
		}

		flashSuccess('新增資料成功。');

		// 導回原本的頁面
		$panel= $this->input->post("panel");
		$row=select_submenu($panel);
		redirect($row["link"], 'refresh');
	}

	public function modify()
	{
		$price = $this->input->post('price');
		$special_offer = $this->input->post('special_offer');
		if ($price<0) {
			$price = 0;
		}
		if ($special_offer<0) {
			$special_offer = 0;
		}
		// 寫入資料庫
		$input = array(
			'type' => $this->input->post('type'), 
			'kind' => $this->input->post('kind'), 
			'name' => $this->input->post('name'), 
			'price' => $price,
			'special_offer' => $special_offer,
			'pay_method' => $this->input->post('pay_method'), 
			'transport_method' => $this->input->post('transport_method'), 
			'description' => $this->input->post('description'),
			'content' => $this->input->post('content'), 
			'qty' => $this->input->post('qty'), 
			'show' => $this->input->post('show'),
			'updated_at' => date('Y-m-d H:i:s'),
		);
		$this->db->where('id', $this->input->post("id"));
		$this->db->update('product', $input); 

		// 查詢對應的 IMAGE 資料，更新 IMAGE
		$images = $this->db->get_where('image', array(
			'file_timestamp' => $this->input->post('file_timestamp'),
		))->result_array();
		foreach ($images as $key => $image) {
			$this->db->where('id', $image['id']);
			$this->db->update('image', array('source_id' => $this->input->post("id"), )); 
		}
		
		flashSuccess('修改資料成功。');

		// 導回原本的頁面
		$panel= $this->input->post("panel");
		$row=select_submenu($panel);
		redirect($row["link"], 'refresh');
	}

	public function show()
	{
		$id = $this->input->get("id");
		$show_static = $this->input->get("show_static");
		if($show_static=='open'){
			$show=2;
		}else{
			$show=1;
		}
		$input=array(
			'show' => $show,
			'updated_at' => date('Y-m-d H:i:s'),
		);
		$this->db->where('id', $id);
		$this->db->update('product', $input); 
	}
}



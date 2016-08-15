<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends CI_Controller {
	public function list_update() {
		// AngularJs Post 需要使用這個方式取資料
		$postdata = file_get_contents("php://input");
		$requests = json_decode($postdata);
		// p($requests->data);
		foreach ($requests->data as $key => $request) {
			$input = array();
			$input = array(
				'parent_id' => $request->parent_id, 
				'updated_at' => date('Y-m-d H:i:s'), 
			);

			$this->db->where('id', $request->id);
			$this->db->update('type', $input); 
		}
		flashSuccess('修改資料成功。');
		exit;
	}

	// AJAX LIST 資料
	public function list_json()
	{
		$types = $this->db->order_by('parent_id','asc')->get_where('type', array('recover' => 0, 'panel' => $this->input->get("panel")))->result_array();
		echo json_encode($types);
		exit;
	}

	public function delete()
	{
		// 寫入資料庫
		$this->db->where('id', $this->input->get("id"));
		$input = array(
				'recover' => 1,
				'updated_at' => date('Y-m-d H:i:s'),
		);
		$this->db->update('type', $input); 
		flashSuccess('刪除資料成功。');

		// 導回原本的頁面
		$panel=$this->input->get("panel");
		$row=select_submenu($panel);
		redirect( $row["link"], 'refresh');

	}

	public function insert()
	{
		// 寫入資料庫
		$input = array(
			'name' => $this->input->post('name'), 
			// 'name_en' => $this->input->post('name_en'), 
			'panel' => $this->input->post('panel'), 
			'parent_id' => $this->input->post('parent_id'), 
			'created_at' => date('Y-m-d H:i:s'), 
		);
		$this->db->insert('type', $input); 
		$insert_last_id = $this->db->insert_id();

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
		// 寫入資料庫
		$input = array(
			'name' => $this->input->post('name'), 
			// 'name_en' => $this->input->post('name_en'), 
			'updated_at' => date('Y-m-d H:i:s'), 
		);

		$this->db->where('id', $this->input->post("id"));
		$this->db->update('type', $input); 

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
}



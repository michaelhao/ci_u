<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StaticPage extends CI_Controller {

	public function modify()
	{
		// 寫入資料庫
		$input = array(
			'description' => $this->input->post('description'), 
			'content' => $this->input->post('content'), 
			'field1' => $this->input->post('field1'), 
			'field2' => $this->input->post('field2'), 
			'field3' => $this->input->post('field3'), 
			'field4' => $this->input->post('field4'), 
			'field5' => $this->input->post('field5'), 
			'updated_at' => date('Y-m-d H:i:s'), 
		);
		
		if($this->input->post('show')) {
			$input['show'] = $this->input->post('show');
		}

		$this->db->where('id', $this->input->post("id"));
		$this->db->update('static', $input); 

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



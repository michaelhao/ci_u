<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image extends CI_Controller {

	public function delete()
	{
		// 寫入資料庫
		$this->db->where('id', $this->input->get("id"));
		$input = array(
				'recover' => 1,
				'updated_at' => date('Y-m-d H:i:s'),
		);
		$this->db->update('image', $input); 
		flashSuccess('刪除資料成功。');

		// 導回原本的頁面
			echo '<script>
				window.history.back();
			</script>';
	}

	public function insert()
	{
		// 寫入資料庫
		$input = array(
			'panel' => $this->input->post('panel'), 
			'file_timestamp' => $this->input->post('file_timestamp'), 
			'file_number' => $this->input->post('file_number'), 
			'file_type' => $this->input->post('file_type'), 
			'file_size' => $this->input->post('file_size'), 
			'file_name' => $this->input->post('file_name'), 
			'thumbnailUrl' => $this->input->post('thumbnailUrl'), 
			'deleteUrl' => $this->input->post('deleteUrl'), 
			'url' => $this->input->post('url'), 
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('image', $input); 
	}

	public function modify()
	{	
	}
}



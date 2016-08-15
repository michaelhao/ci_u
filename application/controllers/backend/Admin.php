<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function delete()
	{
		// 寫入資料庫
		$this->db->where('id', $this->input->get("id"));
		$input = array('Recover' => 1 );
		$this->db->update('admintable', $input); 
		flashSuccess('刪除資料成功。');

		// 導回原本的頁面
		$panel=$this->input->get("panel");
		$row=select_submenu($panel);
		redirect($row["link"], 'refresh');

	}

	public function insert()
	{
		// 查詢是否有重複的管理者
		$rowDb = $this->db->get_where('admintable', array('acc' => $this->input->post('acc'), ));
		if($rowDb->num_rows() == 0) {
			// 寫入資料庫
			$input = array(
				'name' => $this->input->post('name'), 
				'acc' => $this->input->post('acc'), 
				'email' => $this->input->post('email'), 
				'pwd' => md5($this->input->post('pwd')), 
				'title' => $this->input->post('title'), 
				'right' => $this->input->post('right'), 
				'time' => $this->input->post('time')
			);
			$this->db->insert('admintable', $input); 
			flashSuccess('新增資料成功。');

			// 導回原本的頁面
			$panel= $this->input->post("panel");
			$row=select_submenu($panel);
			redirect($row["link"], 'refresh');
		} else {
			echo '
			<script>
				alert("帳號重複");
				window.history.back();
			</script>
';
		}
		
	}

	public function modify()
	{
		// 寫入資料庫
		$input = array(
			'name' => $this->input->post('name'), 
			'email' => $this->input->post('email'), 
		);
		if ($this->input->post('pwd')) {
			$input['pwd'] = md5($this->input->post('pwd'));
		}

		if ($this->input->post('title')) {
			$input['title'] = $this->input->post('title');
		}

		if ($this->input->post('right')) {
			$input['right'] = $this->input->post('right');
		}

		$this->db->where('id', $this->input->post("id"));
		$this->db->update('admintable', $input); 
		flashSuccess('修改資料成功。');

		// 導回原本的頁面
		$panel= $this->input->post("panel");
		$row=select_submenu($panel);
		redirect($row["link"], 'refresh');
	}
}



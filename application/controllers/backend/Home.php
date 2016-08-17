<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function modify()
	{
		$panel= $this->input->get("panel");
		$tab= $this->input->get("tab");
		// 修改資料
		$this->db->where('id', $this->input->get("id"));
		switch ($tab) {
			case '1':// 前台頁面設定
				$input = array(
					'webname' => $this->input->post('webname'), 
					'webtitle' => $this->input->post('webtitle'), 
					'keyword' => $this->input->post('keyword'), 
					'description' => $this->input->post('description'), 
					'address' => $this->input->post('address'), 
					'email' => $this->input->post('email'), 
					'tel' => $this->input->post('tel'), 
					'Facebook' => $this->input->post('Facebook'), 
					'Twitter' => $this->input->post('Twitter'), 
					'Google' => $this->input->post('Google'), 
					'copyright' => $this->input->post('copyright'), 
				);
				$this->db->update('backadmin', $input); 
			break;
			default:
			echo "error";
			break;
		}
		flashSuccess('修改資料成功。');

		// 導回原本的頁面
		$row=select_submenu($panel);
		redirect($row["link"], 'refresh');
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	
	public function index()
	{
		// 尚未登入會員會被強制轉址
		$row_login = $this->session->userdata('manage');
		if (empty($row_login)) {
			$this->session->set_userdata('manage', $row);
			$row=select_submenu(1);
			redirect("backend/login");
		}

		// 取得 Panel
		$panel = 1;
		if($this->input->get('panel')) {
			$panel = $this->input->get('panel');
		}
		if($this->input->get('mpanel')) {
			$panel = $this->input->get('mpanel');
		}
		if($this->input->get('ipanel')) {
			$panel = $this->input->get('ipanel');
		}
		if($this->input->get('tpanel')) {
			$panel = $this->input->get('tpanel');
		}
		if($this->input->get('rpanel')) {
			$panel = $this->input->get('rpanel');
		}


		// 登出
		$doLogout = $this->input->get('doLogout');
		if($doLogout) {
			$this->session->unset_userdata('manage');
			redirect("backend/login", 'refresh');
			exit;
		} else {
			// 登入狀態檢視頁面
			$this->load->view('backend/index');	
		}


		// 若使用者沒權限不可登入
		$backmainmenu = $this->db->get_where('backmainmenu', array('id' => $panel))->row_array();
		if(($row_login['title'] == 1 && $backmainmenu["admintype1_permission"] == 0 ) || 
		   ($row_login['title'] == 2 && $backmainmenu["admintype2_permission"] == 0 ) || 
		   ($row_login['title'] == 3 && $backmainmenu["admintype3_permission"] == 0 )) {

			//抓取有權限登入的第一個頁面
			if ($row_login['title'] == 1) {
				$redirect_page = $this->db->get_where('backmainmenu', array('admintype1_permission'=>1))->row_array();
			}elseif ($row_login['title'] == 2) {
				$redirect_page = $this->db->get_where('backmainmenu', array('admintype2_permission'=>1))->row_array();
			}elseif ($row_login['title'] == 3) {
				$redirect_page = $this->db->get_where('backmainmenu', array('admintype3_permission'=>1))->row_array();
			}


            redirect("backend/page?panel=".$redirect_page['id']);


		}

		
	}
}

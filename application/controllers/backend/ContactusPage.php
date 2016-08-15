<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once './vendor/autoload.php';

class ContactusPage extends CI_Controller {
	public $mail;

    public function __construct()
    {
        parent::__construct();
        // 會員登入
        $this->mail = new PHPMailer;
    }

    public function get_config() {
    	$configs = $this->db->get('config')->result_array();;
    	foreach ($configs as $key => $value) {
    		$config[$value['setting']] = $value['value'];
    	}
    	return $config;
    }

	public function modify()
	{
		// 產生 Mailer 實體
		$config = $this->get_config();
		$backadmin = $this->db->get_where('backadmin')->row_array();
		// 取得 POST 資料
		$email = $this->input->post("smtp_username");
		$name = $backadmin['webname'];

		$this->mail->IsSMTP();
		$this->mail->SMTPAuth = true;
		$this->mail->Host = $this->input->post("smtp_host");
		$this->mail->Port = $this->input->post("smtp_port");
		$this->mail->SMTPSecure = $config['smtp_security'];
		$this->mail->Username = $this->input->post("smtp_username");
		$this->mail->Password = $this->input->post("smtp_password");
		$this->mail->SetFrom($this->input->post("smtp_username"), $backadmin['webname']); 
		$this->mail->Subject = $name."寄信功能測試";

		$txt = "寄信功能正常";
		$this->mail->AddAddress($email, $name);
		$this->mail->MsgHTML($txt);
		$this->mail->CharSet = "UTF-8";

		if ($this->mail->Send())
		{ 
			// 郵件寄出
			flashSuccess('修改資料成功。');

			// 寫入資料庫
			$this->db->where('setting', 'smtp_host');
			$this->db->update('config', array('value' => $this->input->post("smtp_host"),)); 
			$this->db->where('setting', 'smtp_port');
			$this->db->update('config', array('value' => $this->input->post("smtp_port"),)); 
			$this->db->where('setting', 'smtp_username');
			$this->db->update('config', array('value' => $this->input->post("smtp_username"),)); 
			$this->db->where('setting', 'smtp_password');
			$this->db->update('config', array('value' => $this->input->post("smtp_password"),)); 
			$this->db->where('setting', 'site_name');
			$this->db->update('config', array('value' => $this->input->post("site_name"),)); 
		}
	  	else
		{
			flashError($this->mail->ErrorInfo);
		}

		// 導回原本的頁面
		$panel= $this->input->post("panel");
		$row=select_submenu($panel);
		redirect($row["link"], 'refresh');
	}
}



<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once './vendor/autoload.php';
class Edm extends CI_Controller {

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
		// 寫入資料庫
		if($this->input->post('field2')) {
			$field2 = implode(',', $this->input->post('field2'));
		} else {
			$field2 = null;
		}

		$input = array(
			'content' => $this->input->post('content'), // 內容
			'field1' => $this->input->post('field1'), // 主旨
			'field2' => $field2, // 收件人
			'updated_at' => date('Y-m-d H:i:s'), 
		);
		
		if($this->input->post('show')) {
			$input['show'] = $this->input->post('show');
		}

		$this->db->where('id', $this->input->post("id"));
		$this->db->update('static', $input); 
		
		flashSuccess('修改資料成功。');

		// 導回原本的頁面
		$panel= $this->input->post("panel");
		$row=select_submenu($panel);
		redirect($row["link"], 'refresh');
	}

	public function send_email() {
		// 抓取已選取的使用者
		$row=$this->db->get_where('static', array('id' => 5))->row_array();

		// 當是有選擇使用者的情況下
		if($row['field2'] != '') {
			$checkboxs = explode(',', $row['field2']);

			if(in_array(0, $checkboxs)) {
				// 選取所有使用者
				$users=$this->db->get_where('users', 
					array(
						'isactive' => 1,
						'email !=' => '',
					)
				)->result_array();
			} else {
				// 選取部分使用者
				$users=$this->db->where_in('id',$checkboxs)->get_where('users', 
					array(
						'isactive' => 1,
						'email !=' => '',
					)
				)->result_array();
			}

			// 使用者
			foreach ($users as $key => $user) {
				// 產生 Mailer 實體
				$config = $this->get_config();
				$backadmin = $this->db->get_where('backadmin')->row_array();
				// 取得 POST 資料
				$email = $config['smtp_username'];
				$name = $backadmin['webname'];

				$this->mail->IsSMTP();
				$this->mail->SMTPAuth = true;
				$this->mail->Host = $config['smtp_host'];
				$this->mail->Port = $config['smtp_port'];
				$this->mail->SMTPSecure = $config['smtp_security'];
				$this->mail->Username = $config['smtp_username'];
				$this->mail->Password = $config['smtp_password'];
				$this->mail->SetFrom($config['smtp_username'], $backadmin['webname']); 

				$this->mail->Subject = $row['field1'];

				$txt = $row['content'];
				$this->mail->AddAddress($user['email'], $user['name']);
				$this->mail->MsgHTML($txt);
				$this->mail->CharSet = "UTF-8";

				if ($this->mail->Send())
				{ // 郵件寄出
					// echo $email . " 已收到信件！<br/>";
				}
			  	else
				{
					// echo $this->mail->ErrorInfo . "<br/>";
				}

				$this->mail->ClearAllRecipients( );
			}
		}
		
		flashSuccess('信件已寄出。');

		// 導回原本的頁面
		$panel= $this->input->get("panel");
		$row=select_submenu($panel);
		redirect($row["link"], 'refresh');
	}
}



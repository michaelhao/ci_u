<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// 使用 Composer
include_once './vendor/autoload.php';

class Service extends CI_Controller {

	public function modify()
	{
		// 寫入資料庫
		$input = array(
			'content2' => $this->input->post('content2'), //客服留言
			'update' => $this->input->post('update'),  //更新者
			'updated_at' => date('Y-m-d H:i:s'),   //更新時間
		);
		$this->db->where('id', $this->input->post("id"));
		$this->db->update('services', $input); 
		
	    $service = $this->db->get_where('services', array(
	      'id' => $this->input->post("id")
	    ))->row_array();

	    // 寄送信件內容
		$this->send_email($service);

		flashSuccess('修改資料成功。');

		// 導回原本的頁面
		$panel= $this->input->post("panel");
		$row=select_submenu($panel);
		redirect($row["link"], 'refresh');
	}

	public function send_email($service) {
		// 寄送信件
		$user = $this->db->get_where('users', array(
		  'id' => $service['user_id'], 
		))->row_array();
		// 產生 Mailer 實體
		$config = $this->get_config();
		$backadmin = $this->db->get_where('backadmin')->row_array();
		// 取得 POST 資料
		$admin_email = $config['smtp_username'];
		$name = $backadmin['webname'];
		$this->mail = new PHPMailer;
		$this->mail->IsSMTP();
		$this->mail->SMTPAuth = true;
		$this->mail->Host = $config['smtp_host'];
		$this->mail->Port = $config['smtp_port'];
		$this->mail->SMTPSecure = $config['smtp_security'];
		$this->mail->Username = $config['smtp_username'];
		$this->mail->Password = $config['smtp_password'];
		$this->mail->SetFrom($config['smtp_username'], $backadmin['webname']); 

		// 選擇主旨
		if($service['type'] == 1) {
			$this->mail->Subject = $backadmin['webname']."產品問與答回覆";
		} else {
			$this->mail->Subject = $backadmin['webname']."會員悄悄話回覆";
		}

		$txt = "親愛的 " . $user['name'] . " 先生/小姐 您好：" .
				"<br><br>客服人員已針對您的留言做出以下回覆：".
				"<br>".$service['content2'].
				"<br><br><br>若有進一步問題，請至 ".base_url()." 與我們聯繫。";
		// ADD 管理者
		$this->mail->AddAddress($admin_email, $name);
		// ADD 使用者
		$this->mail->AddAddress($user['email'], $user['name']);
		$this->mail->MsgHTML($txt);
		$this->mail->CharSet = "UTF-8";

		if ($this->mail->Send())
		{ // 郵件寄出
			// echo $admin_email . " 已收到信件！<br/>";
		}
	  	else
		{
			// echo $this->mail->ErrorInfo . "<br/>";
		}
	}

    public function get_config() {
    	$configs = $this->db->get('config')->result_array();
    	foreach ($configs as $key => $value) {
    		$config[$value['setting']] = $value['value'];
    	}
    	return $config;
    }
}



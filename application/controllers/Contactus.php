<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once './vendor/autoload.php';

class Contactus extends CI_Controller {

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

    // 新增留言
    public function add() 
    {
    	if(!$this->input->post('name') || !$this->input->post('email')) {
    		show_error('欄位不足');
    	}
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

		$this->mail->Subject = $backadmin['webname']."留言訊息";

		$txt = "姓名:" . $this->input->post('name') . 
				"<br>聯絡電話：" . $this->input->post('tel') . 
				"<br>Email：" . $this->input->post('email') . 
				"<br>訊息：" . $this->input->post('content');
		$this->mail->AddAddress($email, $name);
		$this->mail->MsgHTML($txt);
		$this->mail->CharSet = "UTF-8";

		if ($this->mail->Send())
		{ // 郵件寄出
			echo $email . " 已收到信件！<br/>";
		}
	  	else
		{
			echo $this->mail->ErrorInfo . "<br/>";
		}
    }

    // 商品問與答.會員悄悄話
    public function service() {
    	if(!$this->input->post('content')) {
    		show_error('欄位不足');
    	}

		$user_data = $this->session->userdata('user');
		if($user_data) {
			$user = $this->db->get_where('users', array(
			  'email' => $user_data['email'], 
			))->row_array();

	    	$input = array(
	    		'type' => $this->input->post('type'), // 1.商品問與答 2.會員悄悄話
	    		'product_id' => $this->input->post('product_id'), 
	    		'user_id' => $user['id'], 
	    		'title' => $this->input->post('title'), 
	    		'content' => $this->input->post('content'), 
	    		'created_at' => date('Y-m-d H:i:s'), 
	    	);

	    	$this->db->insert('services', $input); 

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

			if($this->input->post('type') == 1) {
				$this->mail->Subject = $backadmin['webname']."商品問與答";
				$txt = "親愛的 " . $user['name'] . " 先生/小姐，我們已經收到您對 ".$this->input->post('title')." 留言" .
						"<br><br>留言：" . $this->input->post('content');
			} else {
				$this->mail->Subject = $backadmin['webname']."會員悄悄話";
				$txt = "親愛的 " . $user['name'] . " 先生/小姐，我們已經收到您的留言:".
						"<br><br>主旨：" . $this->input->post('title') . 
						"<br>留言：" . $this->input->post('content');
			}

			// ADD 管理者
			$this->mail->AddAddress($email, $name);
			// ADD 使用者
			$this->mail->AddAddress($user_data['email'], $user['name']);
			$this->mail->MsgHTML($txt);
			$this->mail->CharSet = "UTF-8";

			if ($this->mail->Send())
			{ // 郵件寄出
				echo $email . " 已收到信件！<br/>";
			}
		  	else
			{
				echo $this->mail->ErrorInfo . "<br/>";
			}
		}
    }
}


?>



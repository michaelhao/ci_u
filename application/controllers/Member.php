<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// 使用 Composer
include_once './vendor/autoload.php';

class Member extends CI_Controller {

  public $auth_config;
  public $auth;

    public function __construct()
    {
        parent::__construct();
    $dbh = new PDO("mysql:host=".$this->db->hostname.";dbname=".$this->db->database.";charset=utf8", "".$this->db->username."", "".$this->db->password."");
    $this->auth_config = new PHPAuth\Config($dbh);
    $this->auth   = new PHPAuth\Auth($dbh, $this->auth_config, "zh_TW");
    $this->mail = new PHPMailer;
    }

    // 需要重寫
    public function validation_login () {
      // echo json_encode($this->auth->isLogged());exit;
    }

    public function get_config() {
      $configs = $this->db->get('config')->result_array();;
      foreach ($configs as $key => $value) {
        $config[$value['setting']] = $value['value'];
      }
      return $config;
    }

  // 註冊資料
  public function register () {
    
    $phone = $this->input->post('phone');
    $account = $this->input->post('account');
    if ($account==null) {
      $account=$phone;
    }
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    $repeatpassword = $this->input->post('repeatpassword');
    $message = $this->auth->register($account, $password, $repeatpassword);
    if($message['error'] == false) {
      $update = array(
        'register_from' => 0,//分店id 線上註冊為0
        'email' => $email,
        'name' => $this->input->post('name'),
        'phone' => $phone,
        'identity' => $this->input->post('identity'),
        'birthday' => $this->input->post('birthday'),
        'address' => $this->input->post('address'),
        'dt' => date("Y-m-d H:i:s"),
      );
      $this->db->where('account', $account);
      $this->db->update('users', $update);
      // 有 EMAIL 的時候寄信
      if($email) {
        $this->register_email($phone);
      }
    }
    echo json_encode($message);exit;
  }

  // 實體介面註冊
  public function custom_register () {
        $account = $this->db->get_where('store_account' , 
            array('token' => $this->input->post('token')
        ))->row_array();

        // 預設實體介面申請的會員帳號密碼為手機
    $acc = $this->input->post('phone');
    $email = $this->input->post('email');
    $password = $this->input->post('phone');
    $repeatpassword = $this->input->post('phone');
    $message['error'] = false;
    $message['message'] = '';
    
        // 若無取到對應分店資訊
        if(empty($account) || !$this->input->post('token')) {
          $message['error'] = true;
          $message['code'] = 101;
          $message['message'] = "登入失效，請重新登入會員後台系統";
        }

        // 手機長度不夠
        if(strlen($acc) < 9) {
          $message['error'] = true;
          $message['message'] = "手機號碼有誤";
        }

        // 註冊會員
        if($message['error'] == false) {
      $message = $this->auth->register($acc, $password, $repeatpassword);
    }

    if($message['error'] == false) {
      $update = array(
        'register_from' => $account['store'],
        'phone' => $this->input->post('phone'),
        'name' => $this->input->post('name'),
        'email' => $email,
        'identity' => $this->input->post('identity'),
        'birthday' => $this->input->post('birthday'),
        'address' => $this->input->post('address'),
        'dt' => date("Y-m-d H:i:s"),
      );
      $this->db->where('account', $acc);
      $this->db->update('users', $update);

      // 有 EMAIL 的時候寄信
      if($email) {
        $this->register_email($acc);
      }
    }
    
    echo json_encode($message);exit;
  }

  public function register_email($account) {
      $user = $this->db->get_where('users', array(
        'account' => $account, 
      ))->row_array();
      // 產生 Mailer 實體
      $config = $this->get_config();
      $backadmin = $this->db->get_where('backadmin')->row_array();
      // 取得 POST 資料
      $admin_email = $config['smtp_username'];
      $name = $backadmin['webname'];

      $this->mail->IsSMTP();
      $this->mail->SMTPAuth = true;
      $this->mail->Host = $config['smtp_host'];
      $this->mail->Port = $config['smtp_port'];
      $this->mail->SMTPSecure = $config['smtp_security'];
      $this->mail->Username = $config['smtp_username'];
      $this->mail->Password = $config['smtp_password'];
      $this->mail->SetFrom($config['smtp_username'], $backadmin['webname']); 

      $this->mail->Subject = $backadmin['webname']."會員註冊成功";

      $txt = "親愛的 " . $user['name'] . " 先生/小姐 您好：" .
          "<br>感謝您加入".$backadmin['webname']."會員，讓我們有機會為您提供最完整貼心的服務！" .
          "<br>您的會員帳號 : " . $user['account'];
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

  // 登入會員
  public function login () {
    $phone = $this->input->post('phone');
    $account = $this->input->post('account');
    if ($account==null) {
      $account=$phone;
    }
    $password = $this->input->post('password');
    $message = $this->auth->login($account, $password);
    $message['account'] = $account;
    $message['bir_gift']=false;
    if(!$message['error']) {
      $this->session->set_userdata('user', $message);
      $user=$this->db->get_where('users', array('account'=>$account))->row_array();
      if ($user['bir_gift']==1) {
        $message['bir_gift']=true;
        $message['bir_msg']="本月壽星您好，歡迎前往門市領取生日禮！";
      }
    }
    echo json_encode($message);exit;
  }

  // 忘記密碼
  public function request_reset () {
    $account = $this->input->post('account');
    $user = $this->db->get_where('users', array('account'=>$account))->row_array();
    // $email = $this->input->post('email');
    $message = $this->auth->requestReset($user['email'], true);
    echo json_encode($message);exit;
  }
  // 重新設定密碼(忘記密碼)
  public function reset_password () {
    $key = $this->input->post('key');
    $password = $this->input->post('password');
    $repeatpassword = $this->input->post('repeatpassword');
    $message = $this->auth->resetPass($key, $password, $repeatpassword);
    echo json_encode($message);exit;
  }

  // 修改使用者資料
  public function reset_userData(){
    $user_data = $this->session->userdata('user');
    $account = $user_data['account'];
    $update = array(
      'name' => $this->input->post('name'),
      'email' => $this->input->post('email'),
      'birthday' => $this->input->post('birthday'),
      'identity' => $this->input->post('socialID'),
      'phone' => $this->input->post('phone'),
      'address' => $this->input->post('address'),
    );
    $this->db->where('account', $account);
    $this->db->update('users', $update);
    echo "update success.";exit;
  }

  // 登出會員
  public function logout() {
    $user = $this->session->userdata('user');
    $this->auth->logout($user['hash']);
    $this->session->unset_userdata('user');
  }


  // 開通會員( G2F 暫時不用)
  public function activate_account () {
  }

  // 重新寄送會員開通( G2F 暫時不用)
  public function resend_activation_email () {
  }

  // 改變密碼
  public function change_password () {
    $user_data = $this->session->userdata('user');
    $account = $user_data['account'];
    $user=$this->db->get_where('users', array('account'=>$account))->row_array();
    
    $uid = $user['id'];
    $currpass = $this->input->post('old_password');
    $newpass = $this->input->post('new_password');
    $repeatnewpass = $this->input->post('repeat_np');
    
    $message = $this->auth->changePassword($uid, $currpass, $newpass, $repeatnewpass);
    echo json_encode($message);exit;
  }

  // 改變 Email 信箱( G2F 暫時不用)
  public function change_email_address () {
  }

  // 刪除帳號( G2F 暫時不用)
  public function delete_account () {
  }

}


?>



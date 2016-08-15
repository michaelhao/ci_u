<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once './vendor/autoload.php';

class User extends CI_Controller {

	public $auth_config;
	public $auth;

    public function __construct()
    {
        parent::__construct();
		$dbh = new PDO("mysql:host=".$this->db->hostname.";dbname=".$this->db->database.";charset=utf8", "".$this->db->username."", "".$this->db->password."");
		$this->auth_config = new PHPAuth\Config($dbh);
		$this->auth   = new PHPAuth\Auth($dbh, $this->auth_config, "zh_TW");
    }

	public function modify()
	{
		$bonus=$this->input->post('bonus');
		$gold=$this->input->post('gold');
		if ($this->input->post('member_level')==1) {
			$user=$this->db->get_where('users', array('id' => $this->input->post("id")))->row_array();
			if ($user['member_level']==0) {//原本是一般會員-升級要給購物金
				$gold = $gold + getGold();
			}
		}
		$password=$this->input->post('password');
		if ($password=='') {
			$input = array(
				'account' => $this->input->post('account'), 
				'phone' => $this->input->post('phone'), 
				'email' => $this->input->post('email'),
				'name' => $this->input->post('name'), 
				'address' => $this->input->post('address'),
				'identity' => $this->input->post('identity'),
				'birthday' => $this->input->post('birthday'),
				'member_level' => $this->input->post('member_level'), 
				'gold' => $gold, 
				'bonus' => $bonus,
				'updated_at' => date('Y-m-d H:i:s'), 
			);
		}else{
			$password = $this->auth->getHash($password);
			$input = array(
				'account' => $this->input->post('account'), 
				'phone' => $this->input->post('phone'), 
				'password' => $password, 
				'email' => $this->input->post('email'), 
				'name' => $this->input->post('name'), 
				'address' => $this->input->post('address'), 
				'identity' => $this->input->post('identity'),
				'birthday' => $this->input->post('birthday'),
				'member_level' => $this->input->post('member_level'), 
				'gold' => $gold, 
				'bonus' => $bonus,
				'updated_at' => date('Y-m-d H:i:s'), 
			);
		}
		// 寫入資料庫
		
		$this->db->where('id', $this->input->post("id"));
		$this->db->update('users', $input); 

		flashSuccess('修改資料成功。');
		// 導回原本的頁面
		$panel= $this->input->post("panel");
		$row=select_submenu($panel);
		redirect($row["link"], 'refresh');
	}

	public function show()
	{
		$id = $this->input->get("id");
		$show_static = $this->input->get("show_static");
		if($show_static=='open'){
			$show=2;
		}else{
			$show=1;
		}
		$input=array(
			'isactive' => $show,
		);
		$this->db->where('id', $id);
		$this->db->update('users', $input); 
	}

	public function verify(){//黃金會員(發購物金)審核
		$id = $this->input->get("id");
		$this->check_number($id);
	}
	public function verifyAll(){//一鍵升級黃金會員(發購物金)
		$users = $this->db->get_where('users', array('verify' => 1, 'isactive' => 1))->result_array();
		foreach ($users as $key => $user) {
			$this->check_number($user['id']);
		}

		flashSuccess('升級會員成功。');
		// 導回原本的頁面
		$panel= $this->input->get("panel");
		$row=select_submenu($panel);
		redirect($row["link"], 'refresh');

	}

	public function check_number($id){
		$user=$this->db->get_where('users', array('id'=>$id))->row_array();
		$orders=$this->db->get_where('order', array('order_uid'=>$id, 'status'=>2))->result_array();
		$totalmoney=0;
		foreach ($orders as $key => $order) {
			$totalmoney=$totalmoney+$order['order_total'];
		}
		$verify_number=$totalmoney/verifyEnougth();//應該進審核幾次
		do{
			$user['verify_number']=$user['verify_number']+1;
			$user['gold']=$user['gold']+getGold();
		}while ((int)$verify_number > $user['verify_number']);
		
		$input=array(
			'member_level' => 1,//升級黃金會員
			'verify' => 0,//離開審核區
			'gold' => $user['gold'],//贈送購物金
			'verify_number' => $user['verify_number']
		);
		$this->db->where('id', $id);
		$this->db->update('users', $input); 
		
	}

	public function bir_gift(){
		$input = array(
			'bir_gift' => $this->input->post("bir_gift"),
		);
		$this->db->where('id', $this->input->post("id"));
		$this->db->update('users', $input); 
		
		flashSuccess('修改資料成功。');
		// 導回原本的頁面
		$panel= $this->input->post("panel");
		$row=select_submenu($panel);
		redirect($row["link"], 'refresh');
	}

}



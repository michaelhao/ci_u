<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Birthday extends CI_Controller {

	public function check(){
		$thisMouth=date("m");
		$users = $this->db->get_where('users', array('member_level'=>1 , 'isactive'=>1))->result_array();
		foreach ($users as $key => $user) {
			if ($thisMouth==date("m", strtotime($user['birthday']))) {
				$this->db->where('id', $user['id']);
				$this->db->update('users', array('bir_gift'=>1)); 
			}else {
				$this->db->where('id', $user['id']);
				$this->db->update('users', array('bir_gift'=>0)); 
			}
		}
	}

}

?>
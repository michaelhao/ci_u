<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Storeaccount
{
    public $store_account = array();
    public $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function accountList(){
        $array = array(
            'id' => "0-0",
            'name' => "網路下單"
        );
        array_push($this->store_account, $array);
        $stores=$this->ci->db->get_where('store', array('recover'=>0))->result_array();
        foreach ($stores as $key => $store) {
            $this->TOarray($store['id']."-0", $store['name']);
            // $clerks=$this->ci->db->get_where('store_account', array('recover'=>0, 'store'=>$store['id']))->result_array();
            // foreach ($clerks as $key => $clerk) {
            //     $this->TOarray($clerk['store']."-".$clerk['id'], " -- ".$clerk['name']);
            // }    
        }
        return $this->store_account;
    }
    
    public function TOarray($id, $name){
        $array = array(
            'id' => $id,
            'name' => $name
        );
        array_push($this->store_account, $array);
    }

}

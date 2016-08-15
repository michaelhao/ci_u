<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// 使用 Composer
include_once './vendor/autoload.php';

class Cart extends CI_Controller {

	public $config;
	public $auth;

    public function __construct()
    {
        parent::__construct();
        // 會員登入
		// $dbh = new PDO("mysql:host=".$this->db->hostname.";dbname=".$this->db->database."", "".$this->db->username."", "".$this->db->password."");
		// $this->config = new PHPAuth\Config($dbh);
		// $this->auth   = new PHPAuth\Auth($dbh, $this->config, "zh_TW");

		// 購物車
		$this->load->library('cart');
    }

	// 加入購物車(新增單筆)
	public function add () {
		$id = $this->input->post('id');
		if($this->input->post('qty')) {
			$qty = $this->input->post('qty');
		} else {
			$qty = 1;
		}
		$product = $this->db->get_where('product', array('id' => $id,))->row_array();
		// 抓取主圖
		$image = $this->db->get_where('image', array('panel' => $product['panel'], 'source_id' => $id, 'file_number' => 0, 'recover' => 0))->row_array();
		$image_url = base_url('assert/files/files/'.$image['file_name']);
		$type = $this->db->get_where('type', array('id' => $product['type']))->row_array();

		$data = array(
               'id'      => $id,
               'qty'     => $qty,
               'price'   => $product['special_offer'],
               'name'    => $product['name'],
               'options' => array(
               		'price'=> $product['price'],
               		'image'=> $image_url,
               		'pay_method'=> $product['pay_method'],
               		'transport_method'=> $product['transport_method'],
               		'type'=> $type['name'],
               		'limit'=> $product['qty'],)
        );
		$this->cart->insert($data);
		echo json_encode($this->cart->contents());exit;
	}

	// 更新購物車
	public function update () {
		$this->cart->update($input = $this->input->post());
		echo json_encode($this->cart->contents());exit;
	}

	// 更新購物車
	public function update_list () {
		$input = json_decode(file_get_contents('php://input'), true);
		foreach ($input['data'] as $key => $value) {
			// echo json_encode($value);exit;
			$this->cart->update(array('rowid' => $value['rowid'], 'qty' => $value['qty'], ));	
		}
		// echo json_encode($input);exit;
	}

	// 抓取購物車資訊
	public function items() {
		echo json_encode($this->cart->contents());
		exit;
	}

	// 抓取購物車資訊
	public function total() {
		echo json_encode($this->cart->total());
		exit;
	}

	// 抓取購物車資訊
	public function total_items() {
		echo json_encode($this->cart->total_items());
		exit;
	}	

	public function destroy() {
		echo json_encode($this->cart->destroy());
		exit;
	}

	// 免運及運費資訊
	public function free_shipment(){
		$free_ship=$this->db->get_where('backadmin', array('id'=>1))->row_array();
		echo json_encode(array('discount_money' => $free_ship['discount_money'], 'discount_shipment' => $free_ship['discount_shipment'], 'shipment' => $free_ship['shipment'],));
	}

}


?>



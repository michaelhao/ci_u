<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// 使用 Composer
include_once './vendor/autoload.php';

class Site extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
		$this->load->library('cart');
		$this->load->library('image');
    }

    // 取得 EMAIL 設定
    public function get_config() {
    	$configs = $this->db->get('config')->result_array();;
    	foreach ($configs as $key => $value) {
    		$config[$value['setting']] = $value['value'];
    	}
    	return $config;
    }

    public function machineinfo() {
    	if(ENVIRONMENT == "development") {
    		echo phpinfo();
    	}
    }

    // 首頁
	public function index()
	{
		$this->load->view('site/index');
	}
	/* --------------------------
		關於我們
	 --------------------------	*/
	public function about()
	{
		$about=$this->db->get_where('static', array(
			'id' => 2,
			))->row_array();
		$this->load->view('site/about',array('about'=>$about));
	}
	/* --------------------------
		聯絡我們
	 --------------------------	*/
	public function contacts()
	{
		$this->load->view('site/contacts');
	}
	/* --------------------------
		常見問題
	 --------------------------	*/
	public function faq()
	{
		$faq=$this->db->get_where('static', array(
			'id' => 10,
			))->row_array();
		$this->load->view('site/faq',array('faq'=>$faq));
	}
	/* --------------------------
		最新消息
	 --------------------------	*/
	public function news()
	{
		// 每頁抓取資料數
		$count = 4;

		// 取得當下頁數
		$index = 0;
		if($this->input->get('per_page')) {
			$index = $this->input->get('per_page');
		}

		// 抓出全部資料
		$datas = $this->db->get_where('article', array(
		    'Recover' => 0, 
		    'panel' => 9,
		    'show' => 1
		))->result_array();
		$config = $this->get_pagination_config(site_url('site/news'), count($datas),$count);

		// 抓出塞選資料
		$news = $this->db->order_by('start_at','desc')->get_where('article', array(
		    'Recover' => 0, 
		    'panel' => 9,
		    'show' => 1
		), $config['per_page'], $index)->result_array();

		// 抓取圖片
    	$news = $this->image->getImage($news);

		$data['news'] = $news;
		$this->load->view('site/news', $data);
	}
	/* --------------------------
		操作說明
	 --------------------------	*/
	public function option()
	{
		// 抓出全部資料
		$datas = $this->db->get_where('article', array(
		    'Recover' => 0, 
		    'panel' => 16,
		    'show' => 1
		))->result_array();

		// 抓出塞選資料
		$news = $this->db->order_by('start_at','desc')->get_where('article', array(
		    'Recover' => 0, 
		    'panel' => 16,
		    'show' => 1
		))->result_array();

		// 抓取圖片
    	$news = $this->image->getImage($news);

		$data['news'] = $news;
		$this->load->view('site/option', $data);
	}
	/* --------------------------
		產品
	 --------------------------	*/
	public function products()
	{
		$input = array();
		$id = $this->input->get('id');
		// p($id);
		// 抓出單筆資料
		$products = $this->db->get_where('store', array(
		    'Recover' => 0, 
		    'panel' => 12,
		    'id' => $id,
		))->result_array();
		// p($products);
		$products = $this->image->getImage($products);

		$input['products'] = $products;

		$this->load->view('site/products',$input);
	}

	/* --------------------------
		商品介紹
	 --------------------------	*/
	public function store()
	{
		// 抓出全部資料
		$stores = $this->db->order_by('sort','desc')->get_where('store', array(
		    'Recover' => 0, 
		    'show' => 1,
		))->result_array();

		// 抓取圖片
    	$stores = $this->image->getImage($stores);
		$data['stores'] = $stores;
		$this->load->view('site/store', $data);
	}

	/* --------------------------
		分頁功能
	 --------------------------	*/
	public function get_pagination_config($url, $total_rows, $per_page){
		$this->load->library('pagination');
		$config['base_url'] = $url;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page; 
		// $config['use_page_numbers'] = TRUE;
		$config['display_pages'] = TRUE; //隱藏頁數
		$config['num_links'] = 2;
		$config['page_query_string'] = TRUE;
		 
        $config['first_link']      = '&laquo;'; //自訂開始分頁連結名稱
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        
        $config['last_link']      = '&raquo;'; //自訂結束分頁連結名稱
        $config['last_tag_open']  = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link']    = 'Next';
   		$config['next_tag_open'] = '<li class="next_style">'; //自訂下一頁標籤
   		$config['next_tag_close'] = '</li>';
        
        $config['prev_link']      = 'Last';
        $config['prev_tag_open'] = '<li class="last_style">';
    	$config['prev_tag_close'] = '</li>';
        $config['cur_tag_open']   = '<li class="active"><a>';
        $config['cur_tag_close']  = '</a></li>';
        $config['num_tag_open']   = '<li>';
        $config['num_tag_close']  = '</li>';
		$this->pagination->initialize($config); 
		return $config;
	}

    public function main_call_detail($maintype_id){
    	$detail_type= array();
    	$minor=$this->db->get_where('type', array(
    		'panel' => 3,
    		'recover' => 0,
    		'parent_id' => $maintype_id,
    	))->result_array();
    	if ($minor==null) {
    		array_push($detail_type, $maintype_id); 
    	}else{
    		foreach ($minor as $key => $value) {
	    		$detail=$this->db->get_where('type', array(
		    		'panel' => 3,
		    		'recover' => 0,
		    		'parent_id' => $value['id'],
		    	))->result_array();
		    	if ($detail==null) {
		    		array_push($detail_type, $maintype_id);
		    	}else{
		    		foreach ($detail as $key => $value2) {
		    		array_push($detail_type, $value2['id']);
		    		}
		    	}
		    	
	    	}
    	}
    	return $detail_type;
    }
}

?>



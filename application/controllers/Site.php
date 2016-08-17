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
	public function products2()
	{
		$this->load->view('site/products2');
	}

	/* --------------------------
		產品
	 --------------------------	*/
	public function shop()
	{
		$index = 0;
        if ($this->input->get('per_page')) {
            $index = $this->input->get('per_page');
        }
        // 取得 TYPE ID		
        $types = $this->db->get_where('type', array(
            'parent_id' => 1,
            'recover' => 0
        ))->result_array();
        
        if ($types) {
            if ($this->input->get('type')) {
            	$type = $this->input->get('type');
                $query_array = array(
                    'type' => $this->input->get('type'),
                    'recover' => 0,
                    'show' => 1,
                );
            } else {
            	$type = '';
                $query_array = array(
                    'recover' => 0,
                    'show' => 1,
                );
            }
        }
        
        // 抓出全部資料
        $datas  = $this->db->where_in('kind', array(1,3))->get_where('product', $query_array)->result_array();
        $config = $this->get_pagination_config(site_url('site/shop')."?type=".$type, count($datas), 6);
        
        // 抓出分頁資料
        $products = $this->db->order_by('sort', 'desc')->where_in('kind', array(1,3))->get_where('product', $query_array, $config['per_page'], $index)->result_array();
        
        foreach ($products as $key => $product) {
            $product_image         = $this->db->get_where('image', array(
                'source_id' => $product['id'],
                'panel' => $product['panel'],
                'file_number' => 0,
                'recover' => 0
            ))->row_array();
            $products[$key]['pic'] = $product_image['url'];
            
            // 取得類別
            $producttype                = $this->db->get_where('type', array(
                'id' => $product['type']
            ))->row_array();
            $products[$key]['type_str'] = $producttype['name'];
        }
        
        $data['types']    = $types;
        $data['products'] = $products;
        $this->load->view('site/shop', $data);
	}

	public function shop_detail()
	{
		$this->db->where('id', $this->input->get('id'));//瀏覽人數+1
		$this->db->set('visitor', '`visitor`+ 1', FALSE);
		$this->db->update('product');
		$this->load->view('site/shop_detail');			
	}

	/* --------------------------
		媒體報導
	 --------------------------	*/
	public function blog()
	{
		// 每頁抓取資料數
		$count = 1;

		// 取得當下頁數
		$index = 0;
		if($this->input->get('per_page')) {
			$index = $this->input->get('per_page');
		}

		// 抓出媒體報導類別
		$types=$this->db->get_where('type', array('parent_id' => 2, 'recover' => 0,  ))->result_array();
		$data['types'] = $types;

		// 取得類別
		if($this->input->get('type')) {
			$type = $this->input->get('type');
		} else {
			// 若無類別資料類別預設0
			if(empty($types)) {
				$type = 0;
			} else {
				$type = $types[0]['id'];
			}
		}

		// 抓出全部資料
		$datas = $this->db->get_where('article', array(
		    'Recover' => 0, 
		    'panel' => 4,
		    'show' => 1,
		    'type' => $type
		))->result_array();
		$config = $this->get_pagination_config(site_url('site/blog')."?type=".$type, count($datas),$count);

		// 抓出塞選資料
		$blogs = $this->db->order_by('start_at','desc')->get_where('article', array(
		    'Recover' => 0, 
		    'panel' => 4,
		    'show' => 1,
		    'type' => $type
		), $config['per_page'], $index)->result_array();

		// 抓取圖片
    	$blogs = $this->image->getImage($blogs);
		$data['blogs'] = $blogs;

		$this->load->view('site/blog', $data);
	}

	public function blog_detail()
	{
		$input = array();
		$id = $this->input->get('id');

		// 抓出單筆資料
		$blogs = $this->db->get_where('article', array(
		    'Recover' => 0, 
		    'panel' => 4,
		    'id' => $id,
		))->result_array();
		$blogs = $this->image->getImage($blogs);
		$input['blog'] = $blogs[0];

		// 抓出媒體報導類別
		$types=$this->db->get_where('type', array('parent_id' => 2, 'recover' => 0,  ))->result_array();
		$input['types'] = $types;

		$this->load->view('site/blog_detail', $input);
	}

	/* --------------------------
		活動下載
	 --------------------------	*/
	public function promotions()
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
		    'panel' => 10,
		    'show' => 1,
		))->result_array();
		$config = $this->get_pagination_config(site_url('site/promotions'), count($datas),$count);

		// 抓出塞選資料
		$promotions = $this->db->order_by('start_at','desc')->get_where('article', array(
		    'Recover' => 0, 
		    'panel' => 10,
		    'show' => 1,
		), $config['per_page'], $index)->result_array();

		// 抓取圖片
    	$promotions = $this->image->getImage($promotions);
		$data['promotions'] = $promotions;
		$this->load->view('site/promotions', $data);
	}

	/* --------------------------
		分店管理
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

	public function store_detail()
	{
		$input = array();
		$id = $this->input->get('id');

		// 抓出單筆資料
		$stores = $this->db->get_where('store', array(
		    'Recover' => 0, 
		    'show' => 1,
		    'id' => $id,
		))->result_array();

		if(!empty($stores)) {
			$stores = $this->image->getImage($stores);
			$input['store'] = $stores[0];
		} else {
			$input['store'] = array('name' => '', 'content' => '');
		}

		$this->load->view('site/store_detail',$input);
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
        
        $config['next_link']      = 'Next page';
        $config['next_tag_open']  = '<li>'; //自訂下一頁標籤
        $config['next_tag_close'] = '</li>';
        
        $config['prev_link']      = 'Last page';
        $config['prev_tag_open']  = '<li>';
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



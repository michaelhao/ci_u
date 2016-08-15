<?php
include("layout/modify_partials.php");
include("layout/fileupload_partials.php");
// 取出索引欄位中的資料值
$id=$this->input->get("id");
$row=$this->db->get_where('product', array('id' => $id,))->row_array();
$total_count_sql = "SELECT sum(`order_detail`.`order_pcount`) as total_count
					FROM `order_detail`
					LEFT JOIN `order` ON `order_detail`.`order_id` = `order`.`order_id` 
					WHERE `order_detail`.`order_pid` = '".$id."' AND `order`.`order_status` = 2";
$total_count = $this->db->query($total_count_sql)->row();

// 若抓取不到值，預設為0
if($total_count->total_count != null) { 
	$row['sale'] = $total_count->total_count;
} else {
	$row['sale'] = 0;
}
//image用row_array只會顯示第一張圖
$image=$this->db->get_where('image', array('panel'=>$row['panel'], 'source_id'=>$row['id'], 'file_number'=>$row['number'],))->row_array();
//抓規格
$pro_details=$this->db->get_where('product_detail', array('product_id'=>$id))->result_array();
// 抓取類型選單
$CI =& get_instance();
$CI->load->library('typelist');
$type_array=$CI->typelist->type_list(0);
?>
<!-- 表單開始 -->
<?php
// Start Form
echo $this->form_builder->open_form(
	array(
		'role' => 'form',
		'action' => 'backend/product/modify',
		'method' => 'post'
	)
);
// Form Input
echo $this->form_builder->build_form_horizontal(
    array(
	    array(
	        'id' => 'id',
	        'type' => 'hidden',
	        'value' => $this->input->get('id')
	    ),
	    array(
	        'id' => 'panel',
	        'type' => 'hidden',
	        'value' => $this->input->get('mpanel')
	    ),
	    array(
	        'id' => 'type',
	        'type' => 'dropdown',
	        'label' => '類別:',
	        'class' => 'required select',
	        'options' => formOptionArray($type_array),
	    ),
	    array(
	        'id' => 'kind',
	        'type' => 'dropdown',
	        'label' => '商品品項:',
	        'class' => 'required select',
	        'options' => array( 1=>'電商品項', 2 =>'實體品項', 3=>'兩者皆有'),
	    ),
	    array(
	        'id' => 'name',
	        'label' => '標題:',
	        'class' => 'required',
	    ),
	    array(
	        'id' => 'pic',
	        'type' => 'html',
	        'label' => '主圖(H870XW430):',
	        'html' => get_single_fileupload_html($row['number']),
	    ),
	    array(
	        'id' => 'description',
	        'type' => 'textarea',
	        'label' => '產品規格:',
	        'class' => 'required ckeditor',
	    ),
	    array(
	    	'id' => 'price',
	    	'label' => '原價',
	    ),
	    array(
	    	'id' => 'special_offer',
	    	'label' => '特價',
	    	'class' => 'required',
	    ),
	    array(
	    	'id' => 'pay_method',
	    	'label' => '付款方式',
	    	'class' => 'required',
	    	'type' => 'hidden',
	    ),
	    array(
	    	'id' => 'transport_method',
	    	'label' => '交貨方式',
	    	'class' => 'required',
	    	'type' => 'hidden',
	    ),
	    array(
	    	'id' => 'visitor',
	    	'label' => '瀏覽人數',
	    	'disabled' => 'disabled',
	    ),
	    array(
	    	'id' => 'sale',
	    	'label' => '銷售數',
	    	'disabled' => 'disabled',
	    ),
	    array(
	        'id' => 'content',
	        'type' => 'textarea',
	        'label' => '內頁內容:',
	        'class' => 'required ckeditor',
	    ),
	    array(
	    	'id' => 'qty',
	    	'label' => '庫存',
	    	'class' => 'required',
	    ),
	    array(
	        'id' => 'show',
	        'type' => 'dropdown',
	        'label' => '上架狀態:',
	        'class' => 'required select',
	        'options' => array( 1=>'上架', 2 =>'下架',),
	    ),
), $row);

// End Button
echo $form_end_button;
// End Form
echo $this->form_builder->close_form();;
?>
<!-- 表單結束 -->
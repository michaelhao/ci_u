<?php
include("layout/insert_partials.php");
include("layout/fileupload_partials.php");
$row = array();
// 抓取類型選單

$CI =& get_instance();
$CI->load->library('typelist');
$type_array=$CI->typelist->type_list(1);
?>

<!-- 表單開始 -->
<?php
// Start Form
echo $this->form_builder->open_form(
	array(
		'role' => 'form',
		'action' => 'backend/product/insert',
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
	        'value' => $this->input->get('ipanel')
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
	        'html' => get_single_fileupload_html(0),
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
?>

<?php
// End Button
echo $form_end_button;
// End Form
echo $this->form_builder->close_form();;
?>
<!-- 表單結束 -->



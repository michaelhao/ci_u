<?php
include("layout/insert_partials.php");
include("layout/fileupload_partials.php");
$row = array();
// 抓取類型選單
$rowtype=$this->db->get_where('type', array('parent_id' => 2, 'recover' => 0,  ))->result_array();
$typeAry = [];
foreach ($rowtype as $key => $type) {
	$typeAry[] = $type;
	$subtype = $this->db->get_where('type', array('parent_id' => $type['id'], 'recover' => 0,  ))->result_array();
	foreach ($subtype as $key => $value) {
		$value['name'] = ' -- '.$value['name'];
		$typeAry[] = $value;
	}
}

?>

<!-- 表單開始 -->
<?php
// Start Form
echo $this->form_builder->open_form(
	array(
		'role' => 'form',
		'action' => 'backend/article/insert',
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
	        'options' => formOptionArray($typeAry),
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
	        'id' => 'start_at',
	        'label' => '文章時間:',
	        'class' => 'required datepicker',
	    ),
	    array(
	        'id' => 'description',
	        'label' => '簡述:',
	        'type' => 'textarea',
	        'class' => 'required',
	    ),
	    array(
	        'id' => 'content',
	        'type' => 'textarea',
	        'label' => '內頁內容:',
	        'class' => 'required ckeditor'
	    ),
	    array(
	        'id' => 'show',
	        'type' => 'dropdown',
	        'label' => '上架狀態:',
	        'class' => 'required select',
	        'options' => array( 1=>'顯示', 2 =>'隱藏',),
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



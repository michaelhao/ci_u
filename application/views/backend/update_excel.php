<?php
include("layout/file_update_partials.php");
$row = array();
// 抓取類型選單
$rowtype=$this->db->get_where('type', array('parent_id' => 0, 'recover' => 0,  ))->result_array();
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
		'action' => site_url("backend/ImportPackage/upload"),
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
	        'value' => $this->input->get('tpanel')
	    ),
	    array(
	        'id' => 'pic',
	        'type' => 'html',
	        'label' => '選擇檔案(限CSV、ZIP):',
	        'html' => fileupload_file_html(0),
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

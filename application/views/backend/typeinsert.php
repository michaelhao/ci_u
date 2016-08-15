<?php
include("layout/insert_partials.php");
include("layout/fileupload_partials.php");
$row = array();
// 抓取管理者類型選單
$rowtype=$this->db->get_where('type', array(
	'recover' => 0, 
	'panel' => $this->input->get('ipanel'), 
	'parent_id' => 0, 
))->result_array();
?>

<!-- 表單開始 -->
<?php
// Start Form
echo $this->form_builder->open_form(
	array(
		'role' => 'form',
		'action' => 'backend/type/insert',
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
		        'id' => 'parent_id',
		        'type' => 'dropdown',
		        'label' => '指定類別:',
		        'class' => 'required select',
		        'options' => formOptionArray($rowtype),
		    ),
		    array(
	        'id' => 'name',
	        'label' => '名稱:',
	        'class' => 'required',
	    	),
    	), $row);
// End Button
echo $form_end_button;
// End Form
echo $this->form_builder->close_form();;
?>
<!-- 表單結束 -->

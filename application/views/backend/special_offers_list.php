<?php
include("layout/modify_partials.php");
include("layout/fileupload_partials.php");
// 取出索引欄位中的資料值
$id=$this->input->get("id");
$row=$this->db->get_where('static', array('id' => 4))->row_array();
?>

<!-- 表單開始 -->
<?php
// Start Form
echo $this->form_builder->open_form(
	array(
		'role' => 'form',
		'action' => 'backend/staticPage/modify',
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
	        'value' => $this->input->get('panel')
	    ),
	    
	    array(
	        'id' => 'name',
	        'label' => '頁面名稱:',
	        'value' => $row['name'],
	        'disabled' => 'disabled'
	    ),
	    array(
	        'id' => 'field1',
	        'label' => '主旨:',
	        'class' => 'required'
	    ),
	    array(
	        'id' => 'content',
	        'type' => 'textarea',
	        'label' => '內頁內容:',
	        'class' => 'required ckeditor'
	    ),
	    array(
	        'id' => 'field2',
	        'label' => 'URL:',
	        'class' => 'required'
	    ),
	    array(
	        'id' => 'show',
	        'type' => 'dropdown',
	        'label' => '上架狀態:',
	        'class' => 'required select',
	        'options' => array( 1=>'顯示', 2 =>'隱藏',),
	    ),
	    
), $row);

// Modify End Btn
$form_end_button = '
<div class="form-actions text-right">
	<input type="submit" value="確認" class="btn btn-primary">
</div>';
// End Button
echo $form_end_button;
// End Form
echo $this->form_builder->close_form();;
?>
<!-- 表單結束 -->
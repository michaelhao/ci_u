<?php
include("layout/modify_partials.php");
include("layout/fileupload_partials.php");
// 取出索引欄位中的資料值
$id=$this->input->get("id");
$row=$this->db->get_where('order_detail', array('id' => $id,))->row_array();

?>

<!-- 表單開始 -->
<?php
// Start Form
echo $this->form_builder->open_form(
	array(
		'role' => 'form',
		'action' => 'backend/order/modify_detail',
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
	        'id' => 'order_pname',
	        'label' => '產品名稱:',
	        'class' => 'required',
	    ),
	    array(
	        'id' => 'order_pcount',
	        'label' => '產品數量:',
	        'class' => 'required',
	    ),
	    array(
	        'id' => 'order_psubtotal',
	        'label' => '產品單價:',
	        'class' => 'required',
	    ),
), $row);

// End Button
echo $form_end_button;
// End Form
echo $this->form_builder->close_form();;
?>
<!-- 表單結束 -->
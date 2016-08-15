<?php
include("layout/modify_partials.php");
// 取出索引欄位中的資料值
$id=$this->input->get("id");
$row=$this->db->get_where('admintable', array('id' => $id,))->row_array();
$row['pwd'] = ''; //清空密碼
$rowtype=$this->db->get('admintype')->result_array();
?>

<!-- 表單開始 -->
<?php
// Start Form
echo $this->form_builder->open_form(
	array(
		'role' => 'form',
		'action' => 'backend/admin/modify',
		'method' => 'post'
	)
);
// Form Input 防止自己停權自己
if($row_login['id'] == $row["id"]) {
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
		        'id' => 'name',
		        'label' => '姓名:',
		        'placeholder' => '請輸入姓名',
		        'class' => 'required'
		    ),
		    array(
		        'id' => 'acc',
		        'label' => '帳號:',
		        'placeholder' => '請輸入帳號',
		        'class' => 'required',
		        'disabled' => 'disabled'
		    ),
		    array(
		        'id' => 'pwd',
		        'type' => 'password',
		        'label' => '修改密碼:',
		        'placeholder' => '請輸入密碼',
		        'value' => ''
		    ),
		    array(
		        'id' => 'email',
		        'type' => 'email',
		        'label' => '電子郵件:',
		        'placeholder' => '請輸入電子郵件',
		        'class' => 'required'
		    ),
	), $row);
	} else {
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
		        'id' => 'name',
		        'label' => '姓名:',
		        'placeholder' => '請輸入姓名',
		        'class' => 'required'
		    ),
		    array(
		        'id' => 'acc',
		        'label' => '帳號:',
		        'placeholder' => '請輸入帳號',
		        'class' => 'required',
		        'disabled' => 'disabled'
		    ),
		    array(
		        'id' => 'pwd',
		        'type' => 'password',
		        'label' => '修改密碼:',
		        'placeholder' => '請輸入密碼',
		        'value' => ''
		    ),
		    array(
		        'id' => 'email',
		        'type' => 'email',
		        'label' => '電子郵件:',
		        'placeholder' => '請輸入電子郵件',
		        'class' => 'required'
		    ),
		    array(
		        'id' => 'title',
		        'type' => 'dropdown',
		        'label' => '站內權限:',
		        'class' => 'required select',
		        'options' => formOptionArray($rowtype),
		    ),
		    array(
		        'id' => 'right',
		        'type' => 'dropdown',
		        'label' => '狀態:',
		        'class' => 'required select',
		        'options' => array( 1 => '正常', 2 => '停權'),
		    ),
	), $row);
}
// End Button
echo $form_end_button;
// End Form
echo $this->form_builder->close_form();;
?>
<!-- 表單結束 -->
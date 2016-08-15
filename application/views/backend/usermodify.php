<?php
include("layout/modify_partials.php");
include("layout/fileupload_partials.php");
// 取出索引欄位中的資料值
$id=$this->input->get("id");
$row=$this->db->get_where('users', array('id' => $id,))->row_array();
$row['password']='';
?>

<!-- 表單開始 -->
<?php
// Start Form
echo $this->form_builder->open_form(
	array(
		'role' => 'form',
		'action' => 'backend/user/modify',
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
	        'id' => 'account',
	        'label' => '帳號:',
	    ),
	    array(
	        'id' => 'password',
	        'label' => '密碼:',
	        'type' => 'password'
	    ),
	    array(
	        'id' => 'email',
	        'label' => 'E-mail:',
	    ),
	    array(
	        'id' => 'name',
	        'label' => '姓名:',
	    ),
	    array(
	        'id' => 'phone',
	        'label' => '手機:',
	    ),
	    array(
	        'id' => 'identity',
	        'label' => '身分證字號:',
	    ),
	    array(
	        'id' => 'birthday',
	        'label' => '生日:',
	    ),
	    array(
	        'id' => 'address',
	        'label' => '住址:',
	    ),
	    array(
	        'id' => 'member_level',
	        'type' => 'dropdown',
	        'label' => '會員身分:',
	        'class' => 'select',
	        'options' => array( 0=>'一般會員', 1 =>'黃金會員',),
	    ),
	    array(
	        'id' => 'gold',
	        'label' => '購物金:',
	    ),
	    array(
	        'id' => 'bonus',
	        'label' => '紅利點:',
	    ),
	    array(
	        'id' => 'dt',
	        'label' => '註冊時間:',
	        'disabled' => 'disabled',
	    ),

), $row);

// End Button
echo $form_end_button;
// End Form
echo $this->form_builder->close_form();;
?>
<!-- 表單結束 -->

<!-- /datatable with tools menu -->
<?php
include("layout/modify_partials.php");
// 取出索引欄位中的資料值
$id=$this->input->get("id");
$row=$this->db->get_where('store_account', array('id' => $id,))->row_array();
$row['pwd'] = ''; //清空密碼
// 抓取管理者類型選單
$stores=$this->db->get_where('store',array('recover' => 0, 'show' => 1))->result_array();
?>

<!-- 表單開始 -->
<?php
// Start Form
echo $this->form_builder->open_form(
	array(
		'role' => 'form',
		'action' => 'backend/storeAccount/modify',
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
		        'id' => 'store',
		        'type' => 'dropdown',
		        'label' => '分店:',
		        'class' => 'required select',
		        'disabled' => 'disabled',
		        'options' => formOptionArray($stores),
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
		    ),
		    array(
		        'id' => 'enter_password',
		        'name' => 'pwd',
		        'type' => 'password',
		        'label' => '密碼:',
		        'placeholder' => '請輸入密碼',
		    ),
		    array(
		        'id' => 'right',
		        'type' => 'dropdown',
		        'label' => '權限:',
		        'class' => 'required select',
		        'options' => array( 1 => '正常', 2 => '停權'),
		    ),
    	), $row);
// End Button
echo $form_end_button;
// End Form
echo $this->form_builder->close_form();;
?>
<!-- 表單結束 -->

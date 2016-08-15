<?php
include("layout/modify_partials.php");
include("layout/fileupload_partials.php");
// 取出索引欄位中的資料值
$id=$this->input->get("id");
$row=$this->db->get_where('order', array('id' => $id,))->row_array();

$order_details=$this->db->order_by('id', 'desc')->get_where('order_detail', array(
	'order_id' => $row['order_id'],
))->result_array();

foreach ($order_details as $key => $order_detail) {
	if ($order_detail['order_pid']==0) {
		$order_details[$key]['pname'] = "運費";
	}else{
		$product=$this->db->get_where('product', array('id' => $order_detail['order_pid'],))->row_array();
		$order_details[$key]['pname'] = $product['name'];
	}
}

// 新增使用者
$users=$this->db->get('users')->result_array();
$userAry = formOptionArray($users, 'email');
?>

<!-- 表單開始 -->
<?php
// Start Form
echo $this->form_builder->open_form(
	array(
		'role' => 'form',
		'action' => 'backend/order/insert',
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
	        'id' => 'order_id',
	        'label' => '訂單編號:',
	        'disabled' => 'disabled',
	    ),
	    array(
	        'id' => 'order_uid',
	        'type' => 'dropdown',
	        'label' => '購買人:',
	        'class' => 'select',
	        'options' => $userAry,
 	    ),
	    array(
	        'id' => 'order_total',
	        'label' => '訂單金額:',
	        'class' => 'required number',
	    ),
	    array(
	        'id' => 'order_payclass',
	        'type' => 'dropdown',
	        'label' => '付款類型:',
	        'class' => 'required select',
	        'options' => array('ATM' => 'ATM轉帳','CreditCard' => '信用卡', , 'CVS' => '超商代碼', 'COD' => '貨到付款'),
	    ),
	    array(
	        'id' => 'order_status',
	        'type' => 'dropdown',
	        'label' => '付款狀態:',
	        'class' => 'required select',
	        'options' => array(1 => '未付款',2 => '已付款', ),
	    ),
	    array(
	        'id' => 'status',
	        'type' => 'dropdown',
	        'label' => '出貨狀態:',
	        'class' => 'required select',
	        'options' => array(1 => '待處理',2 => '已出貨', 3=>'訂單註銷'),
 	    ),
	    array(
	        'id' => 'order_postname',
	        'label' => '收件人:',
	    ),
	    array(
	        'id' => 'order_postphone',
	        'label' => '收件人電話:',
	    ),
	    array(
	        'id' => 'order_postaddr',
	        'label' => '收件人地址:',
	    ),
	    array(
	        'id' => 'note',
	        'label' => '備註:',
	    ),
	    array(
	        'id' => 'order_paytime',
	        'label' => '付款時間:',
	        'class' => 'datepicker',
	    ),
	    array(
	        'id' => 'created_at',
	        'label' => '訂單建立時間:',
	        'disabled' => 'disabled',
	    ),
	    array(
	        'id' => 'order_postdate',
	        'label' => '訂單出貨時間:',
	        'class' => 'datepicker',
	    ),
), $row);

// End Button
echo $form_end_button;
// End Form
echo $this->form_builder->close_form();;
?>
<!-- 表單結束 -->


<?php
include("layout/modify_partials.php");
include("layout/fileupload_partials.php");
// 取出索引欄位中的資料值
$id=$this->input->get("id");
$row=$this->db->get_where('order', array('id' => $id,))->row_array();
$users=$this->db->get('users')->result_array();
$userAry = formOptionArray($users, 'account');
// p($row);

$order_details=$this->db->order_by('id', 'asc')->get_where('order_detail', array(
	'order_id' => $row['order_id'],
	'recover' => 0,
))->result_array();

?>

<!-- 表單開始 -->
<?php
// Start Form
echo $this->form_builder->open_form(
	array(
		'role' => 'form',
		'action' => 'backend/order/modify',
		'method' => 'post'
	)
);

$form_array = array(
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
        'id' => 'order_id',
        'label' => '訂單編號:',
        'class' => 'required',
        'disabled' => 'disabled',
    ),
    array(
        'id' => 'order_uid',
        'type' => 'dropdown',
        'label' => '購買人:',
        'class' => 'select',
        'disabled' => 'disabled',
        'options' => $userAry,
	    ),
    array(
        'id' => 'order_total',
        'label' => '訂單金額:',
        'class' => 'required',
        'disabled' => 'disabled',
    ),
    array(
        'id' => 'order_payclass',
        'type' => 'dropdown',
        'label' => '付款類型:',
        'class' => 'required select',
        'options' => array('ATM' => 'ATM轉帳','CreditCard' => '信用卡', 'CVS' => '超商代碼', 'COD' => '貨到付款' , 'Cash' => '現金付款'),
        'disabled' => 'disabled',
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
        'class' => 'required',
        'disabled' => 'disabled',
    ),
    array(
        'id' => 'order_postphone',
        'label' => '收件人電話:',
        'class' => 'required',
        'disabled' => 'disabled',
    ),
    array(
        'id' => 'order_postaddr',
        'label' => '收件人地址:',
        'class' => 'required',
        'disabled' => 'disabled',
    ),
    array(
        'id' => 'note',
        'label' => '備註:',
        'disabled' => 'disabled',
    ),
    array(
        'id' => 'receive_day',
        'label' => '可收件日期:',
        'disabled' => 'disabled',
    ),
    array(
        'id' => 'receive_time',
        'type' => 'dropdown',
        'label' => '可收件時段:',
        'class' => 'select',
        'options' => array(0 => '不指定', 1 => '上午 8:00~12:00',2 => '下午 12:00~17:00', 3 => '晚上 17:00~22:00' ),
        'disabled' => 'disabled',
    ),  
    // array(
    //     'id' => 'invoice_donate',
    //     'type' => 'dropdown',
    //     'label' => '是否捐贈發票:',
    //     'class' => 'select',
    //     'options' => array(0 => '否',1 => '是', ),
    //     'disabled' => 'disabled',
    // ),    
    // array(
    //     'id' => 'invoice_type',
    //     'type' => 'dropdown',
    //     'label' => '發票形式:',
    //     'class' => 'select',
    //     'options' => array(2 => '二聯式',3 => '三聯式', ),
    //     'disabled' => 'disabled',
    // ),
    // array(
    //     'id' => 'invoice_title',
    //     'label' => '發票抬頭:',
    //     'disabled' => 'disabled',
    // ),
    // array(
    //     'id' => 'invoice_Unumber',
    //     'label' => '發票統編:',
    //     'disabled' => 'disabled',
    // ),   
    array(
        'id' => 'order_paytime',
        'label' => '付款時間:',
        'disabled' => 'disabled',
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
);
if ($row['status']==2) {//當狀態為已出貨時,出貨狀態不可逆
	$form_array[7]['disabled'] = 'disabled';
}
if ($row['order_payclass']!="COD" && $row['status']!=3) {//貨到付款 才可修改付款狀態
    $form_array[6]['disabled'] = 'disabled';
}
if ($row['order_status']==2 && $row['status']!=3) {//已付款後不可變更狀態
    $form_array[6]['disabled'] = 'disabled';
}

// Form Input
echo $this->form_builder->build_form_horizontal($form_array, $row);

// End Button
echo $form_end_button;
// End Form
echo $this->form_builder->close_form();;
?>
<!-- 表單結束 -->
<?php 
$row_submenu_2=select_submenu(14);			
$name2=$row_submenu_2["name"];
$insert=$row_submenu_2["insertlink"];
$modify=$row_submenu_2["modifylink"];
$link=$row_submenu_2["link"];
$recover=$row_submenu_2["recoverlink"];
$type=$row_submenu_2["typelink"];
?>

<?php if (substr($row['order_id'],-4,4) != "0000") { ?>

<BR>
<BR>
<h6 class="heading-hr"><i class="icon-checkmark-circle"></i>訂單細項</h6>
<!--Datatable with tools menu -->
<div class="datatable-tools2">
	<table class="table">
		<thead>
			<tr>
				<th>產品名稱</th>
				<th>產品數量</th>
				<th>產品單價</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($order_details as $key => $order_detail) {
			?>
				<tr>
					<td><?=$order_detail['order_pname']?></td>
					<td><?=$order_detail['order_pcount'];?></td>
					<td><?=$order_detail['order_psubtotal']?></td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div>
<!-- /datatable with tools menu -->
<?php }else{ ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-table"></i><?=$name2?>列表</h6>
		<a href="<?=$insert?>&id=<?=$id?>" class="btn btn-success pull-right"><span class="icon-plus"></span><?=$name2?>新增</a>
	</div>
	<div class="datatable-tools">
		<table class="table">
			<thead>
				<tr>
					<th>產品名稱</th>
					<th>產品數量</th>
					<th>產品單價</th>
					<th>功能</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($order_details as $key => $order_detail) {
				?>
					<tr>
						<td><?=$order_detail['order_pname']?></td>
						<td><?=$order_detail['order_pcount'];?></td>
						<td><?=$order_detail['order_psubtotal']?></td>
						<td>
							<div class="btn-group" >
								<a href="<?=$modify . "&id=" . $order_detail["id"];?>" class="btn btn-icon btn-danger modifybu"><i class="icon-wrench2"></i></a>
							</div>
							<div class="btn-group delete">
								<a onclick="delete_detail('<?php echo "order/delete_detail?panel=".$this->input->get('mpanel')."&id=".$order_detail["id"];?>')" href="#" class="btn btn-icon btn-success modifybu"><i class="icon-remove"></i></a>
							</div>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php } ?>

<script>
function delete_detail(url) 
{ 
	if (confirm("確認是否要刪除資料。")) {
		window.location.href = url;
	}
}
</script>
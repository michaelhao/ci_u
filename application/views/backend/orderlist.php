<?php
include("layout/list_partials.php");

$storeAcc=$this->input->get('acc');//分店帳號
$period=$this->input->get('period');//期間
$from="2016-01-01";//起始時間預設
$to=date("Y-m-d");
if ($storeAcc==null) {
	$storeAcc="0";//所有訂單
}
if ($period!=null) {
	list($from, $to)=explode("~", $period);
}
$to_end=$to." 23:59:59";

if ($storeAcc!="0") {
	list($IDstore, $IDacc)=explode("-", $storeAcc);//list(分店, 店員)
	if ($IDacc==0) {//店員是0=>顯示所有該分店訂單
		if ($IDstore!=0) {
			$store=$this->db->get_where('store', array('id'=>$IDstore))->row_array();
		}
		$orders=$this->db->order_by('id', 'desc')->where('created_at >=', $from)->where('created_at <=', $to_end)->get_where('order', array('store_from'=>$IDstore))->result_array();
	}else{
		$store=$this->db->get_where('store_account', array('id'=>$IDacc))->row_array();
		$orders=$this->db->order_by('id', 'desc')->where('created_at >=', $from)->where('created_at <=', $to_end)->get_where('order', array('store_from'=>$IDstore, 'store_clerk'=>$IDacc))->result_array();
	}
}else{
	$orders=$this->db->order_by('id', 'desc')->where('created_at >=', $from)->where('created_at <=', $to_end)->get_where('order', array())->result_array();	
}
//實體介面帳號
$CI =& get_instance();
$CI->load->library('storeaccount');
$acc_list=$CI->storeaccount->accountList();
//總金額
$total = 0;
foreach ($orders as $key => $order) {
	$total = $total + $order['order_total'];
}

?>
<style type="text/css">
  	input.datepicker {
    	width: 100px;
    	display: inline;
  	}
</style>
<!--Datatable with tools menu -->
<div class="panel panel-default">
	<div class="panel-heading">

		<label style="margin-top: 3px;">
			<select id="kind" onchange="sel_acc(this.options[this.options.selectedIndex].value)" class="required select">
				<?php if ($storeAcc=="0") { ?>
					<option value="0">選擇分店</option>
				<?php }else if($storeAcc=="0-0"){ ?>
					<option value="<?=$storeAcc?>"><?php echo "網路下單";?></option>
				<?php }else{ ?>
					<option value="<?=$storeAcc?>"><?php echo $store['name'];?></option>
				<?php }?>
				<?php foreach ($acc_list as $key => $list) { ?>
					<option value="<?=$list['id']; ?>"><?=$list['name']; ?></option>
				<?php } ?>
			</select>
	    </label>

	    <span id="date">&nbsp;&nbsp;日期：<input type="text" class="form-control datepicker valid" id="date_from" value="<?=$from;?>"></span>
	    <span id="date">&nbsp;至&nbsp;<input type="text" class="form-control datepicker valid" id="date_to" value="<?=$to;?>"></span>
	    <span class="btn btn-success icon-search3" id="period"></span>

		<h6 class="panel-title"><i class="icon-table"></i><?=$name2?>列表</h6>	
		<a href="<?=site_url("backend/ExportExcel/orderExcel?acc=").$storeAcc."&from=".$from."&to=".$to;?>" class="btn btn-success pull-right" value=""><span class="icon-download"></span>  匯出訂單資料</a>
		<h6 class="panel-title pull-right" value="">總金額 : <?=$total?> 元</h6>
		<!-- <a href="<?=$insert?>" class="btn btn-success pull-right"><span class="icon-plus"></span> <?=$name2;?>新增</a> -->
	</div>
	<div class="datatable-tools">
		<table class="table">
			<thead>
				<tr>
					<th>編號</th>
					<th>訂單編號</th>
					<th>支付方式</th>
					<th>付款狀態</th>
					<th>收件人</th>
					<th>訂單金額</th>
					<th>訂單建立時間</th>
					<th>出貨狀態</th>
					<th>訂單出貨時間</th>
					<th>功能</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($orders as $key => $order) {
				?>
					<tr>
						<td><?=$order['id']?></td>
						<td><?=$order['order_id']?></td>
						<td><?php
						switch ($order['order_payclass']) {
			                case 'ATM':
			                    echo "ATM轉帳";
			                    break;
			                case 'CreditCard':
			                    echo "信用卡";
			                    break;
			                case 'CVS':
			                    echo "超商代碼";
			                    break;
			                case 'COD':
			                    echo "貨到付款";
			                    break;
			                case 'Cash':
			                    echo "現金付款";
			                    break;
			                default:
			                    echo "error";
			                    break;
			            }
						?></td>
						<td><?php
						switch ($order["order_status"]) {
		                    case 1:
		                        echo "未付款";
		                        break;
		                    case 2:
		                        echo "已付款";
		                        break;
		                    default:
		                        echo "error";
		                        break;
		                }
						?></td>
						<td><?=$order["order_postname"];?></td>
						<td><?=$order["order_total"];?></td>
						<td><?=$order["created_at"];?></td>
						<td><?php
						switch ($order['status']) {
		                    case 1:
		                        echo "待處理";
		                        break;
		                    case 2:
		                        echo "已出貨";
		                        break;
		                    case 3:
		                        echo "訂單註銷";
		                        break;
		                    default:
		                        echo "error";
		                        break;
		                }
                		?></td>
						<td><?=$order["order_postdate"];?></td>
						<td>
							<div class="btn-group" >
								<a href="<?=$modify . "&id=" . $order["id"];?>" class="btn btn-icon btn-danger modifybu"><i class="icon-wrench2"></i></a>
							</div>
						</td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>
	<!-- /datatable with tools menu -->
<script>
$(function() {
    $( "#date #date_from" ).datepicker();
    $( "#date #date_to" ).datepicker();
});
$("#period").click(function(){
	var from=document.getElementById('date_from').value;
	var to=document.getElementById('date_to').value;
	var store=document.getElementById('kind').value;

	window.location = "<?=site_url('backend/page?panel=6&acc='); ?>"+store+"&period="+from+"~"+to;
});

function sel_acc(acc) 
{ 
    window.location = "<?=site_url('backend/page?panel=6&acc='); ?>"+acc;
}
</script>
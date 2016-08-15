<?php
include("layout/list_partials.php");
$store_accounts=$this->db->get_where('store_account', array('Recover' => 0, ))->result_array();

foreach ($store_accounts as $key => $store_account) {
	$store = $this->db->get_where('store', array('id' => $store_account['store'], ))->row_array();

	if(!empty($store)) {
		$store_accounts[$key]['store_str']=$store['name'];	
	} else {
		$store_accounts[$key]['store_str']= '';
	}
}
?>
<!--Datatable with tools menu -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-table"></i><?=$name2?>列表</h6>	
		<a href="<?=$insert?>" class="btn btn-success pull-right"><span class="icon-plus"></span> <?=$name2;?>新增</a>
	</div>
	<div class="datatable-tools">
		<table class="table">
			<thead>
				<tr>
					<th>編號</th>
					<th>分店</th>
					<th>姓名</th>
					<th>帳號</th>
					<th>登入權限</th>
					<th>功能</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($store_accounts as $key => $store_account) {
				?>
					<tr>
						<td><?=$store_account["id"];?></td>
						<td><?=$store_account["store_str"];?></td>
						<td><?=$store_account["name"];?></td>
						<td><?=$store_account["acc"];?></td>
						<td id="right<?=$store_account["id"]?>" class="right">
							<?php
							if($store_account["right"] == 1){
								echo "<a class='btn btn-success rightCHK' style='cursor: default;'><span class='icon-user-plus2'></span>正常</a>";
							} else {
								echo "<a class='btn btn-danger rightCHK' style='cursor: default;'><span class='icon-user-cancel2'></span>停權</a>";
							}
							?>
						</td>
						<td>
							<div class="btn-group">
								<a href="<?=$modify . "&id=" . $store_account["id"];?>" class="btn btn-icon btn-danger modifybu"><i class="icon-wrench2"></i></a>
							</div>
							<?php if($row_login['id'] != $store_account["id"]) {?>
							<div class="btn-group delete">
								<a onclick="deletelist('<?php echo site_url('backend/storeAccount/delete')."?panel=".$this->input->get('panel')."&id=".$store_account["id"];?>')" href="#" class="btn btn-icon btn-success modifybu"><i class="icon-remove"></i></a>
							</div>
							<?php } ?>
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

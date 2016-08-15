<?php
include("layout/list_partials.php");
$users=$this->db->order_by('id', 'desc')->get_where('users', array('verify' => 1, 'isactive' => 1
))->result_array();

?>
<!--Datatable with tools menu -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-table"></i><?=$name2?>列表</h6>	
		<!-- <a href="<?=$insert?>" class="btn btn-success pull-right"><span class="icon-plus"></span> <?=$name2;?>新增</a> -->
		<a onclick="upgradeAll('<?php echo "user/verifyAll?panel=".$this->input->get('panel');?>')" href="#" class="btn btn-success pull-right" value=""> 一鍵升級</a>
	</div>
	<div class="datatable-tools">
		<table class="table">
			<thead>
				<tr>
					<th>編號</th>
					<th>帳號(手機)</th>
					<th>姓名</th>
					<th>會員身分</th>
					<th>黃金審核</th>
					<th>註冊時間</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($users as $key => $user) {
				?>
					<tr>
						<td><?=$user["id"];?></td>
						<td><?=$user["phone"];?></td>
						<td><?=$user["name"];?></td>
						<td><?=($user["member_level"]==1)?"黃金會員":"一般會員";?></td>
						<td>
							<a href='###' id='open<?=$user["id"]?>' class='btn btn-success rightCHK' onclick="showUrl('user/verify','<?=$user["id"]?>','open')"><?=($user["member_level"]==0)?"會員升級":"發購物金";?></a>
							<a style = "display:none" href='###' id='close<?=$user["id"]?>' class='btn btn-danger rightCHK'><?=($user["member_level"]==0)?"升級成功":"發錢完畢";?></a>
						</td>
						<td><?=$user["dt"];?></td>
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
function upgradeAll(url) {
    if (confirm("確認是否要一次審核全部?")) {
        window.location.href = url;
    }
}
</script>

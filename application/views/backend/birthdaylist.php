<?php
include("layout/list_partials.php");
$users=$this->db
	->select('*')
	->from('users')
	->where('member_level', 1)
	->where_in('bir_gift', array(1,2))
	->order_by('id', 'desc')
	->get()
	->result_array();

?>
<!--Datatable with tools menu -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-table"></i><?=$name2?>列表</h6>	
		<!-- <a href="<?=$insert?>" class="btn btn-success pull-right"><span class="icon-plus"></span> <?=$name2;?>新增</a> -->
	</div>
	<div class="datatable-tools">
		<table class="table">
			<thead>
				<tr>
					<th>編號</th>
					<th>帳號(手機)</th>
					<th>姓名</th>
					<th>生日</th>
					<th>生日禮</th>
					<th>功能</th>
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
						<td><?=$user["birthday"];?></td>
						<td>
							<?php if($user["bir_gift"]==1){
								echo "待兌換";
							}else if($user["bir_gift"]==2){
								echo "已兌換";
							}?></td>
						<td>
							<div class="btn-group" >
								<a href="<?=$modify . "&id=" . $user["id"]; ?>" class="btn btn-icon btn-danger modifybu"><i class="icon-wrench2"></i></a>
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
function upgradeAll(url) {
    if (confirm("確認是否要一次審核全部?")) {
        window.location.href = url;
    }
}
</script>

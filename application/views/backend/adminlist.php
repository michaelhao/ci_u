<?php
include("layout/list_partials.php");
$admins=$this->db->get_where('admintable', array('Recover' => 0, ))->result_array();
// 抓取管理者類別
foreach ($admins as $key => $admin) {
	$admintype = $this->db->get_where('admintype', array('id' => $admin['title'], ))->row_array();
	$admins[$key]['title_str'] = $admintype['name'];
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
					<th>姓名</th>
					<th>帳號</th>
					<th>權限</th>
					<th>狀態</th>
					<th>功能</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($admins as $key => $admin) {
				?>
					<tr>
						<td><?=$admin["id"];?></td>
						<td><?=$admin["name"];?></td>
						<td><?=$admin["acc"];?></td>
						<td><?=$admin["title_str"];?></td>
						<td id="right<?=$admin["id"]?>" class="right">
							<?php
							if($admin["right"] == 1){
								echo "<a style='cursor: default;' class='btn btn-success rightCHK'><span class='icon-user-plus2'></span>正常</a>";
							} else {
								echo "<a style='cursor: default;' class='btn btn-danger rightCHK'><span class='icon-user-cancel2'></span>停權</a>";
							}
							?>
						</td>
						<td>
							<div class="btn-group">
								<a href="<?=$modify . "&id=" . $admin["id"];?>" class="btn btn-icon btn-danger modifybu"><i class="icon-wrench2"></i></a>
							</div>
							<?php if($row_login['id'] != $admin["id"]) {?>
							<div class="btn-group delete">
								<a onclick="deletelist('<?php echo site_url('backend/admin/delete')."?panel=".$this->input->get('panel')."&id=".$admin["id"];?>')" href="#" class="btn btn-icon btn-success modifybu"><i class="icon-remove"></i></a>
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

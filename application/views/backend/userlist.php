<?php
include("layout/list_partials.php");
$users=$this->db->order_by('id', 'desc')->get_where('users', array(
))->result_array();

?>
<!--Datatable with tools menu -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-table"></i><?=$name2?>列表</h6>	
		<!-- <a href="<?=$insert?>" class="btn btn-success pull-right"><span class="icon-plus"></span> <?=$name2;?>新增</a> -->
		<a href="<?=site_url("backend/ExportExcel/memberExcel");?>" class="btn btn-success pull-right" value=""><span class="icon-download"></span>  匯出會員資料</a>
	</div>
	<div class="datatable-tools">
		<table class="table">
			<thead>
				<tr>
					<th>編號</th>
					<th>帳號</th>
					<th>手機</th>
					<th>姓名</th>
					<th>會員身分</th>
					<th>狀態</th>
					<th>註冊時間</th>
					<th>功能</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($users as $key => $user) {
				?>
					<tr>
						<td>
							<?=$user['id']?>
						</td>
						<td><?=$user["account"];?></td>
						<td><?=$user["phone"];?></td>
						<td><?=$user["name"];?></td>
						<td><?=($user["member_level"]==1)?"黃金會員":"一般會員";?></td>
						<td>
							<?php if ($user['isactive']==1) { ?>
								<a href='###' id='open<?=$user["id"]?>' class='btn btn-success rightCHK' onclick="showUrl('user/show','<?=$user["id"]?>','open')">
								<span class='icon-user-plus2'></span>正常</a>
								<a style = "display:none" href='###' id='close<?=$user["id"]?>' class='btn btn-danger rightCHK' onclick="showUrl('user/show','<?=$user["id"]?>','close')">
								<span class='icon-user-cancel2'></span>停權</a>
							<?php }else{ ?>
								<a style = "display:none" href='###' id='open<?=$user["id"]?>' class='btn btn-success rightCHK' onclick="showUrl('user/show','<?=$user["id"]?>','open')">
								<span class='icon-user-plus2'></span>正常</a>
								<a href='###' id='close<?=$user["id"]?>' class='btn btn-danger rightCHK' onclick="showUrl('user/show','<?=$user["id"]?>','close')">
								<span class='icon-user-cancel2'></span>停權</a>
							<?php } ?>
						</td>
						<td><?=$user["dt"];?></td>
						<td>
							<div class="btn-group" >
								<a href="<?=$modify . "&id=" . $user["id"];?>" class="btn btn-icon btn-danger modifybu"><i class="icon-wrench2"></i></a>
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

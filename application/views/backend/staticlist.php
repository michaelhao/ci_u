<?php
include("layout/list_partials.php");
$statics=$this->db->get_where('static', array(
	'panel' => $this->input->get('panel'), 
))->result_array();
?>
<!--Datatable with tools menu -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-table"></i><?=$name2?>列表</h6>	
	</div>
	<div class="datatable-tools">
		<table class="table">
			<thead>
				<tr>
					<th>標題</th>
					<th>功能</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($statics as $key => $static) {
				?>
					<tr>
						<td><?=$static["name"];?></td>
						<td>
							<div class="btn-group" >
								<a href="<?=$modify . "&id=" . $static["id"];?>" class="btn btn-icon btn-danger modifybu"><i class="icon-wrench2"></i></a>
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

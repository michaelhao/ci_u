<?php
include("layout/list_partials.php");
$stores=$this->db->order_by('sort','desc')->get_where('store', array(
	'Recover' => 0, 
	'panel' => $this->input->get('panel'), 
))->result_array();

$CI =& get_instance();
$CI->load->library('image');
$stores = $CI->image->getImage($stores);
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
					<th>排序</th>
					<th>圖片</th>
					<th>標題</th>
					<th>副標題</th>
					<th>上架狀態</th>
					<th>功能</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($stores as $key => $store) {
				?>
					<tr>
						<td>
							<input id="list_sort_<?=$store["id"]?>" type="text" class="form-control list_sort" value="<?=$store["sort"]?>">
							<span class="btn btn-icon btn-info btn-xs" onclick="sortUrl('store/sort','<?=$store["id"]?>')">
								送出
							</span>
						</td>
						<td>
							<?php if(!empty($store["pic"])) { ?>
							<a href="<?=$store["pic"];?>" class="lightbox">
								<img src="<?=$store["pic"];?>" alt="" class="img-media">
							</a>
							<?php } ?>
						</td>
						<td><?=$store["name"]?></td>
						<td><?=$store["field1"]?></td>
						<td>
							<?php if ($store['show']==1) { ?>
								<a href='###' id='open<?=$store["id"]?>' class='btn btn-success rightCHK' onclick="showUrl('store/show','<?=$store["id"]?>','open')">
								<span class='icon-user-plus2'></span>顯示</a>
								<a style = "display:none" href='###' id='close<?=$store["id"]?>' class='btn btn-danger rightCHK' onclick="showUrl('store/show','<?=$store["id"]?>','close')">
								<span class='icon-user-plus2'></span>隱藏</a>
							<?php }else{ ?>
								<a style = "display:none" href='###' id='open<?=$store["id"]?>' class='btn btn-success rightCHK' onclick="showUrl('store/show','<?=$store["id"]?>','open')">
								<span class='icon-user-plus2'></span>顯示</a>
								<a href='###' id='close<?=$store["id"]?>' class='btn btn-danger rightCHK' onclick="showUrl('store/show','<?=$store["id"]?>','close')">
								<span class='icon-user-plus2'></span>隱藏</a>
							<?php } ?>
						</td>
						<td>
							<div class="btn-group" >
								<a href="<?=$modify . "&id=" . $store["id"];?>" class="btn btn-icon btn-danger modifybu"><i class="icon-wrench2"></i></a>
							</div>
							<div class="btn-group delete">
								<a onclick="deletelist('<?php echo "store/delete?panel=".$this->input->get('panel')."&id=".$store["id"];?>')" href="#" class="btn btn-icon btn-success modifybu"><i class="icon-remove"></i></a>
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

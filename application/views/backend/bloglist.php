<?php
include("layout/list_partials.php");
$articles=$this->db->order_by('start_at','desc')->get_where('article', array(
	'Recover' => 0, 
	'panel' => $this->input->get('panel'), 
))->result_array();

// 取得圖片
$CI =& get_instance();
$CI->load->library('image');
$articles = $CI->image->getImage($articles);
// 抓取管理者類別
foreach ($articles as $key => $article) {
	// 取得類別
	$articletype = $this->db->get_where(
		'type', array('id' => $article['type'],
	))->row_array();
	$articles[$key]['type_str'] = $articletype['name'];
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
					<th>日期</th>
					<th>類別</th>
					<th>圖片</th>
					<th>標題</th>
					<th>上架狀態</th>
					<th>功能</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($articles as $key => $article) {
				?>
					<tr>
						<td><?=date('Y-m-d',strtotime($article["start_at"]));?></td>
						<td><?=$article["type_str"];?></td>
						<td>
							<?php if(!empty($article["pic"])) { ?>
							<a href="<?=$article["pic"];?>" class="lightbox">
								<img src="<?=$article["pic"];?>" alt="" class="img-media">
							</a>
							<?php } ?>
						</td>
						<td><?=$article["name"];?></td>
						<td>
							<?php if ($article['show'] == 1) { ?>
								<a href='###' id='open<?=$article["id"] ?>' class='btn btn-success rightCHK' onclick="showUrl('article/show','<?=$article["id"] ?>','open')">
								<span class='icon-user-plus2'></span>顯示</a>
								<a style = "display:none" href='###' id='close<?=$article["id"] ?>' class='btn btn-danger rightCHK' onclick="showUrl('article/show','<?=$article["id"] ?>','close')">
								<span class='icon-user-cancel2'></span>隱藏</a>
							<?php } else { ?>
								<a style = "display:none" href='###' id='open<?=$article["id"] ?>' class='btn btn-success rightCHK' onclick="showUrl('article/show','<?=$article["id"] ?>','open')">
								<span class='icon-user-plus2'></span>顯示</a>
								<a href='###' id='close<?=$article["id"] ?>' class='btn btn-danger rightCHK' onclick="showUrl('article/show','<?=$article["id"] ?>','close')">
								<span class='icon-user-cancel2'></span>隱藏</a>
							<?php } ?>
						</td>
						<td>
							<div class="btn-group" >
								<a href="<?=$modify . "&id=" . $article["id"];?>" class="btn btn-icon btn-danger modifybu"><i class="icon-wrench2"></i></a>
							</div>
							<div class="btn-group delete">
								<a onclick="deletelist('<?php echo "article/delete?panel=".$this->input->get('panel')."&id=".$article["id"];?>')" href="#" class="btn btn-icon btn-success modifybu"><i class="icon-remove"></i></a>
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

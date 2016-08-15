<?php
include("layout/list_partials.php");

// 抓取 TYPE
$CI =& get_instance();
$CI->load->library('typelist');
$type = $this->input->get('type');
if ($type!=null) {
	$type_name = $this->db->get_where('type', array('id'=>$type))->row_array();
}
$type_array = $CI->typelist->under_type($type);

// 抓取產品
$products   = $this->db->order_by('sort','desc')->select('*')->from('product')->where('Recover', 0)->where_in('type', $type_array)->get()->result_array();
// 抓取管理者類別
foreach ($products as $key => $product) {
   // 取得圖片
   $product_image = $this->db->get_where('image', array(
      'source_id' => $product['id'],
      'panel' => $product['panel'],
      'recover' => 0
   ))->row_array();
   
   // 設定圖片路徑
   if (!empty($product_image['file_name'])) {
      $products[$key]['pic'] = base_url('assert/files/files/' . $product_image['file_name']);
   } else {
      $products[$key]['pic'] = '';
   }
   
   // 取得類別
   $producttype = $this->db->get_where('type', array(
      'id' => $product['type']
   ))->row_array();
   $products[$key]['type_str'] = $producttype['name'];
}

$all_type_array = $CI->typelist->type_list(1);//1.產品管理
?>

<!--Datatable with tools menu -->
<div class="panel panel-default">
	<div class="panel-heading">
      <label style="margin-top: 3px;">
		<select id="kind" onchange="sel_type(this.options[this.options.selectedIndex].value)" class="required select">
			<?php if ($type==null) {?>
				<option value="0">選擇產品類別</option>
			<?php }else{ ?>
				<option value="<?=$type?>"><?=$type_name['name'];?></option>
			<?php }?>
			<?php foreach ($all_type_array as $key => $type) { ?>
				<option value="<?=$type['id']; ?>"><?=$type['name']; ?></option>
			<?php } ?>
		</select>
      </label>

		<h6 class="panel-title"><i class="icon-table"></i><?=$name2 ?>列表</h6>
		<!-- <a href="<?=$type ?>" class="btn btn-warning pull-right"><span class="icon-upload"></span> <?=$name2; ?>上傳</a>	 -->
		<a href="<?=$insert ?>" class="btn btn-success pull-right"><span class="icon-plus"></span> <?=$name2; ?>新增</a>
	</div>
	<div class="datatable-tools">
		<table class="table">
			<thead>
				<tr>
					<th>排序</th>
					<th>類別</th>
					<th>圖片</th>
					<th>標題</th>
					<th>商品種類</th>
					<th>上架狀態</th>
					<th>功能</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($products as $key => $product) { ?>
					<tr>
						<td>
							<input id="list_sort_<?=$product["id"] ?>" type="text" class="form-control list_sort" value="<?=$product["sort"] ?>">
							<span class="btn btn-icon btn-info btn-xs" onclick="sortUrl('product/sort','<?=$product["id"] ?>')">
								送出
							</span>
						</td>
						<td><?=$product["type_str"]; ?></td>
						<td>
							<?php if (!empty($product["pic"])) { ?>
							<a href="<?=$product["pic"]; ?>" class="lightbox">
								<img src="<?=$product["pic"]; ?>" alt="" class="img-media">
							</a>
							<?php } ?>
						</td>
						<td><?=$product["name"]; ?></td>
						<td><?php ; 
						switch ($product["kind"]) {
							case 1:
								echo "電商品項";
								break;
							case 2:
								echo "實體品項";
								break;
							case 3:
								echo "兩者皆有";
								break;
							default:
								echo "error";
								break;
						}?></td>
						<td>
							<?php if ($product['show'] == 1) { ?>
								<a href='###' id='open<?=$product["id"] ?>' class='btn btn-success rightCHK' onclick="showUrl('product/show','<?=$product["id"] ?>','open')">
								<span class='icon-user-plus2'></span>顯示</a>
								<a style = "display:none" href='###' id='close<?=$product["id"] ?>' class='btn btn-danger rightCHK' onclick="showUrl('product/show','<?=$product["id"] ?>','close')">
								<span class='icon-user-cancel2'></span>隱藏</a>
							<?php } else { ?>
								<a style = "display:none" href='###' id='open<?=$product["id"] ?>' class='btn btn-success rightCHK' onclick="showUrl('product/show','<?=$product["id"] ?>','open')">
								<span class='icon-user-plus2'></span>顯示</a>
								<a href='###' id='close<?=$product["id"] ?>' class='btn btn-danger rightCHK' onclick="showUrl('product/show','<?=$product["id"] ?>','close')">
								<span class='icon-user-cancel2'></span>隱藏</a>
							<?php } ?>
							
						</td>

						
						<td>
							<div class="btn-group" >
								<a href="<?=$modify . "&id=" . $product["id"]; ?>" class="btn btn-icon btn-danger modifybu"><i class="icon-wrench2"></i></a>
							</div>
							<div class="btn-group delete">
								<a onclick="deletelist('<?php echo "product/delete?panel=" . $this->input->get('panel') . "&id=" . $product["id"];
?>')" href="#" class="btn btn-icon btn-success modifybu"><i class="icon-remove"></i></a>
							</div>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
	<!-- /datatable with tools menu -->
<script>
function sel_type(type) 
{ 
    window.location = "<?=site_url('backend/page?panel=11&type='); ?>"+type;
}
</script>

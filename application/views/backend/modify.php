<?php
$panel;
$id;

// print_r($id);
if($this->input->get("a")){
	$panel=$this->input->get("a");
}
if($panel==1){
	$id=$this->input->get("b");
	$row = $this->db->get_where('bannertable', array('id' => $id, ))->row_array();
?>
<!-- 表單開始 -->
<form class="form-horizontal validate" action="DB_Modify_Home?panel=1&id=<?=$id?>" role="form" method="post">
	<div class="block">
		<h6 class="heading-hr"><i class="icon-checkmark-circle"></i>
			<!-- 顯示分頁名稱 -->
			<?php

			if ($this->input->get("mpanel")) {
				$id=$this->input->get("mpanel");
				// echo $id;
				$row_submenu_2=select_submenu($id);
				echo $row_submenu_2["name"] . "修改";
				$name2=$row_submenu_2["name"];
			}
			else{
				$row_submenu_2=select_submenu("1");
				echo $row_submenu_2["name"] . "修改";
				$id=1;
				$name2=$row_submenu_2["name"];
				}
			?>
			<!-- 顯示分頁名稱 -->
		</h6>
	
		<div class="form-group">
			<label class="col-sm-2 control-label">主圖: <span class="mandatory">*</span></label>
			<div class="col-sm-10">
				<input id="xFilePath" class="" name="pic1" type="text" size="60" placeholder="圖片尺寸：W1920XH850" value="<?= $row["pic1"]?>" />
				<input type="button" value="Browse Server" onclick="BrowseServer();" />
			</div>
		</div>
		
		<div class="form-actions text-right">
			<input type="submit" value="修改內容" class="btn btn-primary">
		</div>
	</div>
	</form>
<!--表單結束-->
<?php
}
?>
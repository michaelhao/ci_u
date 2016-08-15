<?php
// 取出索引欄位中的資料值
if(!$this->input->get('id'))
	$id = 1;
else
	$id = $this->input->get('id');
// Modify End Btn
$form_end_button = '
<div class="form-actions text-right">
	<input type="button" value="回前一頁" class="btn btn-warning" onclick="window.location.href = \''.site_url('backend/page?panel=').$this->input->get('mpanel').'\'">
	<input type="submit" value="確認" class="btn btn-primary">
</div>';
?>
<div class="block">
	<h6 class="heading-hr"><i class="icon-checkmark-circle"></i>
		<!-- 顯示分頁名稱 -->
		<?php
		if ($this->input->get("mpanel")) {
			// 取得 Ariticle 頁面顯示 
			$id=$this->input->get("mpanel");
			$row_submenu_2=select_submenu($id);
			echo $row_submenu_2["name"] . "修改";
			$name2=$row_submenu_2["name"];
		} elseif ($this->input->get("panel")) {
			// 取得 Static 頁面顯示
			$id=$this->input->get("panel");
			$row_submenu_2=select_submenu($id);
			echo $row_submenu_2["name"] . "修改";
			$name2=$row_submenu_2["name"];
		} else{
			// 若無參數預設為首頁
			$row_submenu_2=select_submenu("1");
			echo $row_submenu_2["name"] . "修改";
			$id=1;
			$name2=$row_submenu_2["name"];
		}
		?>
		<!-- 顯示分頁名稱 -->
	</h6>
</div>
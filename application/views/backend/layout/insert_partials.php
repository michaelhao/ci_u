<?php
$row_submenu_2=select_submenu($id);
$name2=$row_submenu_2["name"];

// Insert End Btn
$form_end_button = '
	<div class="form-actions text-right">
		<input type="button" value="回前一頁" class="btn btn-warning" onclick="window.location.href = \''.site_url('backend/page?panel=').$this->input->get('ipanel').'\'">
		<input type="submit" value="新增" class="btn btn-primary">
	</div>';
?>
<div class="block">
	<h6 class="heading-hr"><i class="icon-checkmark-circle"></i><?=$name2?>新增</h6>
</div>
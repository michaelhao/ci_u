<?php
function fileupload_file_html($file_number) {
    // 上傳檔案
    $single_fileupload = '<span id="single_fileupload_'.$file_number.'" class="btn btn-success fileinput-button" type="file">
                               <i class="glyphicon glyphicon-plus"></i>
                               <span>選擇檔案</span>
                               
                               <input id="file_'.$file_number.'" type="file" name="file" class="btn btn-success"/>
                               
                           </span>
                           <span id="file_message_'.$file_number.'"><span>
                           ';

    $single_fileupload .= '
<script>
    $("#file_'.$file_number.'").change(function() {
      $("input[name=\"file\"]").each(function() {
        var fileName = $(this).val().split("/").pop().split("\\\\").pop();
        $("#file_message_'.$file_number.'").text(fileName);
        console.log(fileName);
      });
    });
</script>';
    return $single_fileupload;
}

?>


<?php
$row_submenu_2=select_submenu($id);
$name2=$row_submenu_2["name"];

// Insert End Btn
$form_end_button = '
	<div class="form-actions text-right">
		<input type="button" value="回前一頁" class="btn btn-warning" onclick="window.history.back()">
		<input type="submit" value="上傳" class="btn btn-primary">
	</div>';
?>
<div class="block">
	<h6 class="heading-hr"><i class="icon-checkmark-circle"></i><?=$name2?>上傳</h6>
</div>
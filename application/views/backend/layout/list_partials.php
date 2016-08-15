<?php
// 取得 LINK
$id = '';
$name2 = '';
$insert = '';
$modify = '';
$link = '';
$recover = '';
$type = '';
if ($this->input->get('panel')) {
	$id=$this->input->get('panel');
	$row_submenu_2=select_submenu($id);			
	$name2=$row_submenu_2["name"];
	$insert=$row_submenu_2["insertlink"];
	$modify=$row_submenu_2["modifylink"];
	$link=$row_submenu_2["link"];
	$recover=$row_submenu_2["recoverlink"];
	$type=$row_submenu_2["typelink"];
}
?>
<script>
function deletelist(url) {
	if (confirm("確認是否要刪除資料。")) {
		window.location.href = url;
	}
}
function sortUrl(url, id) {
    $.ajax({
        url : url,
        type: "get",
        data : {
            'id' : id,
            'sort' : $("#list_sort_"+id).val()
        },
        success: function(data, textStatus, jqXHR)
        {
        	window.location.reload();
			// new jBox('Notice', {
			//     animation: 'flip',
			//     autoClose: 5000,
   //          	theme: '',
			//     position: {
			//         x: 15,
			//         y: 65
			//     },
			//     content: '<div class=\"btn btn-success\"><div class=\"btn\">✔ 排序資料成功。</div></div>',
			//     zIndex: 12000
			// });
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
        }
    });
}

function showUrl(url, id, show_static) {
	if(show_static=="open"){
			$("#open"+id).hide();
			$("#close"+id).show();

	}else{
			$("#open"+id).show();
			$("#close"+id).hide();
	}
    $.ajax({
        url : url,
        type: "get",
        data : {
            'id' : id,
            'show_static' : show_static,
        },
        success: function(data, textStatus, jqXHR)
        {
        	
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
        }
    });
}

</script>

	

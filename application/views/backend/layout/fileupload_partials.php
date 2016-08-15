<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?=base_url()?>public/backend/js/jquery.ui.widget.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?=base_url()?>public/backend/js/load-image.all.min.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?=base_url()?>public/backend/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?=base_url()?>public/backend/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?=base_url()?>public/backend/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?=base_url()?>public/backend/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?=base_url()?>public/backend/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?=base_url()?>public/backend/js/jquery.fileupload-validate.js"></script>
<script>
function deleteImg(id) {
    if (confirm("確認是否要刪除資料。")) {
        window.location.href = "image/delete?panel=<?=$this->input->get('mpanel')?>&id="+id;
    }
}
</script>

<?php
function get_single_fileupload_html($file_number, $filepath = 'assert/files/files/') {
    $CI =&get_instance();
    $time = time();
    // 編輯頁面會抓取 IMAGES 的資料
    $image_html = '';
    $upload_btn_style = '';

    // Article 頁面編輯頁
    if($CI->input->get('mpanel') && $CI->input->get('id')) {
        // 取得圖片
        $images = $CI->db->get_where('image', array(
            'source_id' => $CI->input->get('id'), 
            'panel' => $CI->input->get('mpanel'), 
            'file_number' => $file_number,
            'recover' => 0, 
        ))->result_array();

        foreach ($images as $key => $image) {
            // if ($CI->input->get('mpanel')==11) {
            //     $image_html .= '<div>
            //                     <a href="#" onclick="deleteImg('.$image['id'].')">
            //                         <p>
            //                             <img src="'.base_url('assert/files/package/'.$image['file_timestamp'].'/images/'.$image['file_name']).'" width="100">
            //                             <br><a>'.$image['file_name'].'</a><br>
            //                         </p>
            //                     </a>
            //                 </div>';
            // }else{
                $image_html .= '<div>
                                <a href="#" onclick="deleteImg('.$image['id'].')">
                                    <p>
                                        <img src="'.base_url($filepath.$image['file_name']).'" width="100">
                                        <br><a>'.$image['file_name'].'</a><br>
                                    </p>
                                </a>
                            </div>';
            // }
        }

        if($images)
            $upload_btn_style = 'style="display: none;';
        
    }

    // Static 單頁
    if($CI->input->get('panel')) {
        // 取得圖片
        $images = $CI->db->get_where('image', array(
            'panel' => $CI->input->get('panel'), 
            'field_number' => $file_number,
            'recover' => 0, 
        ))->result_array();

        foreach ($images as $key => $image) {
            // if ($CI->input->get('mpanel')==11) {
            //     $image_html .= '<div>
            //                     <a href="#" onclick="deleteImg('.$image['id'].')">
            //                         <p>
            //                             <img src="'.base_url('assert/files/package/'.$image['file_timestamp'].'/images/'.$image['file_name']).'" width="100">
            //                             <br><a>'.$image['file_name'].'</a><br>
            //                         </p>
            //                     </a>
            //                 </div>';
            // }else{
                $image_html .= '<div>
                                <a href="#" onclick="deleteImg('.$image['id'].')">
                                    <p>
                                        <img src="'.base_url($filepath.$image['file_name']).'" width="100">
                                        <br><a>'.$image['file_name'].'</a><br>
                                    </p>
                                </a>
                            </div>';
            // }
        }

        if($images)
            $upload_btn_style = 'style="display: none;';
    }


    // 單圖
    $single_fileupload = '<span id="single_fileupload_'.$file_number.'" class="btn btn-success fileinput-button"'.$upload_btn_style.'>
                               <i class="glyphicon glyphicon-plus"></i>
                               <span>圖片上傳</span>
                               <input id="fileupload_'.$file_number.'" type="file" name="files[]" multiple>
                               <input type="hidden" name="file_timestamp" value="'.$time.'">
                           </span>
                           <div id="files_'.$file_number.'" class="files">'.$image_html.'
                           </div>';

    $single_fileupload .= '
<script>
   // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === "blueimp.github.io" ?
                "//jquery-file-upload.appspot.com/" : "../../assert/files/";
    $("#fileupload_'.$file_number.'").fileupload({
        url: url,
        dataType: "json",
        acceptFileTypes: /(\.|\/)(gif|jpg|png)$/i,
        maxFileSize: 999000,
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        }).on("fileuploadadd", function (e, data) {
    data.context = $("<div/>").appendTo("#files_'.$file_number.'");
    $.each(data.files, function (index, file) {
        var node = $("<p/>")
                .append($("<span/>"));
        if (!index) {
            node
                .append("<br>");
        }
        node.appendTo(data.context);
    });
   }).on("fileuploadprocessalways", function (e, data) {
    var index = data.index,
        file = data.files[index],
        node = $(data.context.children()[index]);
    if (file.preview) {
        node
            .prepend("<br>")
            .prepend(file.preview);
    }
    if (file.error) {
        node
            .append("<br>")
            .append($("<span class=\'text-danger\'/>").text(file.error));
    }
    if (index + 1 === data.files.length) {
        data.context.find("button")
            .text("Upload")
            .prop("disabled", !!data.files.error);
    }
   }).on("fileuploaddone", function (e, data) {
    $.each(data.result.files, function (index, file) {
        if (file.url) {
            var link = $("<a>")
                .attr("target", "_blank")
                .prop("href", file.url);
            $(data.context.children()[index])
                .wrap(link);
        } else if (file.error) {
            var error = $("<span class=\'text-danger\'/>").text(file.error);
            $(data.context.children()[index])
                .append("<br>")
                .append(error);
        }
    });
        $.each(data.result.files, function (index, file) {
            $("<p/>").text(file.name).appendTo("#files_'.$file_number.'");
            $.ajax({
                url : "image/insert",
                type: "POST",
                data : {
                    "panel" : $("input[name*=\'panel\']").attr("value"),
                    "file_timestamp" : $("input[name*=\'file_timestamp\']").attr("value"),
                    "file_number" : '.$file_number.',
                    "file_type" : file.type,
                    "file_size" : file.size,
                    "file_name" : file.name,
                    "thumbnailUrl" : (file.thumbnailUrl)?file.thumbnailUrl:"",
                    "url" : file.url,
                    "deleteUrl" : file.deleteUrl
            }});
        });
        $("#single_fileupload_'.$file_number.'").hide();
   }).on("fileuploadfail", function (e, data) {
    $.each(data.files, function (index) {
        var error = $("<span class=\'text-danger\'/>").text("File upload failed.");
        $(data.context.children()[index])
            .text(error);
    });
    
    }).prop("disabled", !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : "disabled");
</script>';

    return $single_fileupload;
}

?>
<?php
include("layout/modify_partials.php");
include("layout/fileupload_partials.php");
// 取出索引欄位中的資料值
$id=$this->input->get("id");
$row=$this->db->get_where('static', array('id' => 5))->row_array();
$users=$this->db->get_where('users', array('isactive' => 1))->result_array();

$checkboxs = explode(',', $row['field2']);

$users_checkboxs = array();

if(in_array(0, $checkboxs) && $row['field2'] != '') {
	$users_checkboxs[] = array(
		'id' => 'field2_0', 
	    'value' => 0,
	    'label' => 'ALL',
	    'checked' => 'checked'
	);
} else {
	$users_checkboxs[] = array(
		'id' => 'field2_0', 
	    'value' => 0,
	    'label' => 'ALL',
	);
}
foreach ($users as $key => $user) {
	if($user['email'] != '') {
		if(in_array($user['id'], $checkboxs)) {
			$users_checkboxs[] = array(
				'id' => 'field2_'.$user['id'], 
			    'value' => $user['id'],
			    'label' => $user['email'],
			    'checked' => 'checked'
			);
		} else {
			$users_checkboxs[] = array(
				'id' => 'field2_'.$user['id'], 
			    'value' => $user['id'],
			    'label' => $user['email'],
			);
		}
	}
}

?>

<!-- 表單開始 -->
<?php
// Start Form
echo $this->form_builder->open_form(
	array(
		'role' => 'form',
		'action' => 'backend/edm/modify',
		'method' => 'post'
	)
);
// Form Input
echo $this->form_builder->build_form_horizontal(
    array(
	    array(
	        'id' => 'id',
	        'type' => 'hidden',
	        'value' => $this->input->get('id')
	    ),
	    array(
	        'id' => 'panel',
	        'type' => 'hidden',
	        'value' => $this->input->get('panel')
	    ),
	    
	    array(
	        'id' => 'name',
	        'label' => '頁面名稱:',
	        'value' => $row['name'],
	        'disabled' => 'disabled'
	    ),
	    
	    array(
	        'id' => 'field1',
	        'label' => '信件主旨:',
	        'value' => $row['field1'],
	        'class' => 'required'
	    ),
	    array(
	        'id' => 'content',
	        'type' => 'textarea',
	        'label' => '內頁內容:',
	        'class' => 'required ckeditor'
	    ),
        // array(
        //     'id' => 'field2[]',
        //     'label' => '收件者:',
        //     'type' => 'checkbox',
        //     'options' => $users_checkboxs
        // ),
	    array(
	        'id' => 'field2',
	        'type' => 'html',
	        'label' => '收件者:',
	        'html' => '
	        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><span class="icon-user-plus2"></span>選擇收件人</button>',
	    ),
), $row);

echo '
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">選擇收件人</h4>
      </div>
      <div class="modal-body">
<table class="table"> 
	<thead> <tr> <th>#</th> <th>信箱</th></tr> </thead> <tbody>';
// Form Input
foreach ($users_checkboxs as $key => $users_checkbox) {
	if(empty($users_checkbox['checked'])) {
		echo '<tr> <th scope="row"><label class="checkbox-inline"><input type="checkbox" name="field2[]" value="'.$users_checkbox['value'].'" id="field2[]" label="'.$users_checkbox['label'].'"> </label></th> <td>'.$users_checkbox['label'].'</td></tr>';
	} else {
		echo '<tr> <th scope="row"><label class="checkbox-inline"><input checked="checked" type="checkbox" name="field2[]" value="'.$users_checkbox['value'].'" id="field2[]" label="'.$users_checkbox['label'].'"> </label></th> <td>'.$users_checkbox['label'].'</td></tr>';
	}
}
echo '
</tbody> </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">確定</button>
      </div>
    </div>
  </div>
</div>
';
// Modify End Btn
$form_end_button = '
<div class="form-actions text-right">
	<a class="btn btn-warning" href="'.site_url('backend/edm/send_email').'?panel='.$this->input->get('panel').'">寄送電子報</a>
	<input type="submit" value="修改" class="btn btn-primary">
</div>';
// End Button
echo $form_end_button;
// End Form
echo $this->form_builder->close_form();;
?>
<!-- 表單結束 -->
<?php
include("layout/modify_partials.php");
include("layout/fileupload_partials.php");
// 取出索引欄位中的資料值
$smtp_host=$this->db->get_where('config', array('setting' => 'smtp_host',))->row_array();
$smtp_port=$this->db->get_where('config', array('setting' => 'smtp_port',))->row_array();
$site_name=$this->db->get_where('config', array('setting' => 'site_name',))->row_array();
$smtp_username=$this->db->get_where('config', array('setting' => 'smtp_username',))->row_array();
$smtp_password=$this->db->get_where('config', array('setting' => 'smtp_password',))->row_array();

$row = array();
?>

<!-- 表單開始 -->
<?php
// Start Form
echo $this->form_builder->open_form(
	array(
		'role' => 'form',
		'action' => 'backend/ContactusPage/modify',
		'method' => 'post'
	)
);
// Form Input
echo $this->form_builder->build_form_horizontal(
    array(
	    array(
	        'id' => 'panel',
	        'type' => 'hidden',
	        'value' => $this->input->get('panel')
	    ),
	    array(
	        'id' => 'site_name',
	        'label' => '寄件者名稱:',
	        'class' => 'required',
	        'value' => $site_name['value']
	    ),
	    array(
	        'id' => 'smtp_host',
	        'label' => 'SMTP HOST:',
	        'class' => 'required',
	        'value' => $smtp_host['value']
	    ),
	    array(
	        'id' => 'smtp_port',
	        'label' => 'SMTP PORT:',
	        'class' => 'required',
	        'value' => $smtp_port['value']
	    ),
	    array(
	        'id' => 'smtp_username',
	        'label' => '信箱帳號:',
	        'class' => 'required',
	        'value' => $smtp_username['value']
	    ),
	    array(
	        'id' => 'smtp_password',
	        'type' => 'password',
	        'label' => '信箱密碼:',
	        'class' => 'required',
	        'value' => $smtp_password['value']
	    ),
), $row);

// End Button
echo $form_end_button;
// End Form
echo $this->form_builder->close_form();;
?>
<!-- 表單結束 -->
<?php
// 網站資訊
$row_webinfo = $this->db->get('backadmin')->row_array();

// 登入會員
$row_login = $this->session->userdata('manage');
// p($row_login);
// 主要選單
$row_menu = $this->db->order_by('sort','asc')->get_where('backmainmenu', array('showhide' => 1, ));//$_SESSION['admin_Username']
$logoutOK = "page?doLogout=true";

// 內頁導覽列選單
$row_submenu = $this->db->get_where('backmainmenu', array('showhide' => 1, ))->row_array();//$_SESSION['admin_Username']

?>
<!DOCTYPE html>
<html lang="zh-tw">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex, nofollow" />
	<title><?=$row_webinfo["webtitle"];?></title>
	<link href="<?=base_url()?>public/backend/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>public/backend/css/londinium-theme.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>public/backend/css/jquery.fileupload.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>public/backend/css/jBox.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>public/backend/css/styles.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>public/backend/css/icons.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?=base_url()?>public/backend/bower_components/angular-ui-tree/dist/angular-ui-tree.min.css">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.3/angular.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/charts/sparkline.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/forms/uniform.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/forms/select2.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/forms/inputmask.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/forms/autosize.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/forms/inputlimit.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/forms/listbox.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/forms/multiselect.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/forms/validate.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/forms/tags.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/forms/switch.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/forms/uploader/plupload.full.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/forms/uploader/plupload.queue.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/forms/wysihtml5/wysihtml5.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/forms/wysihtml5/toolbar.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/interface/daterangepicker.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/interface/fancybox.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/interface/moment.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/interface/jgrowl.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/interface/datatables.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/interface/tabletools.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/interface/colorpicker.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/interface/fullcalendar.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/interface/timepicker.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/interface/collapsible.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/interface/jBox.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/underscore-min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/js/application.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/ckfinder/ckfinder.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/backend/bower_components/angular-ui-tree/dist/angular-ui-tree.js"></script>

</head>
<body class="sidebar-wide">
<!-- <body class="sidebar-wide" oncut="return false" oncopy="return false" onselectstart="return false"> -->
	<!-- Navbar -->
	<div class="navbar navbar-inverse" role="navigation">
		<div class="navbar-header">
			<a class="navbar-brand" href="page"><img src="<?=base_url()?>public/backend/images/logo.png" alt="Londinium"></a>
			<a class="sidebar-toggle"><i class="icon-paragraph-justify2"></i></a>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-icons">
				<span class="sr-only">Toggle navbar</span>
				<i class="icon-grid3"></i>
			</button>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar">
				<span class="sr-only">Toggle navigation</span>
				<i class="icon-paragraph-justify2"></i>
			</button>
		</div>
		<ul class="nav navbar-nav navbar-right collapse" id="navbar-icons">
			<li class="user dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">
					<span id="chklog"><?php echo $row_login["name"];?></span>
					<i class="caret"></i>
				</a>
				<ul class="dropdown-menu dropdown-menu-right icons-right">

					<li><a href="<?php echo $logoutOK?>"><i class="icon-exit"></i> 登出</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<!-- /navbar -->
	<!-- Page container -->
	<div class="page-container">
		<!-- Sidebar -->
		<div class="sidebar collapse">
			<div class="sidebar-content">
				<!-- User dropdown -->
				<div class="user-menu dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<div class="user-info">
							<?php echo $row_login["name"];?>
						</div>
					</a>
					<div class="popup dropdown-menu dropdown-menu-right">
						<div class="thumbnail">
							<div class="thumb">
								<div class="thumb-options">
									<span>
<!-- 										<a href="setting.php" class="btn btn-icon btn-success"><i class="icon-pencil"></i></a>
 -->
									</span>
								</div>
							</div>

							<div class="caption text-center">
								<h6><?php echo $row_login["name"];?></h6>
							</div>
						</div>

					</div>
				</div>
				<!-- /user dropdown -->
				<!-- Main navigation -->
				<ul class="navigation">
<?php
$i = 0;
foreach ($row_menu->result_array() as $key => $value) {
	$i++;
	if(($row_login['title'] == 1 && $value["admintype1_permission"] == 1 ) || 
		($row_login['title'] == 2 && $value["admintype2_permission"] == 1 ) ||
		($row_login['title'] == 3 && $value["admintype3_permission"] == 1 )) {
?>
	<li><a href="<?php echo site_url('backend/'.$value["link"]) . "?panel=" . $value["id"]?>"><span><?=$value["name"]?></span></a></li>
<?php
}}?>
				</ul>
				<!-- /main navigation -->
			</div>
		</div>
		<script>
			<?php 
				$notification = $this->session->flashdata('notification');
				if ($notification['status'] == 'success') {
					$notification_content = '<div class=\"btn btn-success\"><div class=\"btn\">✔ '.$notification['message'].'</div></div>';
				} elseif ($notification['status'] == 'error') {
					$notification_content = '<div class=\"btn btn-danger\"><div class=\"btn\">✖ '.$notification['message'].'</div></div>';
				}

				if(!empty($notification_content)) {
			?>
			new jBox('Notice', {
			    animation: 'flip',
			    autoClose: 5000,
            	theme: '',
			    position: {
			        x: 15,
			        y: 65
			    },
			    content: '<?=$notification_content?>',
			    zIndex: 12000
			});
			<?php
				}
			?>
		</script>
			<!-- /sidebar -->
<?php
// 網站資料匯入
$row_webinfo = $this->db->get('backadmin')->row_array();
?>
<!DOCTYPE html>
<html lang="zh-tw">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?=$row_webinfo["webtitle"];?></title>
		<link href="<?=base_url()?>public/backend/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="<?=base_url()?>public/backend/css/londinium-theme.css" rel="stylesheet" type="text/css">
		<link href="<?=base_url()?>public/backend/css/styles.css" rel="stylesheet" type="text/css">
		<link href="<?=base_url()?>public/backend/css/icons.css" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="<?=base_url()?>public/backend/css/style_captcha.css" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
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
		<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/interface/colorpicker.js"></script>
		<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/interface/fullcalendar.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/interface/timepicker.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>public/backend/js/plugins/interface/collapsible.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>public/backend/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>public/backend/js/application.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-git.js"></script>
	</head>
	<body class="full-width page-condensed">
		<!-- Navbar -->
		<div class="navbar navbar-inverse" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-right">
				<span class="sr-only">Toggle navbar</span>
				<i class="icon-grid3"></i>
				</button>
				<a class="navbar-brand" href="#"><img src="<?=base_url()?>public/backend/images/logo.png" alt="Londinium"></a>
			</div>
			
		</div>
		<!-- /navbar -->
		<!-- Login wrapper -->
		<div class="login-wrapper">
			<form action="#" role="form" method="post" id="form1" name="fom1">
				<div class="popup-header">
					
					<span class="text-semibold"><?=$row_webinfo["webname"];?></span>
					
				</div>
				<div class="well">
					<div class="form-group has-feedback">
						<label>帳號</label>
						<input name="acc" id="acc" type="text" class="form-control" placeholder="Username" required>
						<i class="icon-users form-control-feedback"></i>
					</div>
					<div class="form-group has-feedback">
						<label>密碼</label>
						<input type="password" name="pwd" id="pwd" class="form-control" placeholder="Password" required>
						<i class="icon-lock form-control-feedback"></i>
					</div>
					<!-- Text input-->
					<div class="form-group">
						
						<div class="col-md-12">
							<img id="preview" src="<?=base_url()?>public/backend/captcha.php?<?=time()?>" /><br>
							<a id="refresh" href="" ><small> 重新產生驗證碼(英文全小寫)</small></a><br><br>
							<input id="captcha" name="captcha" type="text" placeholder="Code here.." class="form-control input-md" required="">
							<br>
							<i id="response"></i>
						</div>
					</div>
					<div class="row form-actions">
						
						<!-- Button -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="submit"></label>
							<div class="col-md-4">
								<button id="submit" name="submit" class="btn btn-danger">登入系統</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<!-- /login wrapper -->
		<!-- Footer -->
		<div class="footer clearfix">
			<div class="pull-left"><?=$row_webinfo["copyright"];?></div>
			
		</div>
		<!-- /footer -->
	</body>
	<script>
$(document).ready(function() {
    $('#form1').submit(function() {

        // show that something is loading
        $('#response').html("<small>Loading..</small>");

        /*
         * 'validate.php' - where you will pass the form data
         * $(this).serialize() - to easily read form data
         * function(data){... - data contains the response from validate.php
         */
        $.ajax({
            type: 'POST',
            url: '<?=base_url()?>public/backend/validate.php',
            data: $(this).serialize()
        })
            .done(function(data) {

                // show the response
                $('#response').html(data);
                if (data == "OK") {
                    var acc = $("#acc").val()
                    var pwd = $("#pwd").val()
                    //alert(acc + pwd);
                    window.location.replace("<?=site_url('backend/login/auth')?>?acc=" + acc + "&pwd=" + pwd);
                }

            })
            .fail(function() {

                // just in case posting your form failed
                alert("Posting failed.");

            });

        // to prevent refreshing the whole page page
        return false;

    });

	// 更換驗證碼
	$('#preview').click(function() {
		var data = new Date();
		$('#preview').attr({src: "<?=base_url()?>public/backend/captcha.php?"+data.getTime()})
	});
});
	</script>
</html>
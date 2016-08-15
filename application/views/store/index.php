<?php
$row=$this->db->get_where('backadmin', array('id'=>1))->row_array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?=$row['webtitle']?> | 登入</title>

  <!-- Bootstrap core CSS -->

  <link href="<?=base_url()?>public/store/css/bootstrap.min.css" rel="stylesheet">

  <link href="<?=base_url()?>public/store/fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?=base_url()?>public/store/css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="<?=base_url()?>public/store/css/custom.css" rel="stylesheet">
  <link href="<?=base_url()?>public/store/css/icheck/flat/green.css" rel="stylesheet">


  <script src="<?=base_url()?>public/store/js/jquery.min.js"></script>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#F7F7F7;">

  <div class="">
    <div id="wrapper">
      <div id="login" class="animate form">
      <?php if($this->session->flashdata('store')){ ?>
        <!--錯誤訊息提示框-->
        <section id="errorMessage">
          <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <ul>
              <li><strong><?=$this->session->flashdata('store');?></strong></li>
            </ul>
          </div>
        </section>
        <?php } ?>
        <section class="login_content">
          <form action="<?=site_url('store/login')?>" method="post">
            <h1 style="text-align: center">登入</h1>
            <h1><small><?=$row['webtitle']?>會員後台系統</small></h1>
            <div>
              <input name="acc" type="text" class="form-control" placeholder="帳號" required="" />
            </div>
            <div>
              <input name="pwd" type="password" class="form-control" placeholder="密碼" required="" />
            </div>
            <div>
              <input name="code" type="text" class="form-control" placeholder="驗證碼" required="" />
            </div>
            <div style="text-align: left">
              <p><img id="preview" src="<?=base_url()?>public/backend/captcha.php?<?=time()?>" /></p>
            </div>
            <div>
              <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-sign-in"></i> 送 出
              </button>
            </div>
            <div class="clearfix"></div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
    </div>
  </div>
  <script src="<?=base_url()?>public/store/js/bootstrap.min.js"></script>
  <script>
  // 更換驗證碼
  $('#preview').click(function() {
      var data = new Date();
      $('#preview').attr({src: "<?=base_url()?>public/backend/captcha.php?"+data.getTime()})
  });
  </script>
</body>

</html>

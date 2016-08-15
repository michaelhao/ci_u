<?php
$row=$this->db->get_where('backadmin', array('id'=>1))->row_array();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Step001</title>

    <!-- Bootstrap core CSS -->

    <link href="<?=base_url()?>public/store/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?=base_url()?>public/store/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=base_url()?>public/store/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?=base_url()?>public/store/css/custom.css" rel="stylesheet">
    <link href="<?=base_url()?>public/store/css/icheck/flat/green.css" rel="stylesheet">
    <!-- editor -->
    <link href="<?=base_url()?>public/store/css/editor/external/google-code-prettify/prettify.css" rel="stylesheet">
    <link href="<?=base_url()?>public/store/css/editor/index.css" rel="stylesheet">
    <!-- select2 -->
    <link href="<?=base_url()?>public/store/css/select/select2.min.css" rel="stylesheet">
    <!-- switchery -->
    <link rel="stylesheet" href="<?=base_url()?>public/store/css/switchery/switchery.min.css" />

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
<body>
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1 style="text-align: center"><?=$row['webtitle']?> <small>會員後台系統</small></h1>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="font-size: 18px">
                    <br>
                    <form id="setp001" class="form-horizontal form-label-left input_mask" action="<?=site_url('store/step002')?>?token=<?=$this->input->get('token')?>" method="post">
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input type="hidden" name="token" value="<?=$this->input->get('token')?>">
                            <input type="number" class="form-control has-feedback-left" id="inputSuccess2" placeholder="手機" name="phone">
                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input type="text" class="form-control" id="inputSuccess3" placeholder="帳號" name="account">
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="姓名" name="name">
                            <span class="fa fa-tag form-control-feedback left" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input type="text" class="form-control" id="inputSuccess5" placeholder="身份證字號" name="identity">
                            <span class="fa fa-group form-control-feedback right" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input type="text" class="date-picker form-control has-feedback-left" id="inputSuccess6" placeholder="生日" name="birthday">
                            <span class="fa fa-birthday-cake form-control-feedback left" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input type="text" class="form-control" id="inputSuccess7" placeholder="密碼"  name="password">
                            <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="text" class="form-control" placeholder="聯絡地址" name="address">
                                <span class="fa fa-send form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <a id="step01-login" class="btn btn-success btn-round btn-block">登入</a>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <a id="step01-singup" class="btn btn-info btn-round btn-block">註冊</a>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <a href="<?=site_url('store/sales_report')?>?token=<?=$this->input->get('token')?>" class="btn btn-dark btn-round btn-block">當日營業額</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="<?=base_url()?>public/store/js/bootstrap.min.js"></script>

<!-- bootstrap progress js -->
<script src="<?=base_url()?>public/store/js/progressbar/bootstrap-progressbar.min.js"></script>

<!-- icheck -->
<script src="<?=base_url()?>public/store/js/icheck/icheck.min.js"></script>
<!-- tags -->
<script src="<?=base_url()?>public/store/js/tags/jquery.tagsinput.min.js"></script>
<!-- switchery -->
<script src="<?=base_url()?>public/store/js/switchery/switchery.min.js"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="<?=base_url()?>public/store/js/moment/moment.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/store/js/datepicker/daterangepicker.js"></script>
<!-- richtext editor -->
<script src="<?=base_url()?>public/store/js/editor/bootstrap-wysiwyg.js"></script>
<script src="<?=base_url()?>public/store/js/editor/external/jquery.hotkeys.js"></script>
<script src="<?=base_url()?>public/store/js/editor/external/google-code-prettify/prettify.js"></script>
<!-- select2 -->
<script src="<?=base_url()?>public/store/js/select/select2.full.js"></script>
<!-- form validation -->
<script type="text/javascript" src="<?=base_url()?>public/store/js/parsley/parsley.min.js"></script>
<!-- textarea resize -->
<script src="<?=base_url()?>public/store/js/textarea/autosize.min.js"></script>
<script>
    autosize($('.resizable_textarea'));
    $('#inputSuccess6').daterangepicker({
          format: 'YYYY-MM-DD',
        singleDatePicker: true,
        showDropdowns: true
    });

    $( document ).ready(function() {
        $("#step01-login").click(function(){
            if($('input[name="phone"]').val() == '' 
                && $('input[name="account"]').val() == ''
                && $('input[name="name"]').val() == ''
                && $('input[name="identity"]').val() == ''
                && $('input[name="birthday"]').val() == ''
                && $('input[name="address"]').val() == '') {
                alert('請填寫有效資料');
            } else {
                $('#setp001').submit();
            }
        });
        $("#step01-singup").click(function(){
            if($('input[name="phone"]').val() == '') {
                alert('手機尚未填寫');
            } else {
                var input = {
                    token: $('input[name="token"]').attr('value'),
                    phone: $('input[name="phone"]').val(),
                    // email: $('input[name="email"]').val(),
                    password: $('input[name="password"]').val(),
                    name: $('input[name="name"]').val(),
                    identity: $('input[name="identity"]').val(),
                    birthday: $('input[name="birthday"]').val(),
                    address: $('input[name="address"]').val()
                };

                $.post( "../member/custom_register", input )
                    .done(function( data ) {
                        var dataJson = JSON.parse(data);
                        if(dataJson.error == true) {
                            alert(dataJson.message);
                            if(dataJson.code == 101) {
                                window.location.href = 'index';
                            }
                            return ;
                        } else {
                            $('#setp001').submit();
                        }
                });
            }
        });
    });
</script>
</html>
<?php
$row=$this->db->get_where('backadmin', array('id'=>1))->row_array();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Step005</title>

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
                <div class="x_content" style="font-size: 16px">
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group t_align_c">
                        <h2>結帳品項列表</h2>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        <ul class="order_menu clearfix">
                            <?php foreach ($order['products'] as $key => $product): ?>
                                <?php if ($product['selected'] != 0): ?>
                                <li><?=$product['name']?> * <?=$product['selected']?></li>    
                                <?php endif ?>
                            <?php endforeach ?>
                        </ul>
                        <hr>
                        <ul class="order_menu clearfix">
                            <?php if ($order['use_point']): ?>
                                <li>兌換紅利 * <?=$order['use_point']?></li>
                            <?php endif ?>
                            <?php if($order['bir_gift'] == 2): ?>
                                <li>生日禮 * 1</li>    
                            <?php endif ?>
                            
                        </ul>
                    </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group t_align_c">
                            金額總計 $ <span id="totle"><?=$order['total']?></span>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <a href="<?=site_url('store/payok')?>" class="btn btn-success form-control">確認結帳</a>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <a href="<?=site_url('store/step001')?>?token=<?=$order['token']?>" class="btn btn-info form-control">登 出</a>
                            </div>
                        </div>
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
</html>
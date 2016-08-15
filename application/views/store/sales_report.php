<?php
$row=$this->db->get_where('backadmin', array('id'=>1))->row_array();

// 抓取當天該分店已付款，已出貨的訂單資訊
$orders =$this->db
->where('order_paytime >=', date('Y-m-d 00:00:00'))
->where('order_paytime <=', date('Y-m-d 23:59:59'))
->get_where('order', array(
    'store_from'=>$store_account['store'],
    'order_status'=>2, 
    'status'=>2,))
->result_array();

$total = 0;
$products = array();
foreach ($orders as $key => $order) {
    // 抓取訂單細項
    $order_details =$this->db->get_where('order_detail', array(
        'order_id'=>$order['order_id'],
    ))->result_array();

    // 將產品做合併
    foreach ($order_details as $key2 => $order_detail) {
        $products[$order_detail['order_pid']]['order_pid'] = $order_detail['order_pid'];
        $products[$order_detail['order_pid']]['order_pname'] = $order_detail['order_pname'];
        if(empty($products[$order_detail['order_pid']]['order_pcount'])) {
            $products[$order_detail['order_pid']]['order_pcount'] = $order_detail['order_pcount'];
        } else {
            $products[$order_detail['order_pid']]['order_pcount'] = $products[$order_detail['order_pid']]['order_pcount'] + $order_detail['order_pcount'];
        }
        $products[$order_detail['order_pid']]['order_psubtotal'] = $order_detail['order_psubtotal'];

        // 計算總價
        $total = $total + $order_detail['order_pcount']*$order_detail['order_psubtotal'];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>即時銷售報表</title>

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
                        <div class="col-md-4 col-sm-4 col-xs-12 form-group t_align_r">
                            製表時間：
                        </div>

                        <div class="col-md-8 col-sm-8 col-xs-12 form-group">
                            <?=date('Y/m/d H:i')?>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 form-group t_align_r">
                            銷售總金額：
                        </div>

                        <div class="col-md-8 col-sm-8 col-xs-12 form-group">
                            $<?=$total?>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-12 form-group t_align_r">
                            銷售明細：
                        </div>

                        <div class="col-md-8 col-sm-8 col-xs-12 form-group">
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>商品名稱</th>
                                    <th>單價</th>
                                    <th>銷售數量</th>
                                    <th>合計</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($products as $key => $product): ?>
                                    <tr>
                                        <td><?=$product['order_pname']?></td>
                                        <td>$<?=$product['order_psubtotal']?></td>
                                        <td><?=$product['order_pcount']?></td>
                                        <td>$<?=$product['order_psubtotal']*$product['order_pcount']?></td>
                                    </tr>                                    
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-6 col-sm-6 col-xs-12">
                                <a href="<?=site_url('store/step001')?>?token=<?=$this->input->get('token')?>"><button type="submit" class="btn btn-success form-control">回後台首頁</button></a>
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
<script>
    autosize($('.resizable_textarea'));
    $('#inputSuccess6').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    });

    $(document).ready(function(){
        var vipPoint = 100;
        var usePoint = 0;

        function showCurrentPoint(){
            $('#vipPoint').text(vipPoint);
            $('#usePoint').text(usePoint);
        }

        function pointPlus() {
            var currentElement = $('.pointPlus');
            if (vipPoint >= currentElement.data('step')) {
                vipPoint -= currentElement.data('step');
                usePoint += currentElement.data('step');
                showCurrentPoint();
            }
        }

        function pointMinus() {
            var currentElement = $('.pointMinus');
            if (vipPoint >= currentElement.data('step') && usePoint > 0) {
                vipPoint -= currentElement.data('step');
                usePoint += currentElement.data('step');
                showCurrentPoint();
            }
        }

        $('.pointPlus').click(pointPlus);
        $('.pointMinus').click(pointMinus);
        showCurrentPoint();
    });
</script>
<script>

</script>
</html>
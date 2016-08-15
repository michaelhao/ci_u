<?php
$row=$this->db->get_where('backadmin', array('id'=>1))->row_array();
$user=$this->db->get_where('users', 
    array('id'=>$this->input->get('id'))
)->row_array();
$products = $this->db->order_by('sort','desc')->get_where('product',array(
    'show' => 1,
    'recover' => 0,
    'kind !=' => 1,
))->result_array();

foreach ($products as $key => $product) {
    $products[$key]['selected'] = 0;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Step004</title>

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
    <script src="<?=base_url()?>public/store/js/react.min.js"></script>
    <script src="<?=base_url()?>public/store/js/react-dom.min.js"></script>
    <script src="<?=base_url()?>public/store/js/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js"></script>
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
                    <form class="form-horizontal input_mask">

                        <div class="col-md-4 col-sm-4 col-xs-12 form-group t_align_r">
                            會員狀態
                        </div>

                        <div class="col-md-8 col-sm-8 col-xs-12 form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <?=($user['member_level'])?"黃金":"一般"?>會員
                                </div>
                                <div class="col-md-8">
                                    目前累積消費 $<?=($order_total)?$order_total:0?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-12 form-group t_align_r">
                            兌換紅利點數
                        </div>

                        <div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
                            <div class="btn-group" role="group" aria-label="...">
                                <button type="button" class="btn btn-success btn-round pointPlus" data-step="10"><span class="fa fa-plus" aria-hidden="true"></span></button>
                                <button type="button" class="btn disabled">兌換 <span id="usePoint">0</span> 點</button>
                                <button type="button" class="btn btn-danger btn-round pointMinus" data-step="-10"><span class="fa fa-minus" aria-hidden="true"></span></button>
                            </div>
                            剩餘 <span id="vipPoint">0</span> 點
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-12 form-group t_align_r">
                            兌換生日禮
                        </div>

                        <div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
                            <?php if ($user['bir_gift'] == 0): ?>
                                <label>未開放</label>
                            <?php elseif($user['bir_gift'] == 1): ?>
                                <label>
                                    <input type="radio" name="bir_gift" value="2"> 兌換
                                </label>
                                <label>
                                    <input type="radio" name="bir_gift" value="1" checked="checked"> 不兌換
                                </label>                                
                            <?php elseif($user['bir_gift'] == 2): ?>
                                <label>已領取</label>
                            <?php endif ?>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 form-group" id="table">
                        </div>
                        <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pagiation-page">
                            <ul class="pagination"><li class="disabled"><span>«</span></li> <li class="active"><span>1</span></li><li><a href="http://backend.likol.tw/news?page=2">2</a></li> <li><a href="http://backend.likol.tw/news?page=2" rel="next">»</a></li></ul>
                        </div> -->
                        <div class="col-md-4 col-sm-4 col-xs-12 form-group t_align_r">
                            金額總計
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
                            $ <span id="totle">0</span>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12" id="paymentBtn">
                                
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <a href="<?=site_url('store/step001')?>?token=<?=$this->input->get('token')?>" class="btn btn-info form-control">登 出</a>
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
        singleDatePicker: true,
        showDropdowns: true
    });

    $(document).ready(function(){
        var vipPoint = <?=$user['bonus']?>;
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

<script type="text/babel">
    // Mobel 專區
    var products = <?=json_encode($products)?>;

    var total = 0;

    var user_id = "<?=$this->input->get('id')?>";

    var token = "<?=$this->input->get('token')?>";

    // View 專區
    var TbodyRow = React.createClass({
        getInitialState: function() {
            return {
                product: {}
            };
        },
        productUp: function() {
            console.log(this.props.product);
            console.log({total});
            
            // if(this.props.product.selected < this.props.product.qty) {
                this.props.product.selected = this.props.product.selected +1; 
                total = total + Number(this.props.product.special_offer);
            // }
            // 重新整理
            this.rerenderTable();
        },
        productDown: function() {
            console.log(this.props.product);
            console.log({total});
            
            // if(this.props.product.selected > 0) {
                this.props.product.selected = this.props.product.selected -1; 
                total = total - Number(this.props.product.special_offer);
            // }
            // 重新整理
            this.rerenderTable();
        },
        rerenderTable: function() {
            $("#totle").text(total);
            // 重新整理
            ReactDOM.render( 
                <Table products={products}/> ,
                document.getElementById('table'));
        },
        render: function() {
            return (
                <tr>
                    <td>{this.props.product.name}</td>
                    <td>${this.props.product.special_offer}</td>
                    <td>
                        <div className="btn-group" role="group" aria-label="...">
                            <button type="button" onClick={this.productUp} className="btn btn-success btn-round btn-sm w_50_Button" data-step="10"><span className="fa fa-plus" aria-hidden="true"></span></button>
                            <button type="button" onClick={this.productDown} className="btn btn-danger btn-round btn-sm w_50_Button" data-step="-10"><span className="fa fa-minus" aria-hidden="true"></span></button>
                        </div>
                    </td>
                    <td>{this.props.product.selected}</td>
                </tr>
            );
        },
    });
    var Table = React.createClass({
        getInitialState: function() {
            return {
                products: products
            };
        },
        render: function() {
            var tbodyRow = function(product) {
              return (
                <TbodyRow product={product}/>
              );
            };
            return (
                <table className="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>商品名稱</th>
                            <th>單價</th>
                            <th>操作</th>
                            <th>數量</th>
                        </tr>
                    </thead>
                    <tbody>
                    {this.props.products.map(tbodyRow)}
                    </tbody>
                </table>
            );
        }
    });

    var PaymentBtn = React.createClass({
        payment: function() {
            if($("#usePoint").text() == 0 
                && $('input[name=bir_gift]:checked').val() == undefined 
                && total ==0) {
                alert('尚未選擇任何任何操作');
                return;
            } else {
                var input = {
                    'user_id' : user_id,
                    'token' : token,
                    'products' : products,
                    'total' : total,
                    'use_point' : $("#usePoint").text(),
                    'bir_gift' : $('input[name=bir_gift]:checked').val(),
                };

                // 產品資料暫存
                $.post( "../store/payment", input )
                    .done(function( data ) {
                        var dataJson = JSON.parse(data);
                        console.log(dataJson);
                        if(dataJson.error == true) {
                            alert(dataJson.message);
                            return ;
                        } else {
                            window.location.href = "<?=site_url('store/step005')?>";
                        }
                    });
            }
            
        },
        render: function() {
            return (
                <span onClick={this.payment} className="btn btn-success form-control">結帳</span>
            );
        }
    });

    // 顯示產品清單
    ReactDOM.render( 
        <Table products={products}/> ,
        document.getElementById('table'));

    // 顯示付款按鈕
    ReactDOM.render( 
        <PaymentBtn /> ,
        document.getElementById('paymentBtn'));
</script>
</html>
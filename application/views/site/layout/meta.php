<?php
   $datas=$this->db->order_by('id','des')->get_where('backadmin', array(
       'id' => 1,
   ))->result_array();
   ?>
<!DOCTYPE html>
<html lang="en" class="wide wow-animation">
   <head>
      <!-- Site Title-->
      <?php foreach ($datas as $key => $data): ?>
      <meta name="author" content="<?=$data['webname']?>" />
      <meta name="description" content="<?=$data['description']?>"/>
      <meta name="keywords" content="<?=$data['keyword']?>" />
      <meta property="og:title" content="<?=$data['webtitle']?>" />
      <meta property="og:description" content="<?=$data['description']?>" />
      <title><?=$data['webtitle']?></title>
      <?php endforeach ?>
      <meta name="format-detection" content="telephone=no">
      <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta charset="utf-8">
      <link rel="icon" type="image/x-icon" href="<?=base_url()?>public/site/images/favicon.ico" />
      <!-- Stylesheets-->
      <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Alegreya+Sans:400,800,700,400italic">
      <link rel="stylesheet" href="<?=base_url()?>public/site/css/style.css" />
      <!--[if lt IE 10]>
      <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
      <script src="js/html5shiv.min.js"></script>
      <![endif]-->
   </head>
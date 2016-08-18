<?php
   include("layout/meta.php");
   include("layout/header.php");
   ?>
<!-- Page-->
<div class="page text-center">
<!-- Page Header-->
<div class="shell">
   <ul class="list-inline list-inline-dashed offset-top-25 breadcrumbs">
      <li><a href="#">首頁</a></li>
      <li class="active text-gray-dark">操作說明</li>
   </ul>
</div>
<!-- Page Content-->
<main class="page-content">
   <div id="fb-root"></div>
   <div class="shell offset-md-top-50">
      <div class="range range-xs-center">
         <!-- Elements-->
         <div class="cell-sm-12 cell-md-12 offset-top-45 offset-md-top-0">
            <h3 class="text-center">操作說明</h3>
            <BR>
            <?php foreach ($news as $key => $new): ?>
            <div class="offset-top-60 offset-md-top-45">
               <div class="unit unit-xl-horizontal unit-lg-horizontal unit-md-horizontal unit-sm-vertical unit-xs-vertical unit-spacing-md">
                  <div class="unit-left"><img src="<?=$new['pic']?>" width="300px" alt="" class="img-responsive"/>
                  </div>
                  <div class="unit-body">
                     <h4 class="text-light"><?=$new['name']?></h4>
                     <p>
                        <?=$new['description']?><BR><BR>
                        <?php if (!empty($new['content'])) { ?>
                           <a href="<?=$new['content']?>" target="_blank">【教學影片】</a>
                        <?php } ?>
                     </p>
                  </div>
               </div>
            </div>
            <hr class="divider">
            <?php endforeach ?>
         </div>
      </div>
   </div>
</main>
<!-- Java script-->
<?php 
   include("layout/footer.php");
   ?>
<script src="<?=base_url()?>public/site/js/core.min.js"></script>
<script src="<?=base_url()?>public/site/js/script.js"></script>
</body>
</html>
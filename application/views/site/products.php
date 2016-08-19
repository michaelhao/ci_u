<?php
   include("layout/meta.php");
   include("layout/header.php");
   ?>
<body>
   <!-- Page-->
   <div class="page text-center">
      <!-- Page Header-->
      <div class="shell">
         <ul class="list-inline list-inline-dashed offset-top-25 breadcrumbs">
            <li><a href="<?=site_url('site/index')?>">首頁</a></li>
            <li class="active text-gray-dark">產品介紹</li>
         </ul>
      </div>
      <!-- Page Content-->
      <main class="page-content">
         <div id="fb-root"></div>
         <div class="shell offset-md-top-50">
            <div class="range range-xs-center">
               <!-- Elements-->
               <div class="cell-sm-12 cell-md-12 offset-top-45 offset-md-top-0">
                  <div class="offset-top-60 offset-md-top-45">
                     <div class="unit unit-xl-horizontal unit-lg-horizontal unit-md-horizontal unit-sm-vertical unit-xs-vertical unit-spacing-md">
                        <?php foreach ($products as $key => $product): ?>
                        <div class="unit-left"><img src="<?=$product['pic']?>" width="470" height="470" alt="" class="img-responsive"/>
                        </div>
                        <div class="unit-body">
                           <h4 class="text-light"><?=$product['name']?></h4>
                           <h6 class="text-gray-light"><?=$product['field1']?></h6>
                           <p><?=$product['description']?></p>
                        </div>
                     </div>
                     <hr class="divider">
                     <div class="text-center">
                        <p><?=$product['content']?></p>
                     </div>
                     <?php endforeach ?>
                  </div>
               </div>
            </div>
         </div>
      </main>
   </div>
   <!-- Java script-->
   <?php 
      include("layout/footer.php");
      ?>
   <script src="<?=base_url()?>public/site/js/core.min.js"></script>
   <script src="<?=base_url()?>public/site/js/script.js"></script>
</body>
</html>
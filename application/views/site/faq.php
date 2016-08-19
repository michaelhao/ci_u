<?php
   include("layout/meta.php");
   include("layout/header.php");
   ?>
<!-- Page-->
<div class="page text-center">
   <!-- Page Header-->
   <div class="shell">
      <ul class="list-inline list-inline-dashed offset-top-25 breadcrumbs">
         <li><a href="index.html">首頁</a></li>
         <li class="active text-gray-dark">FAQ</li>
      </ul>
   </div>
   <!-- Page Content-->
   <main class="page-content">
      <!-- FAQs-->
      <section class="section-60 section-md-top-80 section-md-bottom-90">
         <div class="shell">
            <h3 class="text-md-center">FAQ</h3>
            <div class="range range-xs-center">
               <div class="cell-sm-10 cell-md-10">
               </div>
            </div>
            <hr class="divider">
            <div class="text-left">
               <?=$faq['content']?>
            </div>
         </div>
</div>
</section>
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
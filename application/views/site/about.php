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
          <li class="active text-gray-dark">關於我們</li>
        </ul>
      </div>
      <!-- Page Content-->
      <main class="page-content">
        <!--關於我們-->
        <section class="section-50 section-md-bottom-95">
          <div class="shell">
            <div class="range range-xs-center">
              <div class="cell-sm-10 cell-md-12">
                <h3 class="text-center">關於我們</h3>
                <div class="range offset-top-50">
            <!-- Elements-->
            <div class="cell-sm-12 cell-md-12 offset-top-45 offset-md-top-0">
              <div class="offset-top-60 offset-md-top-45">
                <div class="unit unit-xl-horizontal unit-lg-horizontal unit-md-horizontal unit-sm-vertical unit-xs-vertical unit-spacing-md">
                  <div class="unit-body">
                    
                    <?=$about['content']?>
                  </div>
                </div>
              </div>
              <hr class="divider">

            </div>
                </div>
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
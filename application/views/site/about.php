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
          <li><a href="index.html">首頁</a></li>
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
                  <div class="unit-left"><img src="<?=base_url()?>public/site/images/aboutus-01-550x550-1.jpg" width="470" height="470" alt="" class="img-responsive"/>
                  </div>
                  <div class="unit-body">
                    <!-- <h4 class="text-light">Dr. Mark Hoffman</h4> -->
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
      <div class="footer-offset-none">
      </div>
    </div>
    <!-- Global Mailform Output-->
    <div id="form-output-global" class="snackbars"></div>
    <!-- PhotoSwipe Gallery-->
    <div tabindex="-1" role="dialog" aria-hidden="true" class="pswp">
      <div class="pswp__bg"></div>
      <div class="pswp__scroll-wrap">
        <div class="pswp__container">
          <div class="pswp__item"></div>
          <div class="pswp__item"></div>
          <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
          <div class="pswp__top-bar">
            <div class="pswp__counter"></div>
            <button title="Close (Esc)" class="pswp__button pswp__button--close"></button>
            <button title="Share" class="pswp__button pswp__button--share"></button>
            <button title="Toggle fullscreen" class="pswp__button pswp__button--fs"></button>
            <button title="Zoom in/out" class="pswp__button pswp__button--zoom"></button>
            <div class="pswp__preloader">
              <div class="pswp__preloader__icn">
                <div class="pswp__preloader__cut">
                  <div class="pswp__preloader__donut"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
            <div class="pswp__share-tooltip"></div>
          </div>
          <button title="Previous (arrow left)" class="pswp__button pswp__button--arrow--left"></button>
          <button title="Next (arrow right)" class="pswp__button pswp__button--arrow--right"></button>
          <div class="pswp__caption">
            <div class="pswp__caption__cent"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- Java script-->
    <?php 
    include("layout/footer.php");
    ?>
    <script src="js/core.min.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>
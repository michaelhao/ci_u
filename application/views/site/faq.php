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
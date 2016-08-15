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
                  <div class="unit-left"><img src="images/team-member-03-550x550.jpg" width="470" height="470" alt="" class="img-responsive"/>
                  </div>
                  <div class="unit-body">
                    <h4 class="text-light">酷炫熊智能手錶</h4>
                    <h6 class="text-gray-light">採用全貼合技術，顯示清晰，能有效保護兒童眼鏡。</h6>
                    <p>炫彩外觀，結構材料均按照兒童產品品質品質標準，錶帶採用食品級完全矽膠，手感柔軟，並且防過敏。 1.22寸電容觸摸超薄彩屏，採用全貼合技術，顯示清晰，能有效保護兒童眼鏡。 防爆裂電容屏，觸摸切換無延時，完美觸感操作。</p>
                  </div>
                </div>
              </div>
              <hr class="divider">
              <div class="text-center">
                <img src="images/watch_long.jpg" class="img-responsive">
              </div>
            </div>

          </div>
        </div>
      </main>
      <div class="offset-top-50 offset-md-top-110">
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
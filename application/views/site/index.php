<?php
    include("layout/meta.php");
    include("layout/header.php");
?>
  <body>
    <div class="page text-center">
      <!-- Page Content-->
      <main class="page-content">
        <!-- Swiper-->
        <section data-height="" data-min-height="240px" data-autoplay="5000" data-dots="true" class="swiper-container swiper-slider swiper-slider-home">
          <div class="swiper-wrapper">
            <div data-slide-bg="<?=base_url()?>public/site/images/slider-01.jpg" class="swiper-slide">
              <div class="swiper-slide-caption">
                <div class="shell">
                  <h1 class="text-primary">寶貝驅蚊啪啪</h1>
                  <h4 style="color:#fff;" class="text-gray-light veil reveal-sm-block text-regular">攜帶方便。安心驅蚊</h4>
                  <!-- <a href="book.html" class="btn btn-primary">Book an Appointment</a> -->
                </div>
              </div>
            </div>
            <div data-slide-bg="<?=base_url()?>public/site/images/slider-02.jpg" class="swiper-slide">
              <div class="swiper-slide-caption">
                <div class="shell">
                  <h1 class="text-primary">純天然植物萃取精華製成</h1>
                  <h4 style="color:#fff;" class="text-gray-light veil reveal-sm-block text-regular">無毒。無刺激。不含避蚊胺。純植物提萃</h4>
                  <!-- <a href="book.html" class="btn btn-primary">Book an Appointment</a> -->
                </div>
              </div>
            </div>
          </div>


          <!-- Swiper Pagination-->
          <div class="swiper-pagination"></div>
        </section>
        <!-- Welcome to BeDentist-->
        <section class="section-85">
          <div class="shell">
            <div class="range">
              <div class="cell-md-6"><img src="<?=base_url()?>public/site/images/home-02-550x550.jpg" width="550" height="550" alt="" class="img-responsive"/>
              </div>
              <div class="cell-md-6">
                <h3>酷炫熊手錶</h3>
                <!-- <h4>Dental clinic BeDentist welcomes you!</h4> -->
                <div class="offset-top-30">
                  <p>一旦寶貝位置出現變化，手機APP端即可得到反饋
GPS做到長連接，且保持一分鐘上傳一次定位位置，真正意義做到即時定位，一旦寶貝位置出現變化，手機APP端即可馬上得到回饋。寶貝行蹤掌握清清楚楚。</p>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="section-85">
          <div class="shell">
            <div class="range">

              <div class="cell-md-6">
                <h3>防蚊手環</h3>
                <!-- <h4>Dental clinic BeDentist welcomes you!</h4> -->
                <div class="offset-top-30">
                  <p>源自台灣的植物驅蚊理念，驅蚊片有效驅蚊時間較長，驅蚊片可另行更換；驅蚊腕帶佩戴舒適，可隨意調節與循環使用。適用於室內、露營、登山、釣魚等戶外活動。可佩戴在手腕、腳裸、背包及嬰兒車等位置
本產品由透氣設計食品級矽膠手環+純天然植物萃取香片製成，主要成分是薰衣草、天然葵、桉葉、薄荷萃取等植物提取精油，純植物成分，不含驅蚊胺，通過了國家相關檢測檢疫機構的認定，專為嬰幼兒、孕婦研製，可放心使用。該產品是借用植物精粹成分用於防蚊，減少被蚊子叮咬的機會，而不是戴上後就蚊子一口都不咬，請確保建立了科學的世界觀。老少皆適用的超值防蚊手帶，絶對值得人手一條,超炫超有效!讓蚊子們集體罷工。
關於材料和氣味：採用食品級矽膠+超薄鐵皮輕輕拍一下就可以自動捲起來戴在手上非常方便</p>
                 
                </div>
              </div>
              <div class="cell-md-6"><img src="<?=base_url()?>public/site/images/home-01-550x550.jpg" width="550" height="550" alt="" class="img-responsive"/>
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
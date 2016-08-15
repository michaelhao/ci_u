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
              <div class="offset-top-60 offset-md-top-45">
                <div class="unit unit-xl-horizontal unit-lg-horizontal unit-md-horizontal unit-sm-vertical unit-xs-vertical unit-spacing-md">
                  <div class="unit-left"><img src="<?=base_url()?>public/site/images/APP_btn.jpg" width="300px" alt="" class="img-responsive"/>
                  </div>
                  <div class="unit-body">
                    <h4 class="text-light">STEP 1 - 下載熊衛士專用APP</h4>
                    <p>
如果您是第一次購買Kidfit手錶，需要下載Kidfit專用手機App。可以至Apple App商店 或Google Play商店下載。<BR><BR>
<a href="">【教學影片】</a>
                    </p>
                  </div>
                </div>
              </div>
              <hr class="divider">
              <div class="offset-top-60 offset-md-top-45">
                <div class="unit unit-xl-horizontal unit-lg-horizontal unit-md-horizontal unit-sm-vertical unit-xs-vertical unit-spacing-md">
                  <div class="unit-left"><img src="<?=base_url()?>public/site/images/use01.jpg" width="300px" alt="" class="img-responsive"/>
                  </div>
                  <div class="unit-body">
                    <h4 class="text-light">STEP 2 - 註冊APP帳號&配對</h4>
                    <p>開啟熊衛士APP,點擊新用戶,可使用手機號碼或E-mail註冊。收到6位數認証碼，再回到App輸入認證碼才算是註冊成功。使用手機號碼註冊,由於是國際碼,不需要輸入0。 例如:+886-955XXXXXX<BR><BR>
                    <a href="">【教學影片】</a>
                    </p>
                  </div>
                </div>
              </div>
              <hr class="divider">
              <div class="offset-top-60 offset-md-top-45">
                <div class="unit unit-xl-horizontal unit-lg-horizontal unit-md-horizontal unit-sm-vertical unit-xs-vertical unit-spacing-md">
                  <div class="unit-left"><img src="<?=base_url()?>public/site/images/manuel02.jpg" width="300px" alt="" class="img-responsive"/>
                  </div>
                  <div class="unit-body">
                    <h4 class="text-light">STEP 3 - App與手錶進行配對</h4>
                    <p>Kidfit手錶設定：<BR>
1.請先購買3G/4G SIM卡,需有上網流量（目前可以使用電信業者：台灣大/遠傳/中華電信，建議購買預付卡較不易出現配對不成功。）<BR>
2.打開熊衛士手錶SIM卡槽，放入MicroSIM卡，手錶開機。<BR>
App設定：<BR>
1.掃描二維碼或是輸入CID號碼,。<BR>
2.輸入小孩名稱和綁定手錶SIM卡號碼。<BR>
3.管理員號碼更改 例:0955XXXXXX<BR><BR>
<a href="">【教學影片】</a>
</p>
                  </div>
                </div>
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
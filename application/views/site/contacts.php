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
          <li class="active text-gray-dark">聯絡我們</li>
        </ul>
      </div>
      <!-- Page Content-->
      <main class="page-content">
        <!--General and preventive care-->
        <section class="section-top-50 section-bottom-80 section-md-bottom-95 section-md-top-30">
          <div class="shell">
            <div class="range range-xs-center text-center">
              <div class="cell-sm-10 cell-md-12">
                <h3 class="text-center">聯絡我們</h3>
                <!-- RD Google Map-->
              </div>
            </div>
          </div>
     
          <ul class="map_locations">
            <li data-x="-73.9874068" data-y="40.643180">
              <h6 class="text-light">地址</h6>
              <p>新北市永和區文化路9巷16弄22號</p>
            </li>
          </ul>
          <section class="section-top-50 section-md-top-80">
            <div class="shell">
              <div class="range range-sm-reverse text-sm-left">
                <div class="cell-sm-8">
                  <h4>聯絡表單</h4>
                  <!-- RD Mailform-->
                  <form data-form-output="form-output-global" data-form-type="contact" method="post" action="bat/rd-mailform.php" class="rd-mailform text-left offset-top-30">
                    <div class="form-group">
                      <label for="contact-name" class="form-label form-label-outside">姓名<span class="text-primary">*</span></label>
                      <input id="contact-name" type="text" name="name" data-constraints="@Required" placeholder="Your name" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="contact-email" class="form-label form-label-outside">Email<span class="text-primary">*</span></label>
                      <input id="contact-email" type="email" name="email" placeholder="name@mail.com" data-constraints="@Required @Email" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="contact-phone" class="form-label form-label-outside">主旨</label>
                      <input id="contact-phone" type="text" name="phone" placeholder="Subject" class="form-control">
                    </div>
                    <div class="form-group textarea-group">
                      <label for="contact-message" class="form-label form-label-outside">訊息<span class="text-primary">*</span></label>
                      <textarea id="contact-message" name="message" placeholder="Your message" data-constraints="@Required" class="form-control"></textarea>
                    </div>
                    <div class="text-center text-sm-left offset-top-20">
                      <button type="submit" class="btn btn-primary">送出</button>
                    </div>
                  </form>
                </div>
                <div class="cell-sm-4 offset-top-60 offset-sm-top-0">
                  <h4>地址</h4>
                  <div><a href="#" class="text-gray-light">新北市永和區文化路9巷16弄22號</a></div>
                  <h4>電話</h4>
                  <div><a href="callto:#" class="text-gray-light text-extra-bold reveal-inline">+886-933-358-979</a></div>
                  <h4>E-mail</h4>
                  <div><a href="mailto:joe@guardianbear.com.tw" class="text-primary text-italic">joe@guardianbear.com.tw</a></div>
<!--                   <h4>營業時間</h4>
                  <p>Monday –Friday: 9am–6pm</p>
                  <p>Saturday: 10am–4pm</p>
                  <p>Sunday: 10am–1pm</p> -->
                </div>
              </div>
            </div>
          </section>
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
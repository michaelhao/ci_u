<?php
$foots=$this->db->order_by('id','des')->get_where('backadmin', array(
       'id' => 1, 
   ))->result_array();
?>
<div class="offset-top-50 offset-md-top-110">
<!-- Page Footer-->
<footer class="page-footer text-center">
   <div class="footer-container footer-copyright">
      <div class="shell">
         <div class="reveal-sm-flex range-sm-justify range-sm-reverse range-sm-middle">
            <div>
               <ul class="list-inline list-inline-md">
               <?php foreach ($foots as $key => $foot): ?>
                  <?php if (!empty($foot['Facebook'])) { ?>
                           <li><a href="<?=$foot['Facebook']?>" class="icon fa-facebook icon-default"></a></li>
                        <?php } ?>
                  <?php if (!empty($foot['Twitter'])) { ?>
                          <li><a href="<?=$foot['Twitter']?>" class="icon fa-twitter icon-default"></a></li>
                        <?php } ?>
                  <?php if (!empty($foot['Google'])) { ?>
                           <li><a href="<?=$foot['Google']?>" class="icon fa-google-plus icon-default"></a></li>
                        <?php } ?>
               <?php endforeach ?>
               </ul>
            </div>
            <div class="offset-top-15 offset-sm-top-0">
            <?php foreach ($foots as $key => $foot): ?>
               <p><?=$foot['copyright']?></p> 
            <?php endforeach ?>
               
            </div>
         </div>
      </div>
   </div>
</footer>
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
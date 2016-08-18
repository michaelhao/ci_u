<?php
   include("layout/meta.php");
   include("layout/header.php");
   
   $banners=$this->db->order_by('id','des')->get_where('article', array(
       'Recover' => 0, 
       'show' => 1, 
       'panel' => 8 
   ))->result_array();
   
   $stores=$this->db->order_by('id','des')->get_where('store', array(
       'Recover' => 0, 
       'show' => 1, 
       'panel' => 17 
   ))->result_array();
   
   $CI =& get_instance();
   $CI->load->library('image');
   $banners = $CI->image->getImage($banners);
   $stores = $CI->image->getImage($stores);
   ?>
<body>
   <div class="page text-center">
      <!-- Page Content-->
      <main class="page-content">
         <!-- Swiper-->
         <section data-height="" data-min-height="240px" data-autoplay="5000" data-dots="true" class="swiper-container swiper-slider swiper-slider-home">

            <div class="swiper-wrapper">

               <?php foreach ($banners as $key => $banner): ?>
               <div data-slide-bg="<?=$banner['pic']?>" class="swiper-slide">

                  <div class="swiper-slide-caption">

                     <div class="shell">
                        <h1 class="text-primary"><?=$banner['content']?></h1>
                        <h4 style="color:#fff;" class="text-gray-light veil reveal-sm-block text-regular"></h4>
                     </div>

                  </div>

               </div>
               <?php endforeach ?>
            </div>
            <!-- Swiper Pagination-->
            <div class="swiper-pagination"></div>
         </section>
         <!-- Welcome to BeDentist-->
         <?php foreach ($stores as $key => $store): ?>
         <article class="blog-item style6">
            <section class="section-85">
               <div class="shell">
                  <div class="range">
                     <div class="cell-md-6"><img src="<?=$store['pic']?>" width="550" height="550" alt="" class="img-responsive"/>
                     </div>
                     <div class="cell-md-6">
                        <h3><?=$store['name']?></h3>
                        <div class="offset-top-30">
                           <p><?=$store['description']?></p>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </article>
         <?php endforeach ?>
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
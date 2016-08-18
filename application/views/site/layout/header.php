<?php
   $stores=$this->db->order_by('id','des')->get_where('store', array(
       'Recover' => 0, 
       'show' => 1, 
       'panel' => 12 
   ))->result_array();
   ?>
<header class="page-head">
   <!-- RD Navbar-->
   <div class="rd-navbar-wrap" style="height: 144px;">
      <nav data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fullwidth" data-md-device-layout="rd-navbar-fullwidth" data-sm-device-layout="rd-navbar-fullwidth" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-sm-stick-up-offset="150px" data-lg-stick-up-offset="70px" class="rd-navbar rd-navbar-variant-3 rd-navbar-original rd-navbar-static">
         <div class="rd-navbar-inner">
            <!-- RD Navbar Panel-->
            <div class="rd-navbar-panel">
               <!-- RD Navbar Toggle-->
               <button data-rd-navbar-toggle=".rd-navbar-nav-wrap" class="rd-navbar-toggle toggle-original"><span></span>
               </button>
               <div class="reveal-md-flex range-md-justify range-sm-middle">
                  <div>
                     <a href="<?=site_url('site/index')?>">
                     <img class="hidden-xs" src="<?=base_url()?>public/site/images/bluebearlogo_154x125.png">
                     </a>
                  </div>
                  <div class="rd-navbar-nav-container offset-top-10 offset-md-top-0 toggle-original-elements">
                     <div class="rd-navbar-nav-container reveal-sm-flex range-sm-center range-sm-middle pos-relative toggle-original-elements">
                        <div class="rd-navbar-nav-wrap text-md-left toggle-original-elements">
                           <!-- RD Navbar Nav-->
                           <ul class="rd-navbar-nav">
                              <li><a href="<?=site_url('site/about')?>">關於我們</a></li>
                              <li class="rd-navbar--has-dropdown rd-navbar-submenu">
                                 <a>產品介紹</a>
                                 <!-- RD Navbar Dropdown-->
                                 <ul class="rd-navbar-dropdown">
                                    <?php foreach ($stores as $key => $store): ?>
                                    <li> <a href="<?=site_url('site/products')?>?id=<?=$store['id']?>">
                                       <?=$store['name']?>
                                       </a>
                                    </li>
                                    <?php endforeach ?>
                                 </ul>
                                 <span class="rd-navbar-submenu-toggle"></span>
                              </li>
                              <li><a href="<?=site_url('site/news')?>">最新消息</a></li>
                              <li><a href="<?=site_url('site/faq')?>">FAQ</a></li>
                              <li><a href="<?=site_url('site/option')?>">操作說明</a></li>
                              <li><a href="<?=site_url('site/contacts')?>">聯絡我們</a></li>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </nav>
   </div>
</header>
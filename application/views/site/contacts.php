<?php
   include("layout/meta.php");
   include("layout/header.php");

   $datas=$this->db->order_by('id','des')->get_where('backadmin', array(
       'id' => 1,
   ))->result_array();

   ?>
<body>
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
                        </form>
                        <div class="contact-form style-2">
                           <form onsubmit="addContact();return false;">
                              <div class="form-group">
                                 <label for="contact-name" class="form-label form-label-outside">姓名 <span>*</span></label>
                                 <input id="contact-name" type="text" name="name" data-constraints="@Required" placeholder="Your name" class="form-control" required>
                              </div>
                              <div class="form-group">
                                 <label for="contact-email" class="form-label form-label-outside">Email<span class="text-primary">*</span></label>
                                 <input id="contact-email" type="text" name="email" placeholder="name@mail.com" data-constraints="@Required @Email" class="form-control" required>
                              </div>
                              <div class="form-group">
                                 <label for="contact-main" class="form-label form-label-outside">主旨</label>
                                 <input id="contact-main" type="text" name="main" placeholder="Subject" class="form-control">
                              </div>
                              <div class="form-group textarea-group">
                                 <label for="contact-message" class="form-label form-label-outside">訊息<span class="text-primary">*</span></label>
                                 <textarea id="content" name="content" placeholder="Your message" data-constraints="@Required" class="form-control"></textarea>
                              </div>
                              <div class="text-center text-sm-left offset-top-20">
                                 <button type="submit" class="btn btn-primary">送出</button>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="cell-sm-4 offset-top-60 offset-sm-top-0">
                      <?php foreach ($datas as $key => $data): ?>
                        <h4>地址</h4>
                        <div><a href="#" class="text-gray-light"><?=$data['address']?></a></div>
                        <h4>電話</h4>
                        <div><a href="callto:#" class="text-gray-light text-extra-bold reveal-inline"><?=$data['tel']?></a></div>
                        <h4>E-mail</h4>
                        <div><a href="mailto:joe@guardianbear.com.tw" class="text-primary text-italic"><?=$data['email']?></a></div>
                        <?php endforeach ?>
                     </div>
                  </div>
               </div>
            </section>
         </section>
      </main>
   </div>
   <!-- Java script-->
   <script>
      function addContact() {
      // console.log("表單送出~");
          alert('表單已送出。');
      
          if ($("input[name*='name']").val() == '' ||
              $("input[name*='email']").val() == '' ) {
              return false;
          } else {
      
              var data = {
                  'name': $("input[name*='name']").val(),
                  'email': $("input[name*='email']").val(),
                  'tel': $("input[name*='tel']").val(),
                  'content': $("#content").val()
              }
              $("input[name*='name']").val('');
              $("input[name*='email']").val('');
              $("input[name*='tel']").val('');
              $("textarea[name*='content']").val('');
              
              $.post( "../contactus/add", data )
                  .done(function( data ) {
      
              });
              return false;
          }
      }
   </script>
   <?php 
      include("layout/footer.php");
      ?>
   <script src="<?=base_url()?>public/site/js/core.min.js"></script>
   <script src="<?=base_url()?>public/site/js/script.js"></script>
</body>
</html>
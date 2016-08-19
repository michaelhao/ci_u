<?php
   include("layout/meta.php");
   include("layout/header.php");
   ?>
<style type="text/css">
   .pagination > .next_style > a{
   color :#0095e5;
   font-style: normal;
   font-weight: 800;}
   .pagination > .last_style > a{
   color :#0095e5;
   font-style: normal;
   font-weight: 800;}
   .pagination .next_style:after {
   content: '\f105';
   font-family: 'FontAwesome';
   color: #616262;
   padding-left: 7px;
   position: relative;
   top: 1px;}
   .pagination .last_style:before {
   content: '\f104';
   font-family: 'FontAwesome';
   color: #616262;
   padding-right: 7px;
   position: relative;
   top: 1px;}
</style>
<!-- Page-->
<div class="page text-center">
   <!-- Page Header-->
   <div class="shell">
      <ul class="list-inline list-inline-dashed offset-top-25 breadcrumbs">
         <li><a href="<?=site_url('site/index')?>">首頁</a></li>
         <li class="active text-gray-dark">最新消息</li>
      </ul>
   </div>
   <!-- Page Content-->
   <main class="page-content">
      <div id="fb-root"></div>
      <div class="shell offset-top-25 offset-md-top-45">
         <h3 class="text-center">最新消息</h3>
         <div class="range range-xs-center offset-top-25 offset-md-top-35">
            <!-- Posts-->
            <div class="cell-sm-12 cell-md-12 offset-top-5">
               <?php foreach ($news as $key => $new): ?>
               <article class="blog-item">
                  <hr class="divider"/>
                  <div class="post post-list">
                     <div class="info-post">
                        <h4 class="text-bold"><a href="" class="post-title"><?=$new['name']?></a></h4>
                        <div class="post-meta-time text-gray-lighter">
                           <p><?=date('F d,Y', strtotime($new['start_at']))?></p>
                        </div>
                        <div class="post-media-wrap"><img src="<?=$new['pic']?>" class="img-responsive post-image"/></a>
                        </div>
                        <div class="content-post">
                           <p><?=$new['content']?></p>
                        </div>
                     </div>
                  </div>
               </article>
               <?php endforeach ?>
               <BR>
               <nav class="pagination">
                  <?php echo $this->pagination->create_links();?>
               </nav>
               </BR>
               <BR><BR>
            </div>
         </div>
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
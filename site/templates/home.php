<?php snippet('header') ?>

<!-- HERO BANNER -->
<?php snippet('herobanner') ?>
<!-- END HERO BANNER -->

<!-- PROMO SECTION -->
<?php snippet('promo')?>
<!-- END PROMO SECTION -->

<!-- COURSE SECTION -->
<?php snippet('course' , array('data' => $pages->find('courses'))) ?>    
<!-- END COURSE SECTION  -->

<!-- TESTIMONIALS SECTION -->
<?php snippet('testimonials') ?>
<!-- END TESTIMONIALS SECTION -->

<!-- CONTACT SECTION -->
<?php snippet('contact') ?>  
<!-- END CONTACT SECTION -->

<!-- PARTNERS SECTION -->
<?php snippet('partners') ?>    
<!-- END PARTNERS SECTION -->

<!--FOOTER-->
<?php snippet('footer') ?>
<!--END FOOTER-->
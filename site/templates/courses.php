<?php snippet('header') ?>
<!-- SEARCH SECTION -->
<section id="search-section" class="grid-container">
    <div class="grid-x">
        <div class="medium-3 cell search-logo">
            <?php if($img = $site->image($site->website_logo())):?>
                <img class="penrithLogo" src="<?php echo $img->url() ?>" alt="<?php echo page('home')->title()->text() ?> Logo">
            <?php endif ?>
        </div>
        <div class="medium-9 cell searchArticle">
            <h1 class="orangeHeading"><?php echo $page->coursetitle()->text() ?></h1>
            <h2 class="search-title"><?php echo $page->header_text()->text() ?></h2>
            <?php if(!$getID) : ?>
                <div class="searchButton cell ">
                    <a tabIndex href="#" class="btnOne radial sign-in" data-open="sign-in"><?php echo $page->enrollNow_button_text() ?></a>
                </div>
            <?php endif ?>
        </div>
    </div>
</section>
<!-- END SEARCH SECTION-->

<!-- COURSE SECTION -->
<?php snippet('course' , array('data' => $pages->find('courses'))) ?>
<!-- END COURSE SECTION  -->

<!-- COURSE LISTING SECTION -->
<section id="courseListing-section" class="grid-container">
    <?php snippet('courselisting')?>
</section>
<!-- END COURSE LISTING SECTION -->

<!-- TESTIMONIALS SECTION -->
<?php snippet('testimonials') ?>
<!-- END TESTIMONIALS SECTION -->

<!-- CONTACT SECTION -->
<?php snippet('contact') ?>
<!-- END CONTACT SECTION -->

<!-- PARTNERS SECTION -->
<?php snippet('partners') ?>
<!-- END PARTNERS SECTION -->

<?php snippet('footer'); ?>
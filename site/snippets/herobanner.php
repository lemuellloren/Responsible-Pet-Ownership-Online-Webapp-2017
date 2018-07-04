
<section id="hero-banner" class="grid-container">
    <div class="grid-x">
        <div class="medium-3 cell banner-logo">
            <?php if($img = $site->image($site->website_logo())):?>
                <img class="penrithLogo" src="<?php echo $img->url() ?>" alt="<?php echo $page->title()->title() ?> Logo">
            <?php endif ?>
        </div>
        <div class="medium-9 cell heroArticle">
            <h1 class="orangeHeading"><?php echo $page->header_text()->html() ?></h1>
            <?php echo $page->sub_text()->kt() ?>
                <div class="banner-button-2 cell">
                 <?php if($page->btntxt_viewcourse()->isNotEmpty()):?>
                    <a tabindex href="<?php echo $pages->find('courses')->url() ?>" class="btnThree radial"><?php echo $page->btntxt_viewcourse()->title() ?></a>
                <?php endif ?>
                <?php if($getID) : ?>
                    <?php if($page->btntxt_enroll()->isNotEmpty()): ?>
                        <button tabindex="5" class="btnOne radial sign-in" data-open="sign-in" style="display: none"><?php echo $page->btntxt_enroll()->title() ?></button>
                    <?php endif ?>
                <?php else : ?>
                    <?php if($page->btntxt_enroll()->isNotEmpty()): ?>
                        <button tabindex="5" class="btnOne radial sign-in" data-open="sign-in"><?php echo $page->btntxt_enroll()->title() ?></button>
                    <?php endif ?>
                <?php endif ?>
            </div>
        </div>
</div>
</section>


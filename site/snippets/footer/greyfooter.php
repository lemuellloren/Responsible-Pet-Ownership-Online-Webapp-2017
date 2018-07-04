<?php $menu1lists = $site->menu1()->toStructure(); ?>
<?php $menu2lists = $site->menu2()->toStructure(); ?>

<div class="grid-x bg-footer grid-container">
    <div class="small-12 large-3 medium-3 cells">
        <ul class="site-footer-bottom">
            <p><span><? echo $site->menu1_name()->upper()?></span></p>
            <?php foreach($menu1lists as $menu1list): ?>
                <li><a tabindex href="<?php echo $menu1list->menu1_link() ?>" target="_blank"><?php echo $menu1list->menu1_name() ?></a></li>
            <?php endforeach ?>
        </ul>
    </div>
    <div class="small-12 large-3 medium-3 cells">
        <ul class="site-footer-bottom">
            <p><span><? echo $site->menu2_name()->upper()?></span></p>
            <?php foreach($menu2lists as $menu2list): ?>
                <li><a tabindex href="<?php echo $menu2list->menu2_link() ?>" target="_blank"><?php echo $menu2list->menu2_name() ?></a></li>
            <?php endforeach ?>
        </ul>
    </div>

<!-- Desktop & Tablet responsive footer-->
    <div class="hide-for-small-only large-6 medium-6 cells offset-footer">
        <ul class="site-footer-bottom footer-icon-container">
            <?php if($site->visit_facebook()->isEmpty() && $site->visit_twitter()->isEmpty()
               && $site->visit_youtube()->isEmpty() && $site->visit_instagram()->isEmpty()
               && $site->visit_linkedin()->isEmpty() && $site->visit_pinterest()->isEmpty()): ?>
            <?php else: ?>
                <p><span class="whiteHeading"><?php echo $site->visit_text()->upper() ?></span></p>
            <?php endif ?>

            <?php if($site->visit_facebook()->isNotEmpty()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="facebook" class="vfacebook" href="<?php echo $site->visit_facebook() ?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-facebook fb" data-disable-hover="false" tabIndex title="facebook"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->visit_twitter()->isNotEmpty()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="twitter" class="vtwitter" href="<?php echo $site->visit_twitter() ?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-twitter twit" data-disable-hover="false" tabIndex title="twitter"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->visit_youtube()->isNotEmpty()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="youtube" class="vyoutube" href="<?php echo $site->visit_youtube() ?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-youtube you" data-disable-hover="false" tabIndex title="youtube"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->visit_instagram()->isNotEmpty()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="instagram" class="vinstagram" href="<?php echo $site->visit_instagram() ?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-instagram insta" data-disable-hover="false" tabIndex title="instagram"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->visit_linkedin()->isNotEmpty()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="linkedin" class="vlinkedin" href="<?php echo $site->visit_linkedin() ?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-linkedin linke" data-disable-hover="false" tabIndex title="linkedin"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->visit_pinterest()->isNotEmpty()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="pinterest" class="vpinterest" href="<?php echo $site->visit_pinterest() ?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-pinterest pint" data-disable-hover="false" tabIndex title="pinterest"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->share_facebook()->isFalse() && $site->share_twitter()->isFalse()
                && $site->share_pinterest()->isFalse() && $site->share_linkedin()->isFalse()
                && $site->share_tumblr()->isFalse() && $site->share_reddit()->isFalse()
                && $site->share_googleplus()->isFalse() && $site->share_email()->isFalse() ): ?>
            <?php else: ?>
                <br>
                <p><span class="whiteHeading"> <?php echo $site->share_text()->upper() ?></span></small></h5></p>
            <?php endif ?>


            <?php if($site->share_facebook()->bool()):?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="facebook" class="facebook" target="_blank" href="https://facebook.com/sharer/sharer.php?u=<?php echo esc($page->url(),'url')?>" title="share on facebook">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-facebook sfb" data-disable-hover="false" tabIndex title="facebook"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->share_twitter()->bool()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="twitter" class="twitter" target="_blank" href="https://twitter.com/intent/tweet/?text=<?php echo esc($page->description(),'url')?>&amp;url=<?php echo esc($page->url(),'url') ?>" target="_blank"> 
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-twitter stwit" data-disable-hover="false" tabIndex title="twitter"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->share_pinterest()->bool()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="pinterest" class="pinterest" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo esc($page->url(),'url')?>&amp;media=<?php echo esc($page->url(),'url')?>&amp;description=<?php echo esc($page->description(),'url')?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-pinterest spint" data-disable-hover="false" tabIndex title="pinterest"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->share_linkedin()->bool()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="linkedin" class="linkedin" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc($page->url(),'url') ?>&amp;title=<?php echo esc($page->isHomePage()?$site->title():$page->title(),'url')?>.&amp;summary=<?php echo esc($page->description(),'url')?>.&amp;source=<?php echo esc($page->url(),'url')?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-linkedin slinke" data-disable-hover="false" tabIndex title="linkedin"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->share_tumblr()->bool()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="tumblr" class="tumblr" target="_blank" href="https://www.tumblr.com/widgets/share/tool?posttype=link&amp;title=<?php echo esc($page->isHomePage()?$site->title():$page->title(),'url')?>&amp;caption=<?php echo esc($page->isHomePage()?$site->title():$page->title(),'url')?>.&amp;content=<?php echo esc($page->description(),'url')?>&amp;shareSource=tumblr_share_button">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-tumblr stumb" data-disable-hover="false" tabIndex title="tumblr"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->share_reddit()->bool()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="reddit" class="reddit" target="_blank" href="https://reddit.com/submit/?url=<?php echo esc($page->url(),'url')?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-reddit sred" data-disable-hover="false" tabIndex title="reddit"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->share_googleplus()->bool()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="google-plus" class="googleplus" target="_blank" href="https://plus.google.com/share?url=<?php echo esc($page->url(),'url')?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-googleplus sgp" data-disable-hover="false" tabIndex title="googleplus"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->share_email()->bool()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="email us" class="email" target="_blank" href="mailto:?subject=<?php echo esc($page->description(),'url')?>.&amp;body=<?php echo esc($page->url(),'url')?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-email semail" data-disable-hover="false" tabIndex title="email"></span>
                    </a>
                </li>
            <?php endif ?>
        </ul>
    </div>
<!-- End Desktop & Tablet responsive footer-->

<!-- mobile responsive footer-->
    <div class="show-for-small-only  medium-6 cells">
        <ul class="site-footer-bottom footer-icon-container">
            <?php if($site->visit_facebook()->isEmpty() && $site->visit_twitter()->isEmpty()
               && $site->visit_youtube()->isEmpty() && $site->visit_instagram()->isEmpty()
               && $site->visit_linkedin()->isEmpty() && $site->visit_pinterest()->isEmpty()): ?>

            <?php else: ?>
               <p><span  class="whiteHeading"><?php echo $site->visit_text()->upper() ?></span></p>
            <?php endif ?>

            <?php if($site->visit_facebook()->isNotEmpty()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="facebook" class="vfacebook" href="<?php echo $site->visit_facebook() ?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-facebook mfb" data-disable-hover="false" tabIndex title="facebook"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->visit_twitter()->isNotEmpty()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="twitter" class="vtwitter" href="<?php echo $site->visit_twitter() ?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-twitter mtwit" data-disable-hover="false" tabIndex title="twitter"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->visit_youtube()->isNotEmpty()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="youtube" class="vyoutube" href="<?php echo $site->visit_youtube() ?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-youtube myou" data-disable-hover="false" tabIndex title="youtube"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->visit_instagram()->isNotEmpty()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="instagram" class="vinstagram" href="<?php echo $site->visit_instagram() ?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-instagram minsta" data-disable-hover="false" tabIndex title="instagram"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->visit_linkedin()->isNotEmpty()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="linkedin" class="vlinkedin" href="<?php echo $site->visit_linkedin() ?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-linkedin mlinke" data-disable-hover="false" tabIndex title="linkedin"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->visit_pinterest()->isNotEmpty()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="pinterest" class="vpinterest" href="<?php echo $site->visit_pinterest() ?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-pinterest mpint" data-disable-hover="false" tabIndex title="pinterest"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->share_facebook()->isFalse() && $site->share_twitter()->isFalse()
                && $site->share_pinterest()->isFalse() && $site->share_linkedin()->isFalse()
                && $site->share_tumblr()->isFalse() && $site->share_reddit()->isFalse()
                && $site->share_googleplus()->isFalse() && $site->share_email()->isFalse() ): ?>
            <?php else: ?>
                <br>
                <p><span class="whiteHeading"> <?php echo $site->share_text()->upper() ?></span></p>
            <?php endif ?>


            <?php if($site->share_facebook()->bool()):?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="facebook" class="facebook" target="_blank" href="https://facebook.com/sharer/sharer.php?u=<?php echo esc($page->url(),'url')?>" title="share on facebook">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-facebook sfb" data-disable-hover="false" tabIndex title="facebook"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->share_twitter()->bool()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="twitter" class="twitter" target="_blank" href="https://twitter.com/intent/tweet/?text=<?php echo esc($page->description(),'url')?>&amp;url=<?php echo esc($page->url(),'url') ?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-twitter stwit" data-disable-hover="false" tabIndex title="twitter"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->share_pinterest()->bool()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="pinterest" class="pinterest" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo esc($page->url(),'url')?>&amp;media=<?php echo esc($page->url(),'url')?>&amp;description=<?php echo esc($page->description(),'url')?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-pinterest spint" data-disable-hover="false" tabIndex title="pinterest"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->share_linkedin()->bool()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="linkedin" class="linkedin" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc($page->url(),'url') ?>&amp;title=<?php echo esc($page->isHomePage()?$site->title():$page->title(),'url')?>.&amp;summary=<?php echo esc($page->description(),'url')?>.&amp;source=<?php echo esc($page->url(),'url')?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-linkedin slinke" data-disable-hover="false" tabIndex title="linkedin"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->share_tumblr()->bool()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="tumblr" class="tumblr" target="_blank" href="https://www.tumblr.com/widgets/share/tool?posttype=link&amp;title=<?php echo esc($page->isHomePage()?$site->title():$page->title(),'url')?>&amp;caption=<?php echo esc($page->isHomePage()?$site->title():$page->title(),'url')?>.&amp;content=<?php echo esc($page->description(),'url')?>&amp;shareSource=tumblr_share_button">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-tumblr stumb" data-disable-hover="false" tabIndex title="tumblr"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->share_reddit()->bool()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="reddit" class="reddit" target="_blank" href="https://reddit.com/submit/?url=<?php echo esc($page->url(),'url')?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-reddit sred" data-disable-hover="false" tabIndex title="reddit"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->share_googleplus()->bool()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="google-plus" class="googleplus" target="_blank" href="https://plus.google.com/share?url=<?php echo esc($page->url(),'url')?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-social-googleplus sgp" data-disable-hover="false" tabIndex title="googleplus"></span>
                    </a>
                </li>
            <?php endif ?>

            <?php if($site->share_email()->bool()): ?>
                <li class="footer-socialIcons">
                    <a tabIndex aria-label="email us" class="email" target="_blank" href="mailto:?subject=<?php echo esc($page->description(),'url')?>.&amp;body=<?php echo esc($page->url(),'url')?>" target="_blank">
                        <span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-email semail" data-disable-hover="false" tabIndex title="email"></span>
                    </a>
                </li>
            <?php endif ?>
        </ul>
    </div>
    <!-- end mobile responsive footer -->
</div>
<!-- end grid-x bg-footer grid-container -->
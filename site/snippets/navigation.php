<?php $menu1lists = $site->menu1()->toStructure(); ?>
<?php $menu2lists = $site->menu2()->toStructure(); ?>


<!-- NAVIGATION BAR -->
<nav class="navbarTop" data-topbar>
    <input type="hidden" id="homeurl" value="<?php echo url() ?>">
    <div class="topnav" id="myTopnav">
        <div class="row">
            <ul class="dropdown menu" data-dropdown-menu data-disable-hover="true" data-click-open="true" data-hover-delay="10">
                <li class="has-submenu">
                    <a href="#" tabindex><? echo $site->menu1_name()?></a>
                    <ul class="menu">
                        <?php foreach($menu1lists as $menu1list): ?>
                            <li tabindex role="menuitem"><a href="<?php echo $menu1list->menu1_link() ?>" target="_blank"><?php echo $menu1list->menu1_name() ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="#" tabindex><? echo $site->menu2_name()?></a>
                    <ul class="menu">
                        <?php foreach($menu2lists as $menu2list): ?>
                            <li tabindex role="menuitem"><a href="<?php echo $menu2list->menu2_link() ?>" target="_blank"><?php echo $menu2list->menu2_name() ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </li>
                <li class="googlewidget">
                    <div id="google_translate_element" tabindex></div>
                    <script type="text/javascript" tabindex>
                        function googleTranslateElementInit() {
                            new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                        };
                    </script>
                    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                </li>
            </ul>
        </div>
    </div>

    <div class="nav-cont grid-x" id="navbarsecondTop">
        <div class="small-6 medium-8 large-6 cell">
            <ul class="dropdown menu left-group" data-dropdown-menu data-disable-hover="true">
                <?php if(Session::hasOnlineAccess()){ ?>
                    <li tabindex="0" id="limyaccount">
                        <button tabindex="-1" class="account-name user-name"></button>
                        <ul class="menu" id="submenu-account">
                            <li tabindex id="li-myaccount"><a class="is-dropdown-submenu-item myaccount" href="<?php echo page('accounts')->url() ?>" ><span>My Account</span></a></li>
                            <li tabindex id="li-signout"><a class="is-dropdown-submenu-item" href="#" id="signOut"><span>Sign Out</span></a></li>
                        </ul>
                    </li>
                    <?php }else{ ?>
                    <li tabindex="0" id="signin" class="signin-li">
                        <button tabindex="-1" data-open="sign-in" class="sign-in account-name signin" style="margin: 0 auto"><?php echo page('accounts')->signIn_button_text() ?></button>
                    </li>
                    <?php } ?>

                    <li>
                        <div class="input-group searchbar show-for-medium hide-for-small">
                            <form action="<?php echo url()?>/search" id="search-form">
                                <input aria-label="Search" class="input-field search-field" id="searchField" name="search-field" type="search" placeholder="Search" autofocus/>
                                <input type="submit" id="ccc" style="visibility: hidden;">
                            </form> 

                            <div class="input-group-button">
                                <button aria-label="search" class="button search" id="searchButton">
                                    <span tabIndex class="icon ion-android-search"></span>
                                </button>
                            </div>
                        </div>
                        <a class="icon-animation search-link show-for-small-only" aria-label="search" href="#" onclick="return false;">
                            <span class="icon ion-android-search"></span>
                        </a>
                        <ul class="menu show-for-small-only" id="submenu-search">
                            <li>
                                <form action="<?php echo url()?>/search">
                                    <input aria-label="Search" type="text" id="search-field" name="search-field" placeholder="Search" class="search-input">
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="small-6 medium-4 large-6 cell">
                <ul class="dropdown menu right-group" data-dropdown-menu>
                    <li>
                        <a href="<?php if ($page->isHomePage()) { echo $page->url(); } else { echo $pages->find('home')->url(); } ?>" class="icon-animation home" aria-label="home"><span data-tooltip aria-haspopup="true" class="has-tip bottom icon ion-home" data-disable-hover="false" tabIndex title="home">
                        </a>
                    </li>
                    <li>
                        <button class="icon-animation contact" aria-label="contact us" data-open="contact-modal"><span data-tooltip aria-haspopup="true" class="has-tip bottom icon ion-chatbubbles" data-disable-hover="false" tabIndex title="contact us"
                        </button>
                    </li>
                    <li>
                        <a aria-label="courses" href="<?php echo $pages->find('courses')->url() ?>" class="icon-animation courseslist"><span data-tooltip aria-haspopup="true" class="has-tip bottom icon icon ion-university" data-disable-hover="false" tabIndex title="courses">
                        </a>
                    </li>
                    <?php if($page->intendedTemplate() != 'accounts') : ?>
                        <li class="show-for-large sharePadding"><a href="#" style="pointer-events: none" tabindex="-1">Share</a></li>
                        <?php if($site->share_facebook()->isNotEmpty()): ?>
                            <li class="show-for-large">
                                <a target="_blank" href="https://facebook.com/sharer/sharer.php?u=<?php echo esc($page->url(),'url')?>" class="icon-animation facebook" aria-label="facebook"><span data-tooltip aria-haspopup="true" class="has-tip bottom icon ion-social-facebook sfb" data-disable-hover="false" tabIndex title="facebook">
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if($site->share_twitter()->isNotEmpty()): ?>
                            <li class="show-for-large">
                                <a target="_blank" href="https://twitter.com/intent/tweet/?text=<?php echo esc($page->description(),'url')?>&amp;url=<?php echo esc($page->url(),'url') ?>" class="icon-animation twitter" aria-label="twitter"><span data-tooltip aria-haspopup="true" class="has-tip bottom icon ion-social-twitter stwit" data-disable-hover="false" tabIndex title="twitter">
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if($site->share_pinterest()->isNotEmpty()): ?>
                            <li class="show-for-large">
                                <a target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo esc($page->url(),'url')?>&amp;media=<?php echo esc($page->url(),'url')?>&amp;description=<?php echo esc($page->description(),'url')?>" class="icon-animation pinterest" aria-label="pinterest"><span data-tooltip aria-haspopup="true" class="has-tip bottom icon ion-social-pinterest spint" data-disable-hover="false" tabIndex title="pinterest">
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if($site->share_linkedin()->isNotEmpty()): ?>
                            <li class="show-for-large">
                                <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc($page->url(),'url') ?>&amp;title=<?php echo esc($page->isHomePage()?$site->title():$page->title(),'url')?>.&amp;summary=<?php echo esc($page->description(),'url')?>.&amp;source=<?php echo esc($page->url(),'url')?>" class="icon-animation linkedin slinke" aria-label="linkedin"><span data-tooltip aria-haspopup="true" class="has-tip bottom icon ion-social-linkedin" data-disable-hover="false" tabIndex title="linkedin">
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if($site->share_tumblr()->isNotEmpty()): ?>
                            <li class="show-for-large">
                                <a target="_blank" href="https://www.tumblr.com/widgets/share/tool?posttype=link&amp;title=<?php echo esc($page->isHomePage()?$site->title():$page->title(),'url')?>&amp;caption=<?php echo esc($page->isHomePage()?$site->title():$page->title(),'url')?>.&amp;content=<?php echo esc($page->description(),'url')?>&amp;shareSource=tumblr_share_button" class="icon-animation tumblr stumb" aria-label="tumblr"><span data-tooltip aria-haspopup="true" class="has-tip bottom icon ion-social-tumblr" data-disable-hover="false" tabIndex title="tumblr">
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if($site->share_reddit()->isNotEmpty()): ?>
                            <li class="show-for-large">
                                <a target="_blank" href="https://reddit.com/submit/?url=<?php echo esc($page->url(),'url')?>" class="icon-animation reddit" aria-label="reddit"><span data-tooltip aria-haspopup="true" class="has-tip bottom icon ion-social-reddit sred" data-disable-hover="false" tabIndex title="reddit">
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if($site->share_googleplus()->isNotEmpty()): ?>
                            <li class="show-for-large">
                                <a target="_blank" href="https://plus.google.com/share?url=<?php echo esc($page->url(),'url')?>" class="icon-animation" aria-label="google-plus"><span data-tooltip aria-haspopup="true" class="has-tip bottom icon ion-social-googleplus sgp" data-disable-hover="false" tabIndex title="googleplus">
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if($site->share_email()->isNotEmpty()): ?>
                            <li class="show-for-large more-space-desktop">
                                <a href="mailto:?subject=<?php echo esc($page->description(),'url')?>.&amp;body=<?php echo esc($page->url(),'url')?>" class="icon-animation" aria-label="email us"><span data-tooltip aria-haspopup="true" class="has-tip bottom icon ion-email semail" data-disable-hover="false" tabIndex title="email">
                                </a>
                            </li>
                        <?php endif; ?>

                        <li class="show-for-small hide-for-large" id="isDrop">
                            <a href="#" class="share-link icon-animation"><span class="icon ion-android-share-alt"></span></a>
                            <ul class="menu stop-float" id="submenu-share">
                                <li><a href="#">Share</a></li>
                                <?php if($site->share_facebook()->isNotEmpty()): ?>
                                    <li>
                                        <a target="_blank" class="facebook" href="https://facebook.com/sharer/sharer.php?u=<?php echo esc($page->url(),'url')?>" class="icon-animation" aria-label="facebook"><span data-tooltip aria-haspopup="true" class="has-tip bottom icon ion-social-facebook sfb" data-disable-hover="false" tabIndex title="facebook">
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($site->share_twitter()->isNotEmpty()): ?>
                                    <li>
                                        <a target="_blank" class="twitter" href="https://twitter.com/intent/tweet/?text=<?php echo esc($page->description(),'url')?>&amp;url=<?php echo esc($page->url(),'url') ?>" class="icon-animation" aria-label="twitter"><span data-tooltip aria-haspopup="true" class="has-tip bottom icon ion-social-twitter stwit" data-disable-hover="false" tabIndex title="twitter">
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($site->share_pinterest()->isNotEmpty()): ?>
                                    <li>
                                        <a target="_blank" class="pinterest" href="https://pinterest.com/pin/create/button/?url=<?php echo esc($page->url(),'url')?>&amp;media=<?php echo esc($page->url(),'url')?>&amp;description=<?php echo esc($page->description(),'url')?>" class="icon-animation" aria-label="pinterest"><span data-tooltip aria-haspopup="true" class="has-tip bottom icon ion-social-pinterest spint" data-disable-hover="false" tabIndex title="pinterest">
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($site->share_linkedin()->isNotEmpty()): ?>
                                    <li>
                                        <a target="_blank" class="linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc($page->url(),'url') ?>&amp;title=<?php echo esc($page->isHomePage()?$site->title():$page->title(),'url')?>.&amp;summary=<?php echo esc($page->description(),'url')?>.&amp;source=<?php echo esc($page->url(),'url')?>" class="icon-animation" aria-label="linkedin"><span data-tooltip aria-haspopup="true" class="has-tip bottom icon ion-social-linkedin slinke" data-disable-hover="false" tabIndex title="linkedin">
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($site->share_tumblr()->isNotEmpty()): ?>
                                    <li>
                                        <a target="_blank" class="tumblr" href="https://www.tumblr.com/widgets/share/tool?posttype=link&amp;title=<?php echo esc($page->isHomePage()?$site->title():$page->title(),'url')?>&amp;caption=<?php echo esc($page->isHomePage()?$site->title():$page->title(),'url')?>.&amp;content=<?php echo esc($page->description(),'url')?>&amp;shareSource=tumblr_share_button" class="icon-animation" aria-label="tumblr"><span data-tooltip aria-haspopup="true" class="has-tip bottom icon ion-social-tumblr stumb" data-disable-hover="false" tabIndex title="tumblr">
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($site->share_reddit()->isNotEmpty()): ?>
                                    <li>
                                        <a target="_blank" class="reddit" href="https://reddit.com/submit/?url=<?php echo esc($page->url(),'url')?>" class="icon-animation" aria-label="reddit"><span data-tooltip aria-haspopup="true" class="has-tip bottom icon ion-social-reddit sred" data-disable-hover="false" tabIndex title="reddit">
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($site->share_googleplus()->isNotEmpty()): ?>
                                    <li>
                                        <a target="_blank" class="googleplus" href="https://plus.google.com/share?url=<?php echo esc($page->url(),'url')?>" class="icon-animation googleplus" aria-label="google-plus"><span data-tooltip aria-haspopup="true" class="has-tip bottom icon ion-social-googleplus sgp" data-disable-hover="false" tabIndex title="googleplus">
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($site->share_email()->isNotEmpty()): ?>
                                    <li>
                                        <a target="_blank" href="mailto:?subject=<?php echo esc($page->description(),'url')?>.&amp;body=<?php echo esc($page->url(),'url')?>" class="icon-animation email" aria-label="email us"><span data-tooltip aria-haspopup="true" class="has-tip bottom icon ion-email" data-disable-hover="false" tabIndex title="email">
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endif ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<!-- END NAVIGATION BAR -->
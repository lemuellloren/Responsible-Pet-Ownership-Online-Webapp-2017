
    <!-- orange footer mobile -->
    <div class="show-for-small-only orange-footer">
        <div class="row">
            <center class="grid-x">
                <div class="medium-6 cell footer-ASPCC">
                    <?php if($img = $site->image($site->footer_logo())):?>
                        <img class="penrithLogo" src="<?php echo $img->url() ?>" alt="<?php echo $page->title()->title() ?> Logo" width="180px">
                    <?php endif ?>
                </div>
                <div class="medium-6 cell">
                    <ul class="bottom-links">
                        <li>
                            <small><?php echo $site->footer_text()->html() ?></small>
                        </li>
                        <li>
                            <li>
                                <small>
                                    <?php if($site->privacy_text()->isNotEmpty()): ?>
                                        <button tabindex data-open="privacy" class="privacy"><?php echo $site->privacy_link() ?></button>
                                    <?php endif ?>
                                    <?php if($site->terms_text()->isNotEmpty() and $site->privacy_text()->isNotEmpty()){ echo ' &nbsp; | &nbsp; '; }?>
                                    <?php if($site->terms_text()->isNotEmpty()): ?>
                                        <button tabindex data-open="terms" class="terms"><?php echo $site->terms_link() ?></button>
                                    <?php endif ?>
                                </small>
                            </li>
                        </li>
                    </ul>
                </div>
            </center>
        </div>
    </div>
    <!--end orange footer mobile -->

    <!--  footer desktop -->
    <div class="hide-for-small-only orange-footer">
        <div class="row">
            <div class="orangeFooter-container">
                <center class="grid-x">
                    <div class="medium-6 cell footer-ASPCC">
                        <?php if($img = $site->image($site->footer_logo())):?>
                            <img class="penrithLogo" src="<?php echo $img->url() ?>" alt="<?php echo $page->title()->title() ?> Logo" width="200px">
                        <?php endif ?>
                    </div>
                    <div class="medium-6 cell leftSideFooter">
                        <ul class="bottom-links align-right">
                            <li>
                                <small>
                                    <?php if($site->privacy_text()->isNotEmpty()): ?>
                                        <button tabindex data-open="privacy" class="privacy"><?php echo $site->privacy_link() ?></button>
                                    <?php endif ?>
                                    <?php if($site->terms_text()->isNotEmpty() and $site->privacy_text()->isNotEmpty()){ echo ' &nbsp; | &nbsp; '; }?>
                                    <?php if($site->terms_text()->isNotEmpty()): ?>
                                        <button tabindex data-open="terms" class="terms"><?php echo $site->terms_link() ?></button>
                                    <?php endif ?>
                                </small>
                            </li>
                            <li>
                                <small><?php echo $site->footer_text()->html()?></small>
                            </li>
                        </ul>
                    </div>
                </center>
            </div>
        </div>
    </div>
    <!-- end footer desktop -->

</div><!-- end orange footer -->
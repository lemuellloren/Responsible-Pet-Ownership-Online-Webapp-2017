<div class="reveal" id="terms" data-multiple-opened="true" data-animation-out="fade-out" data-animation-in="fade-in" data-reveal>
    <div class="modal-header">
        <h3><?php echo $site->terms_link()->title()->upper() ?></h3>
    </div>
    <?php echo $site->terms_text()->kt() ?>
    <button class="close-button" data-close aria-label="Close modal" type="button" autofocus>
        <img src="<?php echo url() ?>/assets/images/modal-close.png" alt="close" >
    </button>
</div>
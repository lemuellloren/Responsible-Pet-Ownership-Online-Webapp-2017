<div class="reveal" id="privacy" data-animation-out="fade-out" data-animation-in="fade-in" data-multiple-opened="true" data-reveal >
    <div class="modal-header">
        <h3><?php echo $site->privacy_link()->title()->upper() ?></h3>
    </div>
    <?php echo $site->privacy_text()->kt() ?>
    <button class="close-button" data-close aria-label="Close modal" type="button" autofocus>
        <img src="<?php echo url() ?>/assets/images/modal-close.png" alt="close" > 
    </button>
</div>
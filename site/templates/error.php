<?php snippet('header') ?>

<div class="error-container grid-container">
    <h1><?php echo $page->error_header()->title() ?></h1>
    <p><?php echo $page->error_message()->kt() ?></p>
</div>

<?php snippet('footer')?>
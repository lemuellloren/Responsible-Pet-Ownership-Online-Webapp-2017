<!doctype html>
<html lang="en-AU" class="no-js" lang="en" >

<head>
    <!-- STANDARD META -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo seo('title', array(), true); ?></title>
    <meta name="description" content="<?php echo seo('description', array(), true); ?>">
    <meta name="keywords" content="<?php echo $page->keywords() ?>">

    <!-- OPENGRAPH META -->
    <meta property="og:url" content="<?php echo $page->url() ?>">
    <meta property="og:title" content="<?php echo seo('title', array(), true); ?>">
    <meta property="og:description" content="<?php echo seo('description', array(), true); ?>">
<?php if($img = $page->image($page->mainImage())):?>
    <meta property="og:image" content="<?php echo thumb($img,array('width'=>1200, 'height'=>630, 'crop'=>true))->url() ?>">
<?php endif; ?>

    <!-- FAVICONS -->
<?php
    $parentUrl = $page->parent()->title();
    if( $parentUrl == $site->title()): ?>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo url() ?>/assets/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo url() ?>/assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo url() ?>/assets/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?php echo url() ?>/assets/images/favicons/manifest.json">
    <link rel="mask-icon" href="<?php echo url() ?>/assets/images/favicons/safari-pinned-tab.svg" color="#f26522">
    <meta name="theme-color" content="#ffffff">
<?php else: ?>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo url() ?>/assets/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo url() ?>/assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo url() ?>/assets/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?php echo url() ?>/assets/images/favicons/manifest.json">
    <link rel="mask-icon" href="<?php echo url() ?>/assets/images/favicons/safari-pinned-tab.svg" color="#f26522">

    <meta name="theme-color" content="#ffffff">
<?php endif; ?> 

    <script src="https://use.fontawesome.com/6501f9e90c.js"></script>
    <!-- .js files -->
    <?php echo js('@auto'); ?>
    <!-- end .js files -->

<!-- STYLESHEETS -->
<?php if( $parentUrl == $site->title()): ?>
   <link rel="stylesheet" href="<?php echo url() ?>/assets/css/<?php echo $page->intendedTemplate()?>.css">
<?php else: ?>
   <link rel="stylesheet" href="<?php echo url() ?>/assets/css/<?php echo $page->intendedTemplate()?>.css">
<?php endif; ?>

<!-- navigation -->
<?php snippet('navigation') ?>
<!-- end navigation -->

</head>
<body>
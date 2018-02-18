<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php wp_title( '|', true, 'right' ); ?> <?php bloginfo( 'name' ); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <!-- <link rel="apple-touch-icon" href="icon.png"> -->
    <!-- Place favicon.ico in the root directory -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,400i,600i,700" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <?php wp_head(); ?>
</head>
<body>
<?php get_template_part('component-header'); ?>
<?php

/**
 * The Header of all pages
 * 
 * Responsible for page tag opening
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="msapplication-TileColor" content="#0E0E0E">
    <meta name="template-color" content="#0E0E0E">
    <!-- <link rel="manifest" href="manifest.json" crossorigin="">
    <meta name="description" content="Index page">
    <meta name="keywords" content="index, page">
    <meta name="author" content=""> -->
    <!-- <meta name="msapplication-config" content="browserconfig.xml"> -->
    <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/template/favicon.svg"> -->
    <link href="assets/css/style.css?version=4.1" rel="stylesheet">
    <title><?php wp_title('|', true, 'right'); ?></title>

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php
    $siteTitle = esc_attr(get_bloginfo('name', 'display'));
    $siteLogo = get_stylesheet_directory_uri() . '/images/logo_dtj.png';
    ?>

    <header id="header" role="banner" class="<?php if ($isRecruteurPage) echo 'pro-bg' ?>">
        <div class="container">
            <nav class="d-flex align-items-center" role="navigation">
                <!-- left logo -->
                <h1 class="site-title">
                    <a href="<?= get_permalink(31) ?>" title="<?= $siteTitle ?>" rel="home">
                        <img src="<?= $siteLogo ?>" alt="<?php bloginfo('name'); ?> logo" class="logo" />
                    </a>
                </h1>
                <!-- left links -->
                <div class="div flex-fill">
                    <a href="<?= get_permalink('7') ?>" class="btn btn-link btn-sm">Offres d'emploi</a>
                    <a href="<?= get_permalink('44') ?>" class="btn btn-link btn-sm">Découverte des entreprises</a>
                    <a href="<?= get_permalink('239') ?>" class="btn btn-link btn-sm">Contact</a>
                    <a href="<?= get_permalink('16') ?>" class="btn btn-link btn-sm">Recruteurs :</a>
                    <a href="<?= get_permalink('16') ?>" class="btn btn-link btn-sm">Nos offres</a>
                    <a href="<?= get_permalink('8') ?>" class="btn btn-link btn-sm">Publier une annonce</a>
                </div>
                <!-- right links -->
                <div class="div">
                    <a href="<?= get_permalink('12') ?>" class="btn btn-primary btn-sm">Espace recruteur</a>
                    <a href="<?= get_permalink('14') ?>" class="btn btn-primary btn-sm">Espace candidat</a>
                </div>

            </nav>
        </div>
        </div>
    </header>
    <div id="main" class="container">
        <!-- Main content centered -->
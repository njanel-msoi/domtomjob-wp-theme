<?php

/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package wpjobboard_theme
 * @since wpjobboard_theme 1.0
 */

$is_map = basename(get_page_template()) == "home-map.php";

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width" />
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <!--[if lt IE 9]>
                <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/stylesheets/ie8.css' type='text/css' media='all' />
                <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
        <![endif]-->

    <?php wp_head(); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body <?php body_class(); ?>>
    <?php
    $isRecruteurPage = isRecruteurPage();
    $siteTitle = esc_attr(get_bloginfo('name', 'display'));
    $logoLink = $isRecruteurPage ? get_permalink(95) : get_permalink(31);
    $siteLogo = get_stylesheet_directory_uri() . '/images/' . ($isRecruteurPage ? 'logo_dtj_pro.png' : 'logo_dtj.png');
    ?>

    <header id="header" role="banner" class="<?php if ($isRecruteurPage) echo 'pro-bg' ?>">
        <div class="container">
            <nav class="d-flex align-items-center" role="navigation">
                <!-- left logo -->
                <h1 class="site-title">
                    <a href="<?= $logoLink ?>" title="<?= $siteTitle ?>" rel="home">
                        <img src="<?= $siteLogo ?>" alt="<?php bloginfo('name'); ?> logo" class="logo" />
                    </a>
                </h1>
                <!-- left links -->
                <div class="div flex-fill">
                    <?php if (!$isRecruteurPage) { ?>
                        <a href="<?= get_permalink('7') ?>" class="btn btn-link btn-sm">Offres d'emploi</a>
                        <a href="<?= get_permalink('44') ?>" class="btn btn-link btn-sm">Découverte des entreprises</a>
                    <?php } else { ?>
                        <a href="<?= get_permalink('222') ?>" class="btn btn-link btn-sm">Nos services</a>
                        <a href="<?= get_permalink('16') ?>" class="btn btn-link btn-sm">Nos offres</a>
                        <a href="<?= get_permalink('8') ?>" class="btn btn-link btn-sm">Publier une annonce</a>
                    <?php } ?>
                </div>
                <!-- right links -->
                <div class="div">
                    <?php if (!$isRecruteurPage) { ?>
                        <a href="<?= get_permalink('95') ?>" class="btn btn-outline-primary btn-sm">Site employeurs</a>
                        <a href="<?= get_permalink('14') ?>" class="btn btn-primary btn-sm">Espace candidat</a>
                    <?php } else { ?>
                        <a href="<?= get_permalink('31') ?>" class="btn btn-outline-primary btn-sm">Site candidats</a>
                        <a href="<?= get_permalink('12') ?>" class="btn btn-primary btn-sm">Espace recruteur</a>
                    <?php } ?>
                </div>

            </nav>
        </div>
        </div>
    </header>
    <div id="main" class="container">
        <!-- Main content (centered and responsive) -->

        <?php /*
        <div class="wrapper <?php echo $is_wpjb ?>">
            <header id="header" role="banner" class="site-header <?php echo wp_get_nav_menu_name('primary') ?>">
                <div class="primary">
                    <div class="table-wrapper">
                        <h1 class="site-title">
                            <?php if (get_theme_mod('wpjobboard_theme_logo')) : ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><img src="<?php echo get_theme_mod('wpjobboard_theme_logo'); ?>" alt="<?php bloginfo('name'); ?> logo" class="logo" /></a>
                            <?php else : ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                            <?php endif; ?>
                        </h1>

                        <nav role="navigation" id="site-navigation" class="site-navigation main-navigation ">
                            <h1 class="assistive-text"><?php _e('Menu', 'jobeleon'); ?></h1>
                            <div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e('Skip to content', 'jobeleon'); ?>"><?php _e('Skip to content', 'jobeleon'); ?></a></div>
                            
                            <a href="#" class="hamburger-menu"><span class="wpjb-glyphs wpjb-icon-menu"></a>
                            <a href="#" class="hamburger-menu-close"><span class="wpjb-glyphs wpjb-icon-cancel"></a>

                            <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
                        </nav><!-- .site-navigation .main-navigation -->
                    </div><!-- .table-wrapper -->
                </div><!-- .primary -->
            </header><!-- #header .site-header -->
            
            <?php if(!$is_map): ?>
            <div class="table-row">
                <div id="primary" class="primary">
                    <div id="main" class="site-main">
            <?php endif; ?>
            */
        ?>
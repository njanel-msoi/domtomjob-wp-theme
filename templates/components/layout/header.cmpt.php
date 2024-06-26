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
    <title><?php wp_title('|', true, 'right'); ?></title>

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>

    <!-- TODO: integrate in wp_enqueue -->
    <link ref="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/assets/js/plugins/jquery-ui/jquery-ui.min.css">

    <!-- Google tag (gtag.js) -->
    <?php $gaID = get_field('id_google_analytics', 'option'); ?>
    <!-- the script is launched when consent is accepted -->
    <script type="didomi/javascript" src="https://www.googletagmanager.com/gtag/js?id=<?= $gaID ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', '<?= $gaID ?>');
    </script>
    <!-- didomi (consent managment) -->
    <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/vendor/didomi.min.js"></script>
</head>

<body <?php body_class(); ?>>

    <?php include dirname(__FILE__) . '/menu.cmpt.php'; ?>

    <main class="main">
        <div class="container">
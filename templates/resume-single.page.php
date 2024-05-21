<?php

/**
 * Template Name: DTJ Job single page
 */
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package wpjobboard_theme
 */
get_header();
?>

<div class="dtj-page single-resume">

    <!-- bloc top search -->
    <div class="resume">
        <h1>Espace recruteur</h1>

        <div class="where-am-i">
            <?php wpjb_breadcrumbs([
                ['glyph' => 'wpjb-icon-home', 'title' => 'Accueil', 'url' => get_permalink('12')],
                ['glyph' => "wpjb-icon-right-open", 'title' => 'CVthèque', 'url' => get_permalink('10')],
                ['glyph' => "wpjb-icon-right-open", 'title' => esc_html(get_the_title())],
            ]) ?>
        </div>

        <?php echo do_shortcode('[wpjb_single_resume]'); ?>

    </div>
</div>

<?php get_footer(); ?>
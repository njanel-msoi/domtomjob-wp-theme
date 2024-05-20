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

<div class="dtj-page single-job">

    <!-- bloc top search -->
    <div class="job">

        <?php echo do_shortcode('[wpjb_single_job]'); ?>

    </div>
</div>

<?php get_footer(); ?>
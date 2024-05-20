<?php

/**
 * Template Name: Job by region
 *
 * @package wpjobboard_theme
 * @since 1.2.0
 */
get_header();
?>



<div id="content" class="site-content full-width" role="main">

    <?php $region = urldecode(get_query_var('regions')); ?>

    <h1>Jobs de la région <?= $region; ?></h1>

    <?php echo do_shortcode('[wpjb_jobs_list meta__region="' . $region . '"]'); ?>

</div><!-- #content -->

<?php get_footer(); ?>
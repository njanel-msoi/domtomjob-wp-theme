<?php

/**
 * Template Name: Job by region
 *
 * @package wpjobboard_theme
 * @since 1.2.0
 */
get_header();
?>


<div class="dtj-page jobs-list">
    <?php $region = urldecode(get_query_var('regions')); ?>

    <!-- bloc top search -->
    <div class="search-result">
        <h1>Jobs de la région <?= $region; ?></h1>

        <?php echo do_shortcode('[wpjb_jobs_list meta__region="' . $region . '"]'); ?>

    </div>

</div>

<?php get_footer(); ?>
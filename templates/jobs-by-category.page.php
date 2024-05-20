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
    <?php $category = urldecode(get_query_var('category')); ?>
    <?php $categoryId = urldecode(get_query_var('categoryId')); ?>

    <!-- bloc top search -->
    <div class="search-result">
        <h1>Offres de la catégorie <?= $category; ?></h1>

        <?php echo do_shortcode('[wpjb_jobs_list category="' . $categoryId . '"]'); ?>

    </div>

</div>

<?php get_footer(); ?>
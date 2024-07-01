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
    <?php $secteur = urldecode(get_query_var('secteur')); ?>
    <?php $secteurId = urldecode(get_query_var('secteurId')); ?>

    <!-- bloc top search -->
    <div class="search-result">
        <h1>Offres de la catégorie <?= $secteur; ?></h1>

        <?php echo do_shortcode('[wpjb_jobs_list secteur="' . $secteurId . '"]'); ?>

    </div>

</div>

<?php get_footer(); ?>
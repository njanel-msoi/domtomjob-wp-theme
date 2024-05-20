<?php

/**
 * Template Name: DTJ Jobs list page
 */
get_header();
?>

<div class="dtj-page jobs-list">

    <!-- bloc top search -->
    <div class="search-form">
        <h2>Votre recherche</h2>

        <?php echo do_shortcode('[wpjb_jobs_search]'); ?>
    </div>

    <!-- bloc "search results" -->
    <div class="search-result">

        <?php echo do_shortcode('[wpjb_jobs_list]'); ?>

    </div>

</div>

<?php get_footer(); ?>
<?php

/**
 * Template Name: DTJ Company list
 */
get_header();
?>

<div class="dtj-page company-list">

    <!-- bloc top search -->
    <div class="search-form">
        <h2>Découverte des entreprises</h2>

        <?php echo do_shortcode('[wpjb_employers_list filter="public"]'); ?>
    </div>

</div>

<?php get_footer(); ?>
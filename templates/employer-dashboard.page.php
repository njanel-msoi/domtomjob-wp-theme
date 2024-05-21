<?php

/**
 * Template Name: DTJ Employer dashboard page
 */
get_header();
?>

<div class="dtj-page employer-dashboard">

    <div class="dashboard">
        <h1>Espace recruteur</h1>

        <?php echo do_shortcode('[wpjb_employer_panel]'); ?>

    </div>
</div>

<?php get_footer(); ?>
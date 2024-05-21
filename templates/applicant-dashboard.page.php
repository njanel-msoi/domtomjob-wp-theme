<?php

/**
 * Template Name: DTJ Applicant dashboard page
 */
get_header();
?>

<div class="dtj-page applicant-dashboard">

    <div class="dashboard">
        <h1>Espace candidat</h1>

        <?php echo do_shortcode('[wpjb_candidate_panel]'); ?>

    </div>
</div>

<?php get_footer(); ?>
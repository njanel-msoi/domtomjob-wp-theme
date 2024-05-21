<?php

/**
 * Template Name: DTJ Add job page
 */
get_header();
?>

<div class="dtj-page add-job">

    <div class="add-job-bloc">
        <h1>Publier une offre</h1>
        <?php echo do_shortcode('[wpjb_jobs_add]'); ?>

    </div>

</div>

<?php get_footer(); ?>
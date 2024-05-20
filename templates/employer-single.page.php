<?php

/**
 * Template Name: DTJ Employer single page
 */
get_header();
?>

<div class="dtj-page single-employer">

    <div class="employer">

        <?php echo do_shortcode('[wpjb_single_company]'); ?>

    </div>
</div>

<?php get_footer(); ?>
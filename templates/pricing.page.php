<?php

/**
 * Template Name: DTJ Pricing page
 */
get_header();
?>

<div class="dtj-page pricing-list">

    <div class="pricing">

        <h1>Nos offres</h1>

        <?php echo do_shortcode('[wpjb_membership_pricing]'); ?>

    </div>

</div>

<?php get_footer(); ?>
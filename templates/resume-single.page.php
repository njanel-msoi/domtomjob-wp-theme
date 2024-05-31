<?php

/**
 * CVTheque in company dashboard
 */
get_header();
?>

<?php $headerCode = "CV"; ?>
<?php include 'components/dashboard/company-dashboard-header.cmpt.php' ?>

        <?php echo do_shortcode('[wpjb_single_resume]'); ?>

<?php get_footer(); ?>